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
use ORM\Entity\Project;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Pagerfanta\View\TwitterBootstrapView;

$projectRepo = new ProjectRepository();

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

if (isset($_GET['search'])) {
    $projects = $projectRepo->findByString($_GET['search']);
}

if (!isset($projects)) {
    $projects = $projectRepo->findAllNotDeleted();
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

<?php include_once(__DIR__."/layout/header.php"); ?>

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
                        <a href="./details.php?project=<?= $project->getId() ?>">
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


</body>


</html>

