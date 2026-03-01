<?php
include "config.php";
include "auth.php";

$total = $pdo->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
$retard = $pdo->query(
    "SELECT COUNT(*) FROM tasks WHERE due_date < CURDATE() AND status!='Terminé'"
)->fetchColumn();

$notifications = $pdo->query(
    "SELECT * FROM notifications ORDER BY created_at DESC LIMIT 5"
)->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Tableau de bord</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
<h2>Tableau de bord</h2>

<div class="alert alert-primary">Total des tâches : <?= $total ?></div>
<div class="alert alert-danger">Tâches en retard : <?= $retard ?></div>

<h4>Notifications</h4>
<?php foreach($notifications as $n): ?>
<div class="alert alert-warning"><?= $n['message'] ?></div>
<?php endforeach; ?>

<a href="tasks.php" class="btn btn-success">Gestion des tâches</a>
<a href="reports.php" class="btn btn-info">Rapports</a>
<a href="logout.php" class="btn btn-dark">Déconnexion</a>
</div>

</body>
</html>