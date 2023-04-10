<?php


function accueilController($twig, $db)
{
    $films = [];
    if (isset($_GET['genre'])) {
        $id = htmlspecialchars($_GET['genre']);
        $films = callAPIGenre($id, $db);
    } else {
        $json = callAPI("base", $db, null);
        foreach ($json["results"] as $f) {
            array_push($films, $f);
        }
    }
    $genre = callAPI("genre", $db, null);


    echo $twig->render('accueil.html.twig', [
        'films' => $films,
        'genre' => $genre,
    ]);
}

function filmController($twig, $db)
{

    $films = [];
    $err = "";
    if (isset($_POST['Recherche'])) {
        $inputTest = htmlspecialchars($_POST['inputTitle']);

        ajouterLog('Film', $inputTest);
        $json = callAPI('film', $db, $inputTest);

        if (testVide($json)) {
            $err = "Il n'y pas de film avec ce nom";
        } else {
            foreach ($json["results"] as $f) {
                array_push($films, $f);
            }
        }
        $_SESSION['films'] = $films;
    }

    if (isset($_POST['Trie'])) {
        $change = $_SESSION['films'];
        $films = trieFilm($change);
    }

    if (isset($json['status_code']) && $json['status_code'] == 34) {
        $err = "404 Unfound";
    }


    echo $twig->render('film.html.twig', ['films' => $films, 'error' => $err]);
}

function showController($twig, $db)
{
    $show = [];
    $err = "";
    if (isset($_POST['Recherche'])) {
        $inputTest =  htmlspecialchars($_POST['inputTitle']);
        ajouterLog('Show', $inputTest);
        $json = callAPI('show', $db, $inputTest);

        if (testVide($json)) {
            $err = "Il n'y pas de show avec ce nom";
        } else {
            foreach ($json["results"] as $s) {
                array_push($show, $s);
            }
        }
        $_SESSION['show'] = $show;
    }

    if (isset($_POST['Trie'])) {
        $change = $_SESSION['show'];
        $show = trieShow($change);
    }

    if (isset($json['status_code']) && $json['status_code'] == 34) {
        $err = "404 Unfound";
    }

    echo $twig->render('show.html.twig', ['show' => $show, 'error' => $err]);
}

function acteurController($twig, $db)
{
    $acteur = [];
    $err = "";
    if (isset($_POST['Recherche'])) {
        $inputTest = htmlspecialchars($_POST['inputTitle']);
        ajouterLog('Acteur', $inputTest);
        $json = callAPI('acteur', $db, $inputTest);
        if (testVide($json)) {
            $err = "Il n'y pas de d'acteur avec ce nom";
        } else {
            foreach ($json["results"] as $a) {
                array_push($acteur, $a);
            }
        }
    }

    if (isset($json['status_code']) && $json['status_code'] == 34) {
        $err = "404 Unfound";
    }

    echo $twig->render('acteur.html.twig', ['acteur' => $acteur, 'error' => $err]);
}


function detailFilmController($twig, $db)
{

    $err = "";
    if (isset($_GET["id"])) {
        $id = htmlspecialchars($_GET['id']);
        $tabJSON = callAPIDTL('film', $db, $id);

        if (isset($json['status_code']) && $json['status_code'] == 34) {
            $err = "404 Unfound";
        }

        if (isset($jsonV['status_code']) && $jsonV['status_code'] == 34) {
            $err = "404 Unfound";
        }
    }


    echo $twig->render('detailFilm.html.twig', ['detail' => $tabJSON[0], 'err' => $err, 'video' => $tabJSON[1]['results'][0]['key']]);
}

function detailShowController($twig, $db)
{
    $err = "";
    if (isset($_GET["id"])) {
        $id = htmlspecialchars($_GET['id']);
        $tabJSON = callAPIDTL('show', $db, $id);

        if (isset($json['status_code']) && $json['status_code'] == 34) {
            $err = "404 Unfound";
        }
        if (isset($jsonV['status_code']) && $jsonV['status_code'] == 34) {
            $err = "404 Unfound";
        }
    }
    echo $twig->render('detailShow.html.twig', ['detail' => $tabJSON[0], 'err' => $err, 'video' => $tabJSON[1]['results'][0]['key']]);
}
