<?php
include "config.php";
include "auth.php";

if(isset($_POST['add'])){
    $pdo->prepare(
        "INSERT INTO tasks (title,description,due_date,user_id)
         VALUES (?,?,?,?)"
    )->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['due'],
        $_SESSION['user']['id']
    ]);
}

if(isset($_GET['delete'])){
    $pdo->prepare("DELETE FROM tasks WHERE id=?")->execute([$_GET['delete']]);
}

if(isset($_GET['status'])){
    $pdo->prepare("UPDATE tasks SET status=? WHERE id=?")
        ->execute([$_GET['status'],$_GET['id']]);
}

$tasks = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Tâches</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
<h3>Gestion des tâches</h3>

<form method="post" class="mb-4">
<input name="title" class="form-control mb-2" placeholder="Titre" required>
<input name="description" class="form-control mb-2" placeholder="Description" required>
<input type="date" name="due" class="form-control mb-2" required>
<button name="add" class="btn btn-primary">Ajouter</button>
</form>

<table class="table table-bordered">
<tr>
<th>Titre</th>
<th>Statut</th>
<th>Actions</th>
</tr>

<?php foreach($tasks as $t): ?>
<tr>
<td><?= $t['title'] ?></td>
<td><?= $t['status'] ?></td>
<td>
<a href="?status=En cours&id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">En cours</a>
<a href="?status=Terminé&id=<?= $t['id'] ?>" class="btn btn-success btn-sm">Terminé</a>
<a href="?delete=<?= $t['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
</td>
</tr>
<?php endforeach; ?>
</table>

<a href="dashboard.php" class="btn btn-secondary">Retour</a>
</div>

</body>
</html>