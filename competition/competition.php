<?php
session_start();
include "../auth/dbconnect.php";

if(!isset($_SESSION['userid'])){
    echo "<script>alert('Only registered customer will participate in competitions '); window.location='../user/login.php';</script>";
    exit;
}

$user_id = intval($_SESSION['userid']);

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

/* ===== DB CHECK ===== */
$chk = $conn->prepare("
    SELECT id 
    FROM competition_entries 
    WHERE user_id = ? AND event_id = ?
    LIMIT 1
");
$chk->bind_param("ii", $user_id, $event_id);
$chk->execute();
$chk_res = $chk->get_result();
$alreadyParticipated = ($chk_res->num_rows > 0);
/* =================== */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Children Essay Competition</title>
<?php include'../components/meta-links.php' ?>
<style>
:root {
    --shadow-light: rgba(93, 64, 55, 0.1);
    --shadow-medium: rgba(93, 64, 55, 0.2);
}
.wrap { max-width: 1000px; margin: 80px auto; padding: 0 20px; }
.card {
    padding: 40px; border-radius: 20px; background-color: var(--paper-cream);
    box-shadow: 0 10px 30px var(--shadow-medium);
text-align:center; position:relative;
    border:12px solid var(--wood-dark);
}
.card::before {
 content:""; position:absolute; top:0; left:0; right:0; height:8px;
    background: linear-gradient(90deg,var(--accent-gold),var(--headings),var(--accent-gold));
}
h2 { font-size: 36px; color: var(--wood-dark); margin-bottom: 20px; position:relative; display:inline-block; }
h2::after { content:""; position:absolute; bottom:0; left:25%; width:50%; height:4px; background:linear-gradient(90deg,transparent,var(--accent-gold),transparent); border-radius:2px; }
</style>
</head>
<body>

<?php include'../components/header.php' ?>

<div class="wrap">
    <div class="card">
        <h2>
            <span style="color:var(--accent-gold)"><i class="bi bi-pencil-square"></i></span>
            Children Essay Competition
            <span style="color:var(--accent-gold)"><i class="bi bi-stars"></i></span>
        </h2>

        <div class="user-greeting">
            Hello, <strong><?=htmlspecialchars($user_name)?></strong>! Get ready to express your creativity.
        </div>

        <div class="instructions">
            <p>Select a topic below and click <strong>Start</strong>. You will have <strong>1 minute</strong> to write your essay.</p>
        </div>

        <div class="topics-container">
            <h3><i class="fas fa-clipboard-list"></i> Choose Your Essay Topic:</h3>

            <?php if(count($topics) == 0): ?>
                <div class="notice">Oops! No topics are available yet.</div>
            <?php else: ?>
                <form id="startForm">
                    <div class="topics-grid">
                        <?php foreach($topics as $index => $topicName): ?>
                        <div class="topic-option">
                            <input type="radio" name="topic" id="topic<?=$index?>" value="<?=htmlspecialchars($topicName)?>">
                            <label class="topic-label" for="topic<?=$index?>"><?=htmlspecialchars($topicName)?></label>
                            <i class="fas fa-star topic-icon"></i>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="button" class="start-btn" onclick="startCompetition()">
                        <i class="fas fa-play-circle"></i> Start Competition
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL -->
<div id="alreadyModal" style="
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.6);
    z-index:9999;
">
    <div style="
        background:#fff;
        width:90%;
        max-width:420px;
        margin:15% auto;
        padding:25px;
        border-radius:12px;
        text-align:center;
        box-shadow:0 10px 30px rgba(0,0,0,0.3);
    ">
        <h3 style="color:#5C3A21;margin-bottom:15px;">
            Participation Alert
        </h3>

        <p style="font-size:16px;margin-bottom:25px;">
            You have already participated in this competition.<br>
            You cannot participate again.
        </p>

        <button onclick="goIndex()" style="
            padding:10px 25px;
            background:#FFD700;
            border:none;
            border-radius:8px;
            font-weight:bold;
            cursor:pointer;
        ">
            OK
        </button>
    </div>
</div>

<script>
function startCompetition(){
    if(<?= $alreadyParticipated ? 'true' : 'false' ?>){
        document.getElementById('alreadyModal').style.display = 'block';
        return;
    }

    const sel = document.querySelector('input[name="topic"]:checked');
    if(!sel){
        alert('Please select a topic before starting!');
        return;
    }

    window.location = "write_essay.php?topic=" + encodeURIComponent(sel.value);
}

function goIndex(){
    window.location = "../index.php"; // ✅ user index page
}
</script>

<?php include '../components/footer.php' ?>
<?php include '../components/script.php' ?>

</body>
</html>
