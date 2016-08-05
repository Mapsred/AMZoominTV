<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 05/08/2016
 * Time: 22:35
 */
require_once(__DIR__."/app/bootstrap.php");

use ORM\Repository\TypeRepository;
use ORM\Repository\ProjectRepository;
use ORM\Entity\Type;
use ORM\Entity\Project;

$typeRepo = new TypeRepository();
$projectRepo = new ProjectRepository();
$types = $typeRepo->findBy([], ['id' => "DESC"]);
$projects = $projectRepo->findBy([], ['id' => "DESC"]);

?>

<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Burstfly - Free HTML5 Template</title>

    <!-- Behavioral Meta Data -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="icon" type="image/png" href="site/img/small-logo-01.png">
    <link
        href='http://fonts.googleapis.com/css?family=Roboto:400,900,900italic,700italic,700,500italic,400italic,500,300italic,300'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>

<!-- CACHE -->
<div class="cache"></div>

<!-- HEADER -->
<div id="wrapper-header">
    <div id="main-header" class="object">
        <div class="logo"><img src="medias/logo_dark.png" alt="logo" style="height:38px;"></div>
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
            <div id="wrapper-title-1">
                <div class="top-rated object">Top-rated</div>
                <div id="fleche-nav-1"></div>
            </div>

            <div id="wrapper-title-2">
                <a href="#">
                    <div class="recent object">Recent</div>
                </a>
                <div id="fleche-nav-2"></div>
            </div>

            <div id="wrapper-title-3">
                <a href="#">
                    <div class="oldies object">Oldies</div>
                </a>
                <div id="fleche-nav-3"></div>
            </div>
        </div>
        <div id="wrapper-bouton-icon">
            <?php
            /** @var Type $type */
            foreach ($types as $type): ?>
                <div id="bouton-psd">
                    <img src="img/icons/<?= $type->getImg() ?>" alt="<?= $type->getName() ?>"
                         title="<?= $type->getId() ?>">
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
                foreach ( $projects as $project) :
                ?>
                    <figure class="white">
                        <a href="#">
                            <img src="medias/<?= $project->getImage() ?>" alt="<?= $project->getTitle() ?>"/>
                            <dl>
                                <dt><?= $project->getTitle() ?></dt>
                                <dd><?= $project->getDescription() ?></dd>
                            </dl>
                        </a>
                        <div id="wrapper-part-info">
                            <div class="part-info-image">
                                <img src="img/icons/<?= $project->getType()->getImgSmall() ?>"
                                     alt="<?= $project->getType()->getName() ?>" width="28" height="28"/>
                            </div>
                            <div id="part-info">Infographic - Knights</div>
                        </div>
                    </figure>


                <?php
                endforeach;
                ?>


                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_Dinosaurs.jpg" alt=""/>
                        <dl>
                            <dt>Infographic - Dinosaurs</dt>
                            <dd>Infographie classée dans "Bilogie".</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Infographic - Dinosaurs</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_Perfume.jpg" alt=""/>
                        <dl>
                            <dt>Infographic - Perfume</dt>
                            <dd>Infographie classée dans "Bilogie".</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Infographic - Perfume</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_SuperHeroes.jpg" alt=""/>
                        <dl>
                            <dt>Infographic - Super Heroes</dt>
                            <dd>Infographie classée dans "Bilogie".</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Infographic - Super Heroes</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_NailBiting.jpg" alt=""/>
                        <dl>
                            <dt>Infographic - Nails Biting</dt>
                            <dd>Infographie classée dans "Bilogie".</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Infographic - Nails Biting</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_Slugs&Salt.jpg" alt=""/>
                        <dl>
                            <dt>Infographic - Sulgs and Salt</dt>
                            <dd>Infographie classée dans "Bilogie".</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Infographic - Slugs and Salt</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="details.html">
                        <img src="site/medias/ThumbsPortfolioZoominTV_BubbleMan.jpg" alt=""/>
                        <dl>
                            <dt>Bubble Man</dt>
                            <dd>Thumbnail sur un SDF faisant des bulles.</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Img-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Thumbnail</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_SnapchatLayouts.jpg" alt=""/>
                        <dl>
                            <dt>Snapchat Layouts</dt>
                            <dd>Détourage des icônes et remplacement d'une partie de l'image par une mise en
                                situation.
                            </dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ps-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Small Graphic</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_60S translation.jpg" alt=""/>
                        <dl>
                            <dt>60 seconds Graphic</dt>
                            <dd>Traduction d'un leader directement dans After Effects.</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">60 seconds Graphic</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_CupidArrow.jpg" alt=""/>
                        <dl>
                            <dt>Cupid's Arrow Animation</dt>
                            <dd>Réalisation d'une petite animation sous After Effects.</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Cupid's Arrow Animation</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_CursedPictures.jpg" alt=""/>
                        <dl>
                            <dt>Cursed Pictures</dt>
                            <dd>Petite animation visant à faire part d'une vidéo reportage.</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Cursed Pictures</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_ESLBenelux.jpg" alt=""/>
                        <dl>
                            <dt>Animation ESL Benelux</dt>
                            <dd>ESL est le leader mondial des plateformes e-sports. L'animation faisait lieu de
                                transition/titre.
                            </dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ae-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Animation ESL Benelux</div>
                    </div>
                </figure>

                <figure class="white">
                    <a href="#">
                        <img src="site/medias/ThumbsPortfolioZoominTV_FootballersCutouts.jpg" alt=""/>
                        <dl>
                            <dt>Footballers cutouts</dt>
                            <dd>Détourage façon collage de footballers pour une vidéo d'actualité.</dd>
                        </dl>
                    </a>
                    <div id="wrapper-part-info">
                        <div class="part-info-image"><img src="site/medias/Adobe-Ps-icon-small.png" alt="" width="28"
                                                          height="28"/></div>
                        <div id="part-info">Footballers cutouts</div>
                    </div>
                </figure>

            </section>

        </div>

    </div>

    <div id="wrapper-oldnew">
        <div class="oldnew">
            <div class="wrapper-oldnew-prev">
                <div id="oldnew-prev"></div>
            </div>
            <div class="wrapper-oldnew-next">
                <div id="oldnew-next"></div>
            </div>
        </div>
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

