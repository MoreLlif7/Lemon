<?php
// On peut utiliser aussi des bibliothèque comme FastRoute https://github.com/nikic/FastRoute (mais je vais en faire un a la main)
function getPage()
{
    $lesPages['accueil'] = "accueilController";
    $lesPages['film'] = "filmController";
    $lesPages['show'] = "showController";
    $lesPages['acteur'] = "acteurController";

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
