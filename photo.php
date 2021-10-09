<?php
include __DIR__ . '/functions/autoload.php';

$objPhoto = new Models\Photo();
$data = $objPhoto->getPhoto();

$viev = new \Viev();
$viev->assign('photo', $data);
$viev->display(__DIR__ . '/templates/tempPhoto.html');
