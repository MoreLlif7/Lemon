<?php
function getPage()
{
    $lesPages['accueil'] = "accueilController";

    // on peut aussi utiliser $_SERVER['REQUEST_URI'] pour cette partie
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'accueil';
    }

    if (isset($lesPages[$page])) {
        $contenu = $lesPages[$page];
    } else {
        $contenu = $lesPages['accueil'];
    }
    return $contenu;
}
