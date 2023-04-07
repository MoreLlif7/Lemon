<?php
require_once '../vendor/autoload.php';
require_once '../src/controller/_controllers.php';
require_once '../config/routes.php';
require_once '../config/api.php';
$loader = new \Twig\Loader\FilesystemLoader('../src/vue/');
$twig = new \Twig\Environment($loader, []);
$contenu = getPage(null);
$db = $config;
//var_dump($contenu);
$contenu($twig, $db);
