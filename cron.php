<?php
include "config.php";

$tasks = $pdo->query(
    "SELECT * FROM tasks WHERE due_date < CURDATE() AND status!='Terminé'"
)->fetchAll();

foreach($tasks as $t){
    $pdo->prepare(
        "INSERT INTO notifications (message) VALUES (?)"
    )->execute(["Tâche en retard : ".$t['title']]);

    $pdo->prepare(
        "INSERT INTO task_logs (task_id,action) VALUES (?,?)"
    )->execute([$t['id'],"Tâche en retard détectée automatiquement"]);
}