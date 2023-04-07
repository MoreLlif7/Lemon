<?php
function accueilController($twig, $db)
{
    $req = $db['BASE_URL'] . '/discover/movie?api_key=' . $db['API_KEY'] . '&language=fr-FR&sort_by=popularity.desc&page=1';


    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', $req, [
        'verify' => false,
    ]);


    $json = json_decode($res->getBody()->getContents(), true);
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

    if (isset($_POST['Recherche'])) {
        $inputTest = $_POST['inputTitle'];

        $req = $db['SEARCH_FILM'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $inputTest;

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);

        foreach ($json["results"] as $f) {
            array_push($films, $f);
        }
    }


    echo $twig->render('film.html.twig', ['films' => $films,]);
}

function showController($twig, $db)
{
    $show = [];

    if (isset($_POST['Recherche'])) {
        $inputTest = $_POST['inputTitle'];

        $req = $db['SEARCH_SHOW'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $inputTest;

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);

        foreach ($json["results"] as $s) {
            array_push($show, $s);
        }
    }


    echo $twig->render('show.html.twig', ['show' => $show,]);
}

function acteurController($twig, $db)
{
    $acteur = [];

    if (isset($_POST['Recherche'])) {
        $inputTest = $_POST['inputTitle'];

        $req = $db['SEARCH_ACTEUR'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $inputTest;

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);

        foreach ($json["results"] as $a) {
            array_push($acteur, $a);
        }
    }


    echo $twig->render('acteur.html.twig', ['acteur' => $acteur,]);
}
