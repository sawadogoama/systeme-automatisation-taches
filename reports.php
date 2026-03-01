<?php
include "config.php";
include "auth.php";

$logs = $pdo->query("SELECT * FROM task_logs ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Rapports</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
<h3>Historique</h3>

<?php foreach($logs as $l): ?>
<div class="alert alert-light">
<?= $l['action'] ?> — <?= $l['created_at'] ?>
</div>
<?php endforeach; ?>

<a href="dashboard.php" class="btn btn-secondary">Retour</a>
</div>

</body>
</html>