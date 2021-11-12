<?php

include(__DIR__ . '/functions/autoload.php');

$admin = new \Models\Admin();
if ($admin->checkSession($_SESSION)) {
    if (!empty($_POST['nameAlbum']) && !empty($_POST['dateRelise'])) {
        $album = new Models\Album();
        $album->createAlbum($_POST['nameAlbum'], $_POST['dateRelise']);
    } elseif (isset($_POST['deleteAlbum'])) {
        $album = new \Models\Album();
        $album->deleteId($_GET['id']);
    } elseif (isset($_POST['editAlbum'])) {
        $album = new \Models\Album();
        $data = [
            ':id' => $_GET['id'],
            ':nameAlbum' => $_POST['editNameAlbum'],
            ':dateRelise' => $_POST['editDateRelise']
        ];
        $album->update($data);
    }

    $album = new Models\Album();
    $albums = $album->getAll();
    $arrFunc = [
        function ($album) {
            return $album->id;
        },
        function ($album) {
            return $album->nameAlbum;
        },
        function ($album) {
            return $album->dateRelise;
        },
    ];
    $admin = new Models\AdminDataTable($albums, $arrFunc);
    $viev = new \Viev();
    $viev->assign('admin', $admin->render());
    $viev->display(__DIR__ . '/templates/tempAdminAlbums.php');

} else {
    $err = 'please sign in';
    $viev = new \Viev();
    $viev->assign('err', $err);
    $viev->display(__DIR__ . '/index.php');
}
