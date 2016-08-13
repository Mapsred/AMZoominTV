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

use ORM\Repository\TypeRepository;
use ORM\Repository\ProjectRepository;
use ORM\Entity\Type;
use ORM\Entity\Project;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrapView;

$typeRepo = new TypeRepository();
$projectRepo = new ProjectRepository();
$types = $typeRepo->findBy([], ['id' => "DESC"]);

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == "old") {
        $projects = $projectRepo->findBy([], ['id' => "ASC"]);
    }else if ($type == "new") {
        $projects = $projectRepo->findBy([], ['id' => "DESC"]);
    }else {
        $projects = $projectRepo->findByTypeSlug($type);
    }
}
if (!isset($projects)) {
    $projects = $projectRepo->findBy([], ['id' => "DESC"]);
}

$adapter = new ArrayAdapter($projects);
$pagerfanta = new Pagerfanta($adapter);

$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$pagerfanta->setMaxPerPage(12);
if ($currentPage > $pagerfanta->getNbPages()) {
    Session::redirecting("./", 0);
}

$pagerfanta->setCurrentPage($currentPage);

$projects = $pagerfanta->getCurrentPageResults();
$routeGenerator = function ($page) {
    return Router::paginator($page);
};
$view = new TwitterBootstrapView();
$options = ['prev_message' => ' ', 'next_message' => '', "css_container_class " => "oldnew"];
$paginator = $view->render($pagerfanta, $routeGenerator, $options);
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
    <link rel="stylesheet" type="text/css" href="css/pagerfanta.css">

</head>

<body>
<!-- CACHE -->
<div class="cache"></div>

<!-- HEADER -->
<div id="wrapper-header">
    <div id="main-header" class="object">
        <div class="logo">
            <a href="./">
                <img src="medias/logo_dark.png" alt="logo" style="height:38px;">
            </a>
        </div>
        <div id="main_tip_search">
            <form>
                <label for="tip_search_input" class="sr-only"></label>
                <input type="text" name="search" id="tip_search_input" list="search" autocomplete=off required>
            </form>
        </div>
        <div id="stripes"></div>
    </div>
</div>

<!-- NAVBAR -->

<div id="wrapper-navbar">
    <div class="navbar object">
        <div id="wrapper-sorting">
            <div id="wrapper-title-2">
                <a href="<?= Router::generate(["type" => "new"]) ?>">
                    <div class="recent object">Récents</div>
                </a>
            </div>

            <div id="wrapper-title-3">
                <a href="<?= Router::generate(["type" => "old"]) ?>">
                    <div class="oldies object">Anciens</div>
                </a>
            </div>
        </div>
        <div id="wrapper-bouton-icon">
            <?php
            /** @var Type $type */
            foreach ($types as $type): ?>
                <div class="bouton">
                    <a href="<?= Router::generate(["type" => $type->getSlug()]) ?>">
                    <img src="img/icons/<?= $type->getImg() ?>" alt="<?= $type->getName() ?>"
                         title="<?= $type->getId() ?>">
                    </a>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</div>

<!-- FILTER - RESPONSIVE MENU -->

<div id="main-container-menu" class="object">
    <div class="container-menu">

        <div id="main-cross">
            <div id="cross-menu"></div>
        </div>

        <div id="main-small-logo">
            <div class="small-logo"></div>
        </div>

        <div id="main-premium-ressource">
            <div class="premium-ressource"><a href="#">Premium resources</a></div>
        </div>

        <div id="main-themes">
            <div class="themes"><a href="#">Latest themes</a></div>
        </div>

        <div id="main-psd">
            <div class="psd"><a href="#">PSD goodies</a></div>
        </div>

        <div id="main-ai">
            <div class="ai"><a href="#">Illustrator freebies</a></div>
        </div>

        <div id="main-font">
            <div class="font"><a href="#">Free fonts</a></div>
        </div>

        <div id="main-photo">
            <div class="photo"><a href="#">Free stock photos</a></div>
        </div>

    </div>
</div>


<!-- PORTFOLIO -->

<div id="wrapper-container">

    <div class="container object">

        <div id="main-container-image">

            <section class="work">
                <?php
                /** @var Project $project */
                foreach ($projects as $project) :
                    ?>
                    <figure class="white">
                        <a href="#">
                            <img src="medias/projects/<?= $project->getImage() ?>" alt="<?= $project->getTitle() ?>"/>
                            <dl>
                                <dt><?= $project->getTitle() ?></dt>
                                <dd><?= $project->getDescription() ?></dd>
                            </dl>
                        </a>
                        <div id="wrapper-part-info">
                            <div class="part-info-image">
                                <img src="img/icons/<?= $project->getType()->getImg() ?>"
                                     alt="<?= $project->getType()->getName() ?>" width="28" height="28"/>
                            </div>
                            <div id="part-info"><?= $project->getTitle() ?></div>
                        </div>
                    </figure>
                    <?php
                endforeach;
                ?>

            </section>

        </div>

    </div>

    <div id="wrapper-oldnew">
        <?= $paginator ?>
    </div>

    <div id="wrapper-thank">
        <div class="thank">
            <div class="thank-text"><img src="medias/logo_light.png" alt="ZoominTV"
                                         style="height: 80px; margin-bottom: 60px;"/></div>
        </div>
    </div>

    <div id="main-container-footer">
        <div class="container-footer">

            <div id="row-1f">
                <div class="text-row-1f"><span
                        style="font-weight:600;font-size:15px;color:#666;line-height:250%;text-transform:uppercase;letter-spacing:1.5px;">What is Burstfly</span><br>Burstfly
                    is just a blog showcasing hand-picked free themes, design stuff, free fonts and other resources for
                    web designers.
                </div>
            </div>

            <div id="row-2f">
                <div class="text-row-2f"><span
                        style="font-weight:600;font-size:15px;color:#666;line-height:250%;text-transform:uppercase;letter-spacing:1.5px;">How does it work</span><br>Burstfly
                    offers you all the latest freebies found all over the fourth corners without to pay.
                </div>
            </div>

            <div id="row-3f">
                <div class="text-row-3f"><span
                        style="font-weight:600;font-size:15px;color:#666;line-height:250%;text-transform:uppercase;letter-spacing:1.5px;">Get in touch!</span><br>Subscribe
                    our RSS or follow us on Facebook, Google+, Pinterest or Dribbble to keep updated.
                </div>
            </div>

            <div id="row-4f">
                <div class="text-row-4f"><span
                        style="font-weight:600;font-size:15px;color:#666;line-height:250%;text-transform:uppercase;letter-spacing:1.5px;">Newsletter</span><br>You
                    will be informed monthly about the latest content avalaible.
                </div>

                <div id="main_tip_newsletter">
                    <form>
                        <input type="text" name="newsletter" id="tip_newsletter_input" list="newsletter"
                               autocomplete=off required>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <div id="wrapper-copyright">
        <div class="copyright">
            <div class="copy-text object">Copyright © 2016. Template by <a style="color:#D0D1D4;"
                                                                           href="http://designscrazed.org/">Dcrazed</a>
            </div>

            <div class="wrapper-navbouton">
                <div class="google object">g</div>
                <div class="facebook object">f</div>
                <div class="linkin object">i</div>
                <div class="dribbble object">d</div>
            </div>
        </div>
    </div>

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


</body>


</html>

