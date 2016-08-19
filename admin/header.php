<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 18/08/2016
 * Time: 21:33
 */
require_once(__DIR__."/../app/bootstrap.php");
use ORM\Repository\ProjectRepository;

$projectRepo = new ProjectRepository();
$headerProjects = $projectRepo->findAllNotDeleted();
?>

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../">Admin ZoomINTV</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="./project.php">Ajouter un projet</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Modifier un projet <span class="caret"></span></a>
                    <ul class="dropdown-menu scrollable-menu">
                        <?php
                        /** @var \ORM\Entity\Project $headerProject */
                        foreach ($headerProjects as $headerProject) {
                            $name = $headerProject->getTitle();
                            $id = $headerProject->getId();
                            echo "<li><a href='./project_edit.php?project=$id'>$name</a></li>";
                        }
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Supprimer un projet <span class="caret"></span></a>
                    <ul class="dropdown-menu scrollable-menu">
                        <?php
                        /** @var \ORM\Entity\Project $headerProject */
                        foreach ($headerProjects as $headerProject) {
                            $name = $headerProject->getTitle();
                            $id = $headerProject->getId();
                            echo "<li><a href='./project_delete.php?project=$id'>$name</a></li>";
                        }
                        ?>
                    </ul>
                </li>
                <li><a href="./detail.php">Ajouter un détail</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
