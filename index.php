<?php
include "config.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    $req = $pdo->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $req->execute([$email,$password]);
    $user = $req->fetch();

    if($user){
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Connexion</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card p-4 col-md-4 mx-auto">
<h3 class="text-center">Connexion</h3>

<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

<form method="post">
<input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
<button name="login" class="btn btn-primary w-100">Se connecter</button>
</form>
</div>
</div>

</body>
</html>