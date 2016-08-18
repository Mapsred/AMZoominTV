<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 18/08/2016
 * Time: 21:08
 */

require_once(__DIR__."/../app/bootstrap.php");
require_once(__DIR__."/FileTreatment.php");
require_once(__DIR__."/Session.php");

use ORM\Repository\TypeRepository;
use ORM\Entity\Type;
use ORM\Repository\ProjectRepository;
use Cocur\Slugify\Slugify;

$typeRepo = new TypeRepository();
$projectRepo = new ProjectRepository();
$types = $typeRepo->findAll();
$project = "";
$session = Session::getInstance();
if ($session->verifySession() || !$session->__isset("username")) {
    Session::redirecting("./", 0);
}

if (isset($_GET['project'])) {
    $project = $projectRepo->findOneBy(['id' => $_GET['project']]);
}

if (empty($project) || !isset($_GET['project'])) {
    $session->addFlashBag("danger", "Aucun projet sélectionné");
    Session::redirecting("./");
}


if (isset($_POST['title'])) {
    $slugify = new Slugify();
    $project = $projectRepo->findOneBy(['id' => $_GET['project']]);
    $type = $typeRepo->findOneById($_POST['type']);
    if (!$type) {
        $session->addFlashBag("danger", "Le type sélectionné n'existe pas");
        Session::redirecting($_SERVER['REQUEST_URI']);
    }
    $slug = $slugify->slugify($_POST['title']);
    $project->setTitle($_POST['title'])->setDescription($_POST['desc'])->setSlug($slug)->setType($type);

    if (strlen($_FILES['file']['name']) > 1 && $project->getImage() != $_FILES['file']['name']) {
        $fileTreatment = new FileTreatment($_FILES['file']);
        if (is_string($error = $fileTreatment->isValid())) {
            $session->addFlashBag("danger", $error);
            Session::redirecting($_SERVER['REQUEST_URI']);
        } else {
            $fileTreatment->moveFile();
        }
        $project->setImage($fileTreatment->getImageName());
    }


    $project->setUpdatedAt(new DateTime());
    $projectRepo->save($project);

    $session->addFlashBag("success", "Le projet a bien été modifié");
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
<div class="row">
    <div class="container">
        <?php $session->getFlashBag(); ?>
        <div class="col-md-offset-2 col-md-10">
            <h1>Modification du projet <?= $project->getTitle() ?></h1>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data"
              action="<?= $_SERVER['REQUEST_URI'] ?>">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Titre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" placeholder="Titre"
                           value="<?= $project->getTitle() ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="desc" name="desc" placeholder="Description"
                           value="<?= $project->getDescription() ?>" required>
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
                            $selected = $project->getType()->getName() == $name ? "selected" : "";
                            echo "<option value='$id' $selected>$name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <img src="../medias/projects/<?= $project->getImage() ?>" alt="<?= $project->getTitle() ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Photo (Uniquement pour changer l'actuelle)</label>
                <div class="col-sm-10">
                    <input type="file" id="file" name="file">
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
