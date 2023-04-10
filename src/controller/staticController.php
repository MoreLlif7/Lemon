<?php


function accueilController($twig, $db)
{
    $json = callAPI("base", $db, null);
    $films = [];


    foreach ($json["results"] as $f) {
        array_push($films, $f);
    }

    echo $twig->render('accueil.html.twig', [
        'films' => $films,
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


    echo $twig->render('acteur.html.twig', ['acteur' => $acteur, 'error' => $err]);
}


function detailFilmController($twig, $db)
{

    $err = "";
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $req = $db['SEARCH_DETAIL_FILM'] . '/' . $id . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
        $reqV = $db['SEARCH_DETAIL_FILM'] . '/' . $id . '/videos' . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);
        $resV = $client->request('GET', $reqV, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);
        $jsonV = json_decode($resV->getBody()->getContents(), true);

        if (isset($json['status_code']) && $json['status_code'] == 34) {
            $err = "404 Unfound";
        }

        if (isset($jsonV['status_code']) && $jsonV['status_code'] == 34) {
            $err = "404 Unfound";
        }
    }


    echo $twig->render('detailFilm.html.twig', ['detail' => $json, 'err' => $err, 'video' => $jsonV['results'][0]['key']]);
}

function detailShowController($twig, $db)
{
    $err = "";
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $req = $db['SEARCH_DETAIL_SHOW'] . '/' . $id . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
        $reqV = $db['SEARCH_DETAIL_SHOW'] . '/' . $id . '/videos' . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);
        $resV = $client->request('GET', $reqV, [
            'verify' => false,
        ]);


        $json = json_decode($res->getBody()->getContents(), true);
        $jsonV = json_decode($resV->getBody()->getContents(), true);

        if (isset($json['status_code']) && $json['status_code'] == 34) {
            $err = "404 Unfound";
        }
        if (isset($jsonV['status_code']) && $jsonV['status_code'] == 34) {
            $err = "404 Unfound";
        }
    }
    echo $twig->render('detailShow.html.twig', ['detail' => $json, 'err' => $err, 'video' => $jsonV['results'][0]['key']]);
}
