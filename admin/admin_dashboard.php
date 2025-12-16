<?php
session_start();
include "db.php";

/* ======================
   ADMIN CHECK
====================== */
if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin']!=1){
    die("Access denied");
}

/* ======================
   CONFIG
====================== */
$child_event_id = 1;

/* ======================
   FETCH TOPICS
====================== */
$topics_res = $conn->query("SELECT id, topic_name FROM competition_topics WHERE event_id=$child_event_id");
$child_topics = [];
while($t = $topics_res->fetch_assoc()){
    $child_topics[$t['id']] = $t['topic_name'];
}

/* ======================
   FETCH CHILD ESSAYS
====================== */
$child_entries = $conn->query("
    SELECT ce.id, u.name, u.email, ce.essay_text, ce.word_count,
           ce.status, ce.topic_id, ce.submitted_at
    FROM competition_entries ce
    JOIN users u ON ce.user_id = u.id
    ORDER BY ce.submitted_at DESC
");

/* ======================
   FETCH ADULT PDF BOOKS
====================== */
$adult_entries = $conn->query("
    SELECT ae.id, u.name, u.email, ae.pdf_file,
           ae.status, ae.submitted_at
    FROM adult_entries ae
    JOIN users u ON ae.user_id = u.id
    ORDER BY ae.submitted_at DESC
");

/* ======================
   POST ACTIONS
====================== */
if($_SERVER['REQUEST_METHOD']=="POST"){

    /* CHILD UPDATE */
    if(isset($_POST['child_id'])){
        $stmt = $conn->prepare(
            "UPDATE competition_entries SET status=?, topic_id=? WHERE id=?"
        );
        $stmt->bind_param(
            "sii",
            $_POST['child_status'],
            $_POST['child_topic'],
            $_POST['child_id']
        );
        $stmt->execute();

        @mail(
            $_POST['child_email'],
            "Competition Result",
            "Your result: ".$_POST['child_status']
        );
        header("Location: admin_dashboard.php"); exit;
    }

    /* ADULT UPDATE */
    if(isset($_POST['adult_id'])){
        $stmt = $conn->prepare(
            "UPDATE adult_entries SET status=? WHERE id=?"
        );
        $stmt->bind_param("si", $_POST['adult_status'], $_POST['adult_id']);
        $stmt->execute();

        @mail(
            $_POST['adult_email'],
            "Competition Result",
            "Your result: ".$_POST['adult_status']
        );
        header("Location: admin_dashboard.php"); exit;
    }

    /* ADD TOPIC */
    if(isset($_POST['new_topic'])){
        $stmt = $conn->prepare(
            "INSERT INTO competition_topics (event_id, topic_name) VALUES (?,?)"
        );
        $stmt->bind_param("is", $child_event_id, $_POST['new_topic']);
        $stmt->execute();
        header("Location: admin_dashboard.php"); exit;
    }

    /* DELETE TOPIC */
    if(isset($_POST['delete_topic_id'])){
        $stmt = $conn->prepare(
            "DELETE FROM competition_topics WHERE id=?"
        );
        $stmt->bind_param("i", $_POST['delete_topic_id']);
        $stmt->execute();
        header("Location: admin_dashboard.php"); exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{
    font-family:Arial,sans-serif;
    background:#f4f2ef;
    margin:0;
    padding:0;
}
.container{
    max-width:1200px;
    margin:20px auto;
    background:#fff;
    padding:20px;
    border-radius:10px;
}
.section{
    margin-bottom:50px;
}
h2{
    color:#6B4226;
    margin-bottom:15px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th,td{
    border:1px solid #ccc;
    padding:10px;
    text-align:left;
    word-break:break-word;
}
th{
    background:#6B4226;
    color:#fff;
}
button{
    background:#6B4226;
    color:#fff;
    border:none;
    padding:6px 12px;
    border-radius:6px;
    cursor:pointer;
}
button:hover{
    opacity:0.9;
}
select,input[type=text]{
    padding:5px;
    width:100%;
    max-width:200px;
    box-sizing:border-box;
}
form{
    margin:0;
}

/* RESPONSIVE TABLES */
@media screen and (max-width: 1024px){
    table{
        font-size:14px;
    }
}
@media screen and (max-width: 768px){
    table, thead, tbody, th, td, tr{
        display:block;
    }
    thead tr{
        display:none;
    }
    tr{
        margin-bottom:15px;
        border-bottom:2px solid #ddd;
        padding-bottom:10px;
    }
    td{
        border:none;
        position:relative;
        padding-left:45%;
        text-align:left;
    }
    td:before{
        position:absolute;
        left:10px;
        width:40%;
        white-space:nowrap;
        font-weight:bold;
    }
    td:nth-of-type(1):before{content:"Name";}
    td:nth-of-type(2):before{content:"Words";}
    td:nth-of-type(3):before{content:"Essay";}
    td:nth-of-type(4):before{content:"Status";}
    td:nth-of-type(5):before{content:"Topic";}
    td:nth-of-type(6):before{content:"Date";}
    td:nth-of-type(7):before{content:"Action";}
}
@media screen and (max-width:480px){
    .container{
        padding:10px;
    }
    button, select, input[type=text]{
        width:100%;
        margin-top:5px;
        margin-bottom:5px;
    }
}
</style>
</head>
<body>

<div class="container">

<!-- ================= ESSAY SECTION ================= -->
<div class="section">
<h2>Children Essay Competition</h2>

<table>
<tr>
<th>Name</th><th>Words</th><th>Essay</th>
<th>Status</th><th>Topic</th><th>Date</th><th>Action</th>
</tr>

<?php while($c=$child_entries->fetch_assoc()): ?>
<tr>
<td><?=htmlspecialchars($c['name'])?></td>
<td><?=$c['word_count']?></td>
<td><?=substr(strip_tags($c['essay_text']),0,40)?>...</td>
<td><?=$c['status']?></td>

<td>
<form method="post">
<select name="child_topic">
<?php foreach($child_topics as $id=>$name): ?>
<option value="<?=$id?>" <?=($c['topic_id']==$id?'selected':'')?>>
<?=$name?>
</option>
<?php endforeach; ?>
</select>
</td>

<td><?=$c['submitted_at']?></td>
<td>
<input type="hidden" name="child_id" value="<?=$c['id']?>">
<input type="hidden" name="child_email" value="<?=$c['email']?>">
<select name="child_status">
<option value="winner">Winner</option>
<option value="loser">Loser</option>
<option value="abandoned">Abandoned</option>
</select>
<button>Save</button>
</form>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>

<!-- ================= PDF SECTION ================= -->
<div class="section">
<h2>Adult PDF / Book Competition</h2>

<table>
<tr>
<th>Name</th><th>Email</th><th>PDF</th>
<th>Status</th><th>Date</th><th>Action</th>
</tr>

<?php while($a=$adult_entries->fetch_assoc()): ?>
<tr>
<td><?=$a['name']?></td>
<td><?=$a['email']?></td>
<td><a href="<?=$a['pdf_file']?>" target="_blank">Download</a></td>
<td><?=$a['status']?></td>
<td><?=$a['submitted_at']?></td>
<td>
<form method="post">
<input type="hidden" name="adult_id" value="<?=$a['id']?>">
<input type="hidden" name="adult_email" value="<?=$a['email']?>">
<select name="adult_status">
<option value="winner">Winner</option>
<option value="loser">Loser</option>
</select>
<button>Save</button>
</form>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>

<!-- ================= TOPIC SECTION ================= -->
<div class="section">
<h2>Manage Topics</h2>

<form method="post" style="margin-bottom:20px">
<input type="text" name="new_topic" placeholder="New topic" required>
<button>Add Topic</button>
</form>

<table>
<tr><th>Topic</th><th>Action</th></tr>
<?php foreach($child_topics as $id=>$name): ?>
<tr>
<td><?=$name?></td>
<td>
<form method="post">
<input type="hidden" name="delete_topic_id" value="<?=$id?>">
<button>Delete</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>

</div>
</body>
</html>
