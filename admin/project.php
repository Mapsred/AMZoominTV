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

$session = Session::getInstance();
if ($session->verifySession()) {
    Session::redirecting("/admin");
}

if (isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    $fileTreatment = new FileTreatment($_FILES['photo']);
    if (is_string($error = $fileTreatment->isValid())) {
        $errors['photo'] = $error;
    } else {
        $fileTreatment->moveFile();

    }
}
