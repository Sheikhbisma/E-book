<?php
session_start();
include "../auth/dbconnect.php";

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Aapko competition me participate karne ke liye login karna hoga.'); window.location='login.php';</script>";
    exit;
}

if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true){
    header("Location: ../admin/admin_dashboard.php");
    exit;
}

$user_id = intval($_SESSION['user_id']);

// fetch logged-in user's name
$user_stmt = $conn->prepare("SELECT customer_name FROM customer_register WHERE customer_id = ? LIMIT 1");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_res = $user_stmt->get_result();
$user_name = ($user_res->num_rows > 0) ? $user_res->fetch_assoc()['customer_name'] : "Guest";

// Fetch Children Competition event
$event_stmt = $conn->prepare("SELECT * FROM competition_events WHERE name LIKE CONCAT('%',?,'%') LIMIT 1");
$search_name = "Children Essay Competition";
$event_stmt->bind_param("s", $search_name);
$event_stmt->execute();
$event_res = $event_stmt->get_result();

if($event_res->num_rows == 0){
    die("Children Competition event not found. Ask admin to create it.");
}

$event = $event_res->fetch_assoc();
$event_id = intval($event['id']);

// fetch topics added by admin
$topics_stmt = $conn->prepare("SELECT topic_name FROM competition_topics WHERE event_id=?");
$topics_stmt->bind_param("i",$event_id);
$topics_stmt->execute();
$topics_res = $topics_stmt->get_result();
$topics = [];
while($row = $topics_res->fetch_assoc()){
    $topics[] = $row['topic_name'];
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Children Essay Competition</title>
<style>
/* Reset */
body, html { margin: 0; padding: 0; font-family: 'Comic Sans MS', cursive, sans-serif; background: linear-gradient(to bottom, #FFF1E6, #FFDAB9); }

/* Container */
.wrap { max-width: 900px; margin: 50px auto; padding: 0 20px; }

/* Card */
.card { 
    background: #FFFAF0; 
    padding: 50px 40px; 
    border-radius: 25px; 
    box-shadow: 0 10px 25px rgba(0,0,0,0.15); 
    text-align: center; 
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
}
.card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.25); }

h2 { margin-top: 0; color: #FF7F50; font-weight: 800; font-size: 36px; letter-spacing: 1px; }
p { line-height: 1.6; color: #333; margin-bottom: 20px; font-size: 16px; }

/* Topic */
.topic { 
    padding: 15px 20px; 
    border-radius: 15px; 
    border: 2px dashed #FFA07A; 
    background: #FFF8DC; 
    margin-bottom: 15px; 
    transition: background 0.3s, transform 0.3s; 
    text-align: left; 
}
.topic:hover { background: #FFE4B5; transform: translateX(5px); }
.topic input[type="radio"] { margin-right: 12px; accent-color: #FF6347; transform: scale(1.2); }

/* Button */
.btn { 
    display: inline-block; 
    background: #FF6347; 
    color: #fff; 
    font-weight: 700; 
    padding: 15px 35px; 
    border: none; 
    border-radius: 15px; 
    cursor: pointer; 
    font-size: 16px; 
    margin-top: 20px; 
    transition: background 0.3s, transform 0.3s; 
}
.btn:hover { background: #FF4500; transform: translateY(-3px); }

/* Notice */
.notice { background: #FFD700; color: #5C3A21; padding: 12px; border-radius: 12px; margin-bottom: 20px; font-weight: bold; }

/* Responsive */
@media(max-width: 768px){
    .card { padding: 40px 25px; }
    h2 { font-size: 30px; }
    p { font-size: 15px; }
    .btn { width: 100%; padding: 14px; font-size: 16px; }
}
@media(max-width: 480px){
    .card { padding: 30px 20px; }
    h2 { font-size: 24px; }
    p { font-size: 14px; }
    .topic { padding: 12px 14px; font-size: 14px; }
    .btn { padding: 12px; font-size: 15px; }
}
</style>
</head>
<body>

<div class="wrap">
    <div class="card">
        <h2>🌟 Children Essay Competition 🌟</h2>
        <p>Hello, <strong><?=htmlspecialchars($user_name)?></strong>! Get ready to express your creativity.</p>
        <p>Select a topic below and click <strong>Start</strong>. You will have <strong>1 minute</strong> to write your essay. Make it fun, colorful, and imaginative!</p>

        <?php if(count($topics) == 0): ?>
            <div class="notice">Oops! No topics are available yet. Please check back soon.</div>
        <?php else: ?>
            <form id="startForm">
                <?php foreach($topics as $t): ?>
                <div class="topic">
                    <label>
                        <input type="radio" name="topic" value="<?=htmlspecialchars($t)?>">
                        <?=htmlspecialchars($t)?>
                    </label>
                </div>
                <?php endforeach; ?>
                <button type="button" class="btn" onclick="start()">Start Competition ✏️</button>
            </form>
        <?php endif; ?>
        
    </div>
</div>

<script>
function start(){
    const sel = document.querySelector('input[name="topic"]:checked');
    if(!sel){ alert('Please select a topic before starting!'); return; }
    window.location = "write_essay.php?topic=" + encodeURIComponent(sel.value);
}
</script>

</body>
</html>
