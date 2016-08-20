<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 20/08/2016
 * Time: 23:46
 */
use ORM\Repository\TypeRepository;
use ORM\Entity\Type;

$typeRepo = new TypeRepository();

$types = $typeRepo->findBy([], ['id' => "DESC"]);

?>

<!-- HEADER -->
<div id="wrapper-header">
    <div id="main-header" class="object">
        <div class="logo">
            <a href="./">
                <img src="medias/logo_dark.png" alt="logo" style="height:38px;">
            </a>
        </div>
        <div id="main_tip_search">
            <form action="./">
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
                <a href="<?= Router::generate(["type" => "new"], "./") ?>">
                    <div class="recent object">Récents</div>
                </a>
            </div>

            <div id="wrapper-title-3">
                <a href="<?= Router::generate(["type" => "old"], "./") ?>">
                    <div class="oldies object">Anciens</div>
                </a>
            </div>
        </div>

        <div id="wrapper-bouton-icon">
            <?php
            /** @var Type $type */
            foreach ($types as $type): ?>
                <div class="bouton">
                    <a href="<?= Router::generate(["type" => $type->getSlug()], "./") ?>">
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