<?php
function accueilController($twig)
{
    echo $twig->render('accueil.html.twig', []);
}
