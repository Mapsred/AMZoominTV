<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 05/08/2016
 * Time: 22:35
 */
require_once(__DIR__."/app/bootstrap.php");
require_once(__DIR__."/admin/Session.php");
require_once(__DIR__."/Router.php");

use ORM\Repository\ProjectRepository;
use ORM\Repository\DetailRepository;
use ORM\Entity\Project;

$projectRepo = new ProjectRepository();
$detailRepo = new DetailRepository();

$detail = "";
if (isset($_GET['project'])) {
    $project = $projectRepo->findOneById($_GET['project']);
    $detail = $detailRepo->findOneByProject($project);
}

if (!isset($project) || !isset($_GET['project'])) {
    $project = $projectRepo->findOne();
    $detail = $detailRepo->findOneByProject($project);
}

if (!isset($detail)) {
    echo "Aucun détail n'est disponible pour le projet ".$project->getId();
}

$similars = $projectRepo->findBySimilarType($project);
?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Amélie Mathieu - ZoomINTV</title>

    <!-- Behavioral Meta Data -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="img/small-logo-01.png">
    <link
        href='http://fonts.googleapis.com/css?family=Roboto:400,900,900italic,700italic,700,500italic,400italic,500,300italic,300'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/details.css">
</head>

<body>
<!-- CACHE -->
<div class="cache"></div>

<?php include_once(__DIR__."/layout/header.php"); ?>

<!-- PORTFOLIO -->

<div id="wrapper-container">

    <div class="container object">

        <div id="main-container-image">

            <div class="title-item">
                <div class="title-icon">
                    <img src="img/icons/<?= $project->getType()->getImg() ?>"
                         alt="<?= $project->getType()->getName() ?>"/>
                </div>
                <div class="title-text"><?= $project->getTitle() ?></div>
            </div>


            <div class="work">
                <figure class="white">
                    <?php
                    $name = $project->getTitle();
                    $img = '<img src="medias/projects/%s" class="min-img" alt="%s" data-img="%s">';
                    $imgHidden = '<img src="medias/projects/%s" alt="%s" style="display: none" class="%s">';
                    if (!empty($detail->getYoutube())) { ?>
                        <div class="embed-responsive embed-responsive-16by9 youtube">
                            <iframe class="embed-responsive-item" src="<?= $detail->getYoutube() ?>"
                                    allowfullscreen=""></iframe>
                        </div>
                        <?php
                        echo sprintf($imgHidden, $detail->getImage1(), $name, "image_1");
                    }
                    if (!empty($detail->getImage2())) {
                        echo sprintf($imgHidden, $detail->getImage2(), $name, "image_2");
                    }
                    if (!empty($detail->getImage3())) {
                        echo sprintf($imgHidden, $detail->getImage3(), $name, "image_3");
                    }
                    if (!empty($detail->getImage4())) {
                        echo sprintf($imgHidden, $detail->getImage4(), $name, "image_4");
                    }

                    ?>
                    <div id="wrapper-part-info">
                        <div class="part-info-image">
                            <?php
                            if (!empty($detail->getYoutube())) {
                                echo '<img src="img/youtube.png" class="min-img" alt="youtube" data-img="youtube">';
                                echo sprintf($img, $detail->getImage1(), $name, "image_1");
                            }
                            if (!empty($detail->getImage2())) {
                                echo sprintf($img, $detail->getImage2(), $name, "image_2");
                            }
                            if (!empty($detail->getImage3())) {
                                echo sprintf($img, $detail->getImage3(), $name, "image_3");
                            }
                            if (!empty($detail->getImage4())) {
                                echo sprintf($img, $detail->getImage4(), $name, "image_4");
                            }
                            ?>
                        </div>
                    </div>
                </figure>

                <div class="wrapper-text-description">


                    <div class="wrapper-file">
                        <div class="icon-file">
                            <img src="img/icons/<?= $project->getType()->getImg() ?>"
                                 alt="<?= $project->getType()->getName() ?>"
                                 style="width: 21px;height: 21px;"/>
                        </div>
                        <div class="text-file"><?= $project->getType()->getName() ?></div>
                    </div>

                    <div class="wrapper-desc">
                        <div class="icon-desc"><img src="img/icon-desc.svg" alt="" width="24" height="24"/></div>
                        <div class="text-desc"><?= $detail->getDescription() ?>
                        </div>
                    </div>
                    <?php if (count($similars) > 0) :
                        ?>
                        <div class="wrapper-morefrom">
                            <div class="text-morefrom">Plus de <?= $project->getType()->getName() ?></div>
                            <div class="image-morefrom">
                                <?php
                                /**
                                 * @var int $key
                                 * @var Project $similar
                                 */
                                foreach ($similars as $key => $similar):
                                    ?>
                                    <a href="./details.php?project=<?= $similar->getId() ?>">
                                        <div class="image-morefrom-1"><img
                                                src="medias/projects/<?= $similar->getImage() ?>"
                                                alt="<?= $similar->getTitle() ?>" width="430" height="330"/>
                                        </div>
                                    </a>

                                    <?php
                                endforeach;
                                ?>
                            </div>
                        </div>
                        <?php
                    endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div id="wrapper-thank">
        <div class="thank">
            <div class="thank-text">
                <img src="medias/logo_light.png" alt="ZoominTV" style="height: 80px; margin-bottom: 60px;"/>
            </div>
        </div>
    </div>

    <?php include_once(__DIR__."/layout/footer.php"); ?>

</div>

<!-- SCRIPT -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="js/jquery.localScroll.min.js"></script>
<script type="text/javascript" src="js/jquery-animate-css-rotate-scale.js"></script>
<script type="text/javascript" src="js/fastclick.min.js"></script>
<script type="text/javascript" src="js/jquery.animate-colors-min.js"></script>
<script type="text/javascript" src="js/jquery.animate-shadow-min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/detail.js"></script>

</body>

</html>

