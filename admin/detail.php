<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 19/08/2016
 * Time: 23:46
 */

require_once(__DIR__."/../app/bootstrap.php");
require_once(__DIR__."/FileTreatment.php");
require_once(__DIR__."/Session.php");

use ORM\Repository\DetailRepository;
use ORM\Entity\Project;
use ORM\Repository\ProjectRepository;
use ORM\Entity\Detail;

$detailRepo = new DetailRepository();
$projectRepo = new ProjectRepository();

$projects = $projectRepo->findAllNotDeleted();

$session = Session::getInstance();
if ($session->verifySession() || !$session->__isset("username")) {
    Session::redirecting("./", 0);
}

if (isset($_POST['project'])) {
    $detail = new Detail();
    foreach ($_FILES as $key => $file) {
        if (!empty($file['name'])) {
            $fileTreatment = new FileTreatment($file);
            if (is_string($error = $fileTreatment->isValid())) {
                $session->addFlashBag("danger", $error);
                Session::redirecting($_SERVER['REQUEST_URI']);
            } else {
                $fileTreatment->moveFile();
            }
            $setter = "set".ucfirst($key);
            $detail->$setter($fileTreatment->getImageName());
        }
    }

    $detail->setProject($_POST['project'])->setDescription($_POST['desc'])->setYoutube($_POST['youtube']);
    $detailRepo->save($detail);

    $session->addFlashBag("success", "Le détail projet a bien été ajouté");
    Session::redirecting($_SERVER['REQUEST_URI']);
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

<div class="container">
    <?php $session->getFlashBag(); ?>
    <div class="col-md-offset-2 col-md-10">
        <h1>Ajout d'un nouveau détail projet</h1>
    </div>
    <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="project" class="col-sm-2 control-label">Projet</label>
            <div class="col-sm-10">
                <select name="project" id="project" class="form-control" required>
                    <?php
                    /** @var Project $project */
                    foreach ($projects as $project) {
                        $id = $project->getId();
                        $name = $project->getTitle();
                        echo "<option value='$id'>$name</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="desc" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea id="desc" name="desc" class="form-control" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="image1" class="col-sm-2 control-label">Image 1</label>
            <div class="col-sm-10">
                <input type="file" id="image1" name="image1" required>
            </div>
        </div>
        <div class="form-group">
            <label for="image2" class="col-sm-2 control-label">Image 2</label>
            <div class="col-sm-10">
                <input type="file" id="image2" name="image2">
            </div>
        </div>
        <div class="form-group">
            <label for="image3" class="col-sm-2 control-label">Image 3</label>
            <div class="col-sm-10">
                <input type="file" id="image3" name="image3" >
            </div>
        </div>
        <div class="form-group">
            <label for="image4" class="col-sm-2 control-label">Image 4</label>
            <div class="col-sm-10">
                <input type="file" id="image4" name="image4">
            </div>
        </div>

        <div class="form-group">
            <label for="youtube" class="col-sm-2 control-label">Youtube</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Youtube">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Envoyer</button>
            </div>
        </div>
    </form>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
