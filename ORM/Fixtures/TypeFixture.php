<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 05/08/2016
 * Time: 20:42
 */

require_once(__DIR__."/../../app/bootstrap.php");

use Cocur\Slugify\Slugify;
use ORM\Repository\TypeRepository;
use ORM\Entity\Type;
$types = ["After Effects", "Illustrator", "Photoshop", "InDesign", "Image"];

$repo = new TypeRepository();
$slugify = new Slugify();

foreach ($types as $name) {
    $type = $repo->findOneBy(['name' =>$name]);
    if (!$type) {
        $type = new Type();
    }
    $slug = $slugify->slugify($name);
    $type->setName($name)->setSlug($slug)->setImg($slug.".png");
    $repo->save($type);
}