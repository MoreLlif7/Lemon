<?php
function ajouterLog($title, $msg)
{

    $msg = date('d-m-Y H:i:s') . ' ' . $title . ' ' . $msg . PHP_EOL;
    $fichierLog = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR .  date('d-m-Y') . '-data.log';

    if (file_exists($fichierLog)) {
        file_put_contents($fichierLog, $msg, FILE_APPEND);
    } else {
        file_put_contents($fichierLog, $msg);
    }
}
