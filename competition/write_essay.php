<?php
session_start();
include "../auth/dbconnect.php";

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Login required'); window.location='login.php';</script>";
    exit;
}
$user_id = intval($_SESSION['user_id']);

if(!isset($_GET['topic'])){
    die("Topic missing");
}
$topic = $conn->real_escape_string($_GET['topic']);

// Fetch event
$nm = "Children Essay Competition";
$event_stmt = $conn->prepare("SELECT * FROM competition_events WHERE name LIKE CONCAT('%',?,'%') LIMIT 1");
$event_stmt->bind_param("s", $nm);
$event_stmt->execute();
$evr = $event_stmt->get_result()->fetch_assoc();
$event_id = intval($evr['id']);
$min_words = intval($evr['min_words'] ?? 1000);

// Check if user already participated
$chk = $conn->prepare("SELECT start_time, end_time, submitted_at FROM competition_entries WHERE event_id=? AND user_id=? LIMIT 1");
$chk->bind_param("ii", $event_id, $user_id);
$chk->execute();
$res = $chk->get_result();

if($res->num_rows == 0){
    // First time: insert start time
    $start_time = date('Y-m-d H:i:s');
    $end_time = date('Y-m-d H:i:s', strtotime('+1 minute'));

    $init = $conn->prepare("INSERT INTO competition_entries (event_id, user_id, start_time, end_time, status) VALUES (?,?,?,?, 'started')");
    $init->bind_param("iiss", $event_id, $user_id, $start_time, $end_time);
    $init->execute();

    $submitted_at = null;
} else {
    $row = $res->fetch_assoc();
    $start_time = $row['start_time'];
    $end_time = $row['end_time'];
    $submitted_at = $row['submitted_at'];
}

// Calculate remaining seconds
$remaining_seconds = max(0, strtotime($end_time) - time());

// Fetch user name
$user_stmt = $conn->prepare("SELECT customer_name FROM customer_register WHERE customer_id=? LIMIT 1");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user_name = ($user_res->num_rows>0) ? $user_res->fetch_assoc()['customer_name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Write Your Essay</title>
<style>
body {
    margin:0; padding:0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #f4f2ef, #e6d8c3);
}
.container {
    max-width: 750px;
    margin: 20px auto;
    background: #5C3A21;
    color: #fff;
    border-radius: 15px;
    padding: 30px 40px;
    box-shadow: 0 12px 28px rgba(0,0,0,0.25);
}
.header {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}
.user-name { font-size: 18px; font-weight: bold; color: #FFD700; margin-bottom: 10px; }
.topic { font-size: 22px; font-weight: 600; color: #fff; margin-bottom: 10px; }
textarea {
    width: 100%; min-height: 250px; padding: 15px; font-size: 16px;
    border-radius: 12px; border: none; resize: vertical;
    box-shadow: inset 0 3px 8px rgba(0,0,0,0.2); margin-bottom: 15px;
}
.stats { display: flex; flex-wrap: wrap; justify-content: space-between; font-size: 16px; margin-bottom: 20px; }
.stats span { font-weight: bold; }
button {
    display: block; width: 100%; padding: 14px; font-size: 16px; font-weight: bold;
    background: #FFD700; color: #5C3A21; border: none; border-radius: 12px;
    cursor: pointer; transition: transform 0.25s, background 0.25s;
}
button:hover { background: #e6c200; transform: translateY(-3px); }
@media(max-width: 600px){
    .container {padding: 20px 15px;}
    .topic {font-size: 18px;}
    .user-name {font-size: 16px;}
    .stats {font-size: 14px; flex-direction: column; gap: 5px;}
    button {font-size: 15px; padding: 12px;}
}
.alert-expire {
    background: #ff4d4d; padding: 15px; border-radius: 10px;
    text-align:center; font-weight:bold; margin-bottom:20px;
}
</style>
</head>
<body>
<div class="container">

<?php if($submitted_at !== null || $remaining_seconds <= 0): ?>
    <div class="alert-expire">
        ⏰ Your time has expired or you have already submitted the essay.<br>
        Please check your <a href="../user/dashboard.php" style="color:#FFD700; text-decoration:underline;">dashboard</a>.
    </div>
<?php else: ?>

    <div class="header">
        <div class="user-name">User: <?=htmlspecialchars($user_name)?></div>
        <div class="topic">Topic: <?=htmlspecialchars($topic)?></div>
    </div>
    <form method="POST" action="submit_essay.php" id="essayForm">
        <input type="hidden" name="event_id" value="<?=$event_id?>">
        <input type="hidden" name="topic" value="<?=htmlspecialchars($topic)?>">
        <textarea name="essay_text" id="essay_text" placeholder="Start writing your essay..." required></textarea>
        <div class="stats">
            <div>Time Left: <span id="timer"><?= $remaining_seconds ?></span></div>
            <div>Word Count: <span id="wordCount">0</span></div>
        </div>
        <button type="submit">Submit Essay</button>
    </form>
<?php endif; ?>

</div>

<script>
const textarea = document.getElementById('essay_text');
const wordCountEl = document.getElementById('wordCount');
const timerEl = document.getElementById('timer');
const form = document.getElementById('essayForm');

<?php if($submitted_at === null && $remaining_seconds > 0): ?>
let remaining = parseInt(<?= $remaining_seconds ?>, 10) || 0;

// Word count update
textarea.addEventListener('input', ()=>{
    const words = textarea.value.trim().split(/\s+/).filter(w=>w!=="");
    wordCountEl.textContent = words.length;
});

// Timer
function fmt(s){
    let m = Math.floor(s/60), sec = s%60;
    return (m<10?'0'+m:m)+':'+(sec<10?'0'+sec:sec);
}
function tick(){
    timerEl.innerText = fmt(remaining);
    if(remaining<=0){
        alert('⏰ Time finished. You can no longer submit.');
        textarea.disabled = true;
        form.querySelector('button').disabled = true;
        return;
    }
    remaining--;
    setTimeout(tick,1000);
}
tick();

// Alert on submission
form.addEventListener('submit', ()=>{
    alert('Your essay has been submitted. The result will be shown shortly.');
});
<?php endif; ?>
</script>
</body>
</html>
