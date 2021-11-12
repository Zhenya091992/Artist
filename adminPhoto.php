<?php

include(__DIR__ . '/functions/autoload.php');

$admin = new \Models\Admin();
if ($admin->checkSession($_SESSION)) {
    if (!empty($_POST['namePhoto']) && !empty($_FILES['file'])) {
        $photo = new Models\Photo();
        $photo->addPhoto($_POST['namePhoto'], $_FILES['file']);
    } elseif (isset($_POST['deletePhoto'])) {
        $photo = new \Models\Photo();
        $photo->deleteId($_GET['id']);
    } elseif (isset($_POST['editPhoto'])) {
        $photo = new \Models\Photo();
        $data = [
            ':id' => $_GET['id'],
            ':namePhoto' => $_POST['editNamePhoto'],
            ':nameFile' => $_POST['editNameFile']
        ];
        $photo->update($data);
    }

    $photo = new Models\Photo();
    $photos = $photo->getAll();
    $arrFunc = [
        function ($photo) {
            return $photo->id;
        },
        function ($photo) {
            return $photo->namePhoto;
        },
        function ($photo) {
            return $photo->nameFile;
        },
    ];
    $admin = new Models\AdminDataTable($photos, $arrFunc);
    $viev = new \Viev();
    $viev->assign('admin', $admin->render());
    $viev->display(__DIR__ . '/templates/tempAdminPhoto.php');
} else {
    $err = 'please sign in';
    $viev = new \Viev();
    $viev->assign('err', $err);
    $viev->display(__DIR__ . '/index.php');
}
