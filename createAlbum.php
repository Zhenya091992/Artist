<?php
include __DIR__ . '/functions/autoload.php';

$admin = new \Models\Admin();
//проверяем входил пользователь или нет
if($admin->checkSession($_SESSION)) {
    if(!empty($_POST['nameAlbum']) && !empty($_POST['dateRelise'])){
        $album = new \Models\Album();
        if($album->createAlbum($_POST['nameAlbum'], $_POST['dateRelise'])){
            $message = 'album added';
        } else {
            $message = 'error data base';
        }
    } else {
        $message = 'fill in all the fields';
    }
} else {
    $message = 'please log in';
}

$viev = new \Viev();
$viev->assign('message', $message);
$viev->display(__DIR__ . '/templates/tempCreateAlbum.html');