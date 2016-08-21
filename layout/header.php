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
    </div>
</div>

<!-- NAVBAR -->

<div id="wrapper-navbar">
    <div class="navbar object">
        <div id="wrapper-sorting">
            <div id="wrapper-title-3" class="recent desc">
                Sous portfolio d'<a href="http://www.amelie-mathieu.fr" target="_blank">Amélie Mathieu</a>
            </div>
        </div>

        <div id="wrapper-bouton-icon">
            <?php
            /** @var Type $type */
            foreach ($types as $type): ?>
                <div class="bouton">
                    <a href="<?= Router::generate(["type" => $type->getSlug()], "./") ?>">
                        <img src="img/icons/<?= $type->getImg() ?>" alt="<?= $type->getName() ?>"
                             title="<?= $type->getName() ?>">
                    </a>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</div>
