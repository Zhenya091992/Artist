<?php
include __DIR__ . '/functions/autoload.php';

if ($_GET['exit'] == 'exit') {        //проверка на нажатие кнопки выход, для закрытия сессии
    unset($_SESSION['session'], $_SESSION['login']);
}
$info = new \Models\Data();
$data = $info->getData('info');

$viev = new \Viev();
$viev->assign('info', $data[0]);
$viev->display(__DIR__ . '/templates/tempIndex.html');