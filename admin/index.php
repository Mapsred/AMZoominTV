<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 05/08/2016
 * Time: 23:43
 */
require_once(__DIR__."/../app/bootstrap.php");
require_once(__DIR__."/Treatment.php");
require_once(__DIR__."/Session.php");


$session = Session::getInstance();
if ($session->verifySession()) {
    Session::redirecting("/admin");
}

$errors = [];

if (isset($_POST['username'])) {
    $treatment = new Treatment();
    if (!$treatment->verify($_POST['username'], $_POST['password'])) {
        $errors['error'] = "Utilisateur ou mot de passe non valide";
        $session->destroy();
    } else {
        $session->__set("username", $_POST['username']);
        Session::redirecting("project.php");
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Zone admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        ...
    </div>
</nav>
<div class="row">
    <div class="container">
        <div class="col-md-offset-2 col-md-10">
            <p>Veuillez entrer vos identifiants afin d'accéder à l'admin</p>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" placeholder="Pseudo" name="username">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
            </div>
            <button type="submit" class="btn btn-default">Envoyer</button>
        </form>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
