<?php
require_once '../vendor/autoload.php';
require_once '../src/controller/_controllers.php';
require_once '../config/routes.php';
$loader = new \Twig\Loader\FilesystemLoader('../src/vue/');
$twig = new \Twig\Environment($loader, []);
$contenu = getPage(null);
//var_dump($contenu);
$contenu($twig, null);
