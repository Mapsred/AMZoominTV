<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 06/08/2016
 * Time: 00:17
 */

require_once(__DIR__."/../app/bootstrap.php");
require_once(__DIR__."/FileTreatment.php");
require_once(__DIR__."/Session.php");

use ORM\Repository\TypeRepository;
use ORM\Entity\Type;
use ORM\Entity\Project;
use ORM\Repository\ProjectRepository;
use Cocur\Slugify\Slugify;

$typeRepo = new TypeRepository();
$projectRepo = new ProjectRepository();
$types = $typeRepo->findAll();

$session = Session::getInstance();
if ($session->verifySession() || !$session->__isset("username")) {
    Session::redirecting("./", 0);
}

if (isset($_POST['title'])) {
    $slugify = new Slugify();
    $project = $projectRepo->findOneBy(['title' => $_POST['title']]);
    if ($project) {
        $session->addFlashBag("danger", "Ce projet existe déjà");
        Session::redirecting($_SERVER['REQUEST_URI']);
    }
    $project = new Project();
    $type = $typeRepo->findOneById($_POST['type']);
    if (!$type) {
        $session->addFlashBag("danger", "Le type sélectionné n'existe pas");
        Session::redirecting($_SERVER['REQUEST_URI']);
    }
    $slug = $slugify->slugify($_POST['title']);
    $project->setTitle($_POST['title'])->setDescription($_POST['desc'])->setSlug($slug)->setType($type);

    $fileTreatment = new FileTreatment($_FILES['file']);
    if (is_string($error = $fileTreatment->isValid())) {
        $session->addFlashBag("danger", $error);
        Session::redirecting($_SERVER['REQUEST_URI']);
    } else {
        $fileTreatment->moveFile();
    }

    $project->setImage($fileTreatment->getImageName())->setCreatedAt(new DateTime());
    $projectRepo->save($project);

    $session->addFlashBag("success", "Le projet a bien été ajouté");
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
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        ...
    </div>
</nav>
<div class="row">
    <div class="container">
        <?php $session->getFlashBag(); ?>
        <div class="col-md-offset-2 col-md-10">
            <p>Ajout d'un nouveau projet</p>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Titre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre" required>
                </div>
            </div>
            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Description" required>
                </div>
            </div>
            <div class="form-group">
                <label for="type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select name="type" id="type" class="form-control">
                        <?php
                        /** @var Type $type */
                        foreach ($types as $type) {
                            $id = $type->getId();
                            $name = $type->getName();
                            echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Photo</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="file" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Envoyer</button>
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
