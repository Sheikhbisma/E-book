<?php
session_start();
include "../auth/dbconnect.php";

// Admin check
if(!isset($_SESSION['email'])){
    die("Access denied");
}

$event_stmt = $conn->prepare("SELECT * FROM competition_events WHERE name='Children Essay Competition' LIMIT 1");
$event_stmt->execute();
$event = $event_stmt->get_result()->fetch_assoc();
$event_id = intval($event['id']);

// Handle winner selection
if(isset($_POST['winner_id'])){
    $winner_id = intval($_POST['winner_id']);
    $upd = $conn->prepare("UPDATE competition_entries SET status='qualified' WHERE event_id=? AND user_id=?");
    $upd->bind_param("ii",$event_id,$winner_id);
    $upd->execute();
    echo "<script>alert('Winner announced successfully'); window.location='admin_announce.php';</script>";
    exit;
}

// Fetch all entries that are not abandoned
$entries = $conn->prepare("SELECT ce.id, ce.user_id, u.name, ce.word_count, ce.status FROM competition_entries ce JOIN users u ON ce.user_id=u.id WHERE ce.event_id=? AND ce.status!='abandoned'");
$entries->bind_param("i",$event_id);
$entries->execute();
$res = $entries->get_result();
?>
<!doctype html>
<html>
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin: Announce Winner</title>
</head>
<body>
<h2>Children Essay Competition: Announce Winner</h2>
<table border="1" cellpadding="8" cellspacing="0">
<tr><th>User</th><th>Word Count</th><th>Status</th><th>Action</th></tr>
<?php while($row = $res->fetch_assoc()): ?>
<tr>
  <td><?=htmlspecialchars($row['name'])?></td>
  <td><?=$row['word_count']?></td>
  <td><?=$row['status']?></td>
  <td>
    <?php if($row['status']!=='qualified'): ?>
    <form method="POST" style="display:inline;">
      <input type="hidden" name="winner_id" value="<?=$row['user_id']?>">
      <button type="submit">Announce Winner</button>
    </form>
    <?php else: ?>
    Winner
    <?php endif; ?>
  </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
