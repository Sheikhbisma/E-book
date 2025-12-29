<?php
session_start();
include "../auth/dbconnect.php";

if(!isset($_SESSION['userid'])){
    echo "<script>alert('Only registered customer will participate in competitions '); window.location='../user/login.php';</script>";
    exit;
}
$user_id = intval($_SESSION['userid']);

if(!isset($_GET['topic'])){
    die("Topic missing");
}
$topic = $conn->real_escape_string($_GET['topic']);

$event_stmt = $conn->prepare("SELECT * FROM competition_events WHERE name LIKE CONCAT('%',?,'%') LIMIT 1");
$nm = "Children Essay Competition";
$event_stmt->bind_param("s",$nm);
$event_stmt->execute();
$evr = $event_stmt->get_result()->fetch_assoc();
$event_id = intval($evr['id']);
$min_words = intval($evr['min_words'] ?? 1000);

// fetch user name
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
<?php include '../components/meta-links.php' ?>
<style>

.containeres {
    max-width: 750px;
    margin: 20px auto;
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
.user-name {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}
.topic {
    font-size: 22px;
    font-weight: 600;
    color: #fff;
    margin-bottom: 10px;
}
textarea {
    width: 100%;
    min-height: 250px;
    padding: 15px;
    font-size: 16px;
    border-radius: 12px;
    border: none;
    resize: vertical;
    box-shadow: inset 0 3px 8px rgba(0,0,0,0.2);
    margin-bottom: 15px;
}
.stats {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    font-size: 16px;
    margin-bottom: 20px;
}
.stats span {
    font-weight: bold;
}

button.a{
    background: grey !important;
    pointer-events: none;
}
@media(max-width: 600px){
    .container {padding: 20px 15px;}
    .topic {font-size: 18px;}
    .user-name {font-size: 16px;}
    .stats {font-size: 14px; flex-direction: column; gap: 5px;}
    button {font-size: 15px; padding: 12px;}
}
</style>
</head>
<body class="pt">
    <?php include '../components/header.php' ?>
<div class="containeres card">
   <div class="essay-header">
    <div class="user-block cream ">
        <i class="bi bi-person-circle"></i>
        <span><?=htmlspecialchars($user_name)?></span>
    </div>

    <div class="topic-block cream">
        <i class="bi bi-journal-text"></i>
        <span><?=htmlspecialchars($topic)?></span>
    </div>
</div>

    <form method="POST" action="submit_essay.php" id="essayForm">
        <input type="hidden" name="event_id" value="<?=$event_id?>">
        <input type="hidden" name="topic" value="<?=htmlspecialchars($topic)?>">
        <textarea name="essay_text" id="essay_text" class="text-dark" placeholder="Start writing your essay..." required></textarea>
        <div class="stats woodendark">
            <div>Time Left: <span id="timer">01:00</span></div>
            <div>Word Count: <span id="wordCount">0</span></div>
        </div>
        <button type="submit" class="btn-gold rounded-2">Submit Essay</button>
    </form>
</div>

<script>
const textarea = document.getElementById('essay_text');
const wordCountEl = document.getElementById('wordCount');
const timerEl = document.getElementById('timer');
const form = document.getElementById('essayForm');

let remaining = 20; // 1 min

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
        alert('Time finished. You can no longer submit.');
        textarea.disabled = true;
        form.querySelector('button').disabled = true;
        form.querySelector('button').classList.add('a')  ;
        setTimeout(redirect , 2000)
        return;
    }
    remaining--;
    setTimeout(tick,1000);
}
tick();
function redirect(){
    return window.location.href='user_dashboard.php';
}
// Alert on submission
form.addEventListener('submit', ()=>{
    alert('Your essay has been submitted. The result will be shown shortly.');
});
</script>
 <?php include '../components/footer.php' ?>
  <?php include '../components/script.php' ?>
</body>
</html>
