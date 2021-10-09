<?php
include __DIR__ . '/functions/autoload.php';

$objAlbum = new \Models\Album();
$data = $objAlbum->getAlbums();
$viev = new \Viev();
$viev->assign('album', $data);
$viev->display(__DIR__ . '/templates/tempAlbums.html');