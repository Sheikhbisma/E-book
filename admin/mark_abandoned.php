<?php
// mark_abandoned.php
include './session.php';
include "../auth/dbconnect.php";

// event lookup
$evs = $conn->prepare("SELECT * FROM competition_events WHERE name LIKE CONCAT('%',?,'%') LIMIT 1");
$nm = "Children Essay Competition";
$evs->bind_param("s",$nm);
$evs->execute();
$er = $evs->get_result();
if($er->num_rows == 0) die("Event not found.");
$event = $er->fetch_assoc();
$event_id = intval($event['id']);

// sessions ended & no entry
$q = $conn->prepare("SELECT cs.user_id FROM competition_sessions cs LEFT JOIN competition_entries ce ON cs.user_id=ce.user_id AND ce.event_id=cs.event_id WHERE cs.event_id=? AND cs.end_time < NOW() AND ce.id IS NULL");
$q->bind_param("i",$event_id);
$q->execute();
$res = $q->get_result();
$ins = $conn->prepare("INSERT INTO competition_entries (event_id, user_id, essay_text, word_count, status, submitted_at) VALUES (?,?,?,?, 'abandoned', NOW())");

while($r = $res->fetch_assoc()){
    $uid = intval($r['user_id']);
    $empty = "";
    $zero = 0;
    $ins->bind_param("iisi",$event_id,$uid,$empty,$zero);
    $ins->execute();
}
echo "Abandoned marking complete.";
