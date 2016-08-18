<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 18/08/2016
 * Time: 21:47
 */
require_once(__DIR__."/../app/bootstrap.php");
require_once(__DIR__."/FileTreatment.php");
require_once(__DIR__."/Session.php");

use ORM\Repository\ProjectRepository;

$session = Session::getInstance();
$projectRepo = new ProjectRepository();
$project = "";
if (isset($_GET['project'])) {
    $project = $projectRepo->findOneBy(['id' => $_GET['project']]);
}

if (isset($_POST['redirect'])) {
    Session::redirecting("./");
}

if (isset($_POST['delete'])) {
    $project->setDeletedAt(new DateTime());
    $projectRepo->save($project);
    $session->addFlashBag("success", "Le projet a bien été supprimé");
    Session::redirecting("./");
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
<?php include_once(__DIR__."/header.php"); ?>
<div class="row">
    <div class="container">
        <?php $session->getFlashBag(); ?>
        <div class="col-md-offset-2 col-md-10">
            <h1>Suppression du projet <?= $project->getTitle() ?></h1>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data"
              action="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="delete" class="btn btn-danger">Confirmer la suppression</button>
                    <button type="submit" name="redirect" class="btn btn-info">Ne pas supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
