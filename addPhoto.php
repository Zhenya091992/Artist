<?php
include __DIR__ . '/functions/autoload.php';

$admin = new \Models\Admin();
//проверяем входил пользователь или нет
if($admin->checkSession($_SESSION)) {
    if(!empty($_POST['namePhoto']) && !empty($_FILES['file']['size']) && 0 == $_FILES['file']['error']){
        $photo = new \Models\Photo();
        if($photo->addPhoto($_POST['namePhoto'], $_FILES)){
            $message = 'photo added';
        } else {
            $message = 'error';
        }
    } else {
        $message = 'enter the name of the photo and select the file';
    }
} else {
    $message = 'please log in';
}

$viev = new \Viev();
$viev->assign('message', $message);
$viev->display(__DIR__ . '/templates/tempAddPhoto.html');