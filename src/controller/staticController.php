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
    $fichierLog = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'data.log';

    $films = [];
    $err = "";
    if (isset($_POST['Recherche'])) {
        $inputTest = $_POST['inputTitle'];
        $log = date('d-m-Y H:i:s') . ' Film : ' . $inputTest . PHP_EOL;

        if (file_exists($fichierLog)) {
            file_put_contents($fichierLog, $log, FILE_APPEND);
        } else {
            file_put_contents($fichierLog, $log);
        }

        $req = $db['SEARCH_FILM'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $inputTest;

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);

        if ($json['total_results'] == 0) {
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
        if (isset($_POST['note'])) {
            if ($_POST['note'] == 'desc') {
                usort($change, function ($a, $b) {
                    if ($a['vote_average'] == $b['vote_average']) {
                        return 0;
                    } else if ($a['vote_average'] > $b['vote_average']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            } else {
                usort($change, function ($a, $b) {
                    if ($a['vote_average'] == $b['vote_average']) {
                        return 0;
                    } else if ($a['vote_average'] < $b['vote_average']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        }
        if (isset($_POST['sortie'])) {
            if ($_POST['sortie'] == 'desc') {
                usort($change, function ($a, $b) {
                    if ($a['release_date'] == $b['release_date']) {
                        return 0;
                    } else if ($a['release_date'] > $b['release_date']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            } else {
                usort($change, function ($a, $b) {
                    if ($a['release_date'] == $b['release_date']) {
                        return 0;
                    } else if ($a['release_date'] < $b['release_date']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        }
        if (isset($_POST['popularite'])) {
            if ($_POST['popularite'] == 'desc') {
                usort($change, function ($a, $b) {
                    if ($a['popularity'] == $b['popularity']) {
                        return 0;
                    } else if ($a['popularity'] > $b['popularity']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            } else {
                usort($change, function ($a, $b) {
                    if ($a['popularity'] == $b['popularity']) {
                        return 0;
                    } else if ($a['popularity'] < $b['popularity']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        }
        $films = $change;
    }


    echo $twig->render('film.html.twig', ['films' => $films, 'error' => $err]);
}

function showController($twig, $db)
{
    $fichierLog = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'data.log';
    $show = [];
    $err = "";
    if (isset($_POST['Recherche'])) {
        $inputTest = $_POST['inputTitle'];
        $log = date('d-m-Y H:i:s') . ' Série : ' . $inputTest . PHP_EOL;

        if (file_exists($fichierLog)) {
            file_put_contents($fichierLog, $log, FILE_APPEND);
        } else {
            file_put_contents($fichierLog, $log);
        }

        $req = $db['SEARCH_SHOW'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $inputTest;

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);
        if ($json['total_results'] == 0) {
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
        if (isset($_POST['note'])) {
            if ($_POST['note'] == 'desc') {
                usort($change, function ($a, $b) {
                    if ($a['vote_average'] == $b['vote_average']) {
                        return 0;
                    } else if ($a['vote_average'] > $b['vote_average']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            } else {
                usort($change, function ($a, $b) {
                    if ($a['vote_average'] == $b['vote_average']) {
                        return 0;
                    } else if ($a['vote_average'] < $b['vote_average']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        }
        if (isset($_POST['sortie'])) {
            if ($_POST['sortie'] == 'desc') {
                usort($change, function ($a, $b) {
                    if ($a['first_air_date'] == $b['first_air_date']) {
                        return 0;
                    } else if ($a['first_air_date'] > $b['first_air_date']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            } else {
                usort($change, function ($a, $b) {
                    if ($a['first_air_date'] == $b['first_air_date']) {
                        return 0;
                    } else if ($a['first_air_date'] < $b['first_air_date']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        }
        if (isset($_POST['popularite'])) {
            if ($_POST['popularite'] == 'desc') {
                usort($change, function ($a, $b) {
                    if ($a['popularity'] == $b['popularity']) {
                        return 0;
                    } else if ($a['popularity'] > $b['popularity']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            } else {
                usort($change, function ($a, $b) {
                    if ($a['popularity'] == $b['popularity']) {
                        return 0;
                    } else if ($a['popularity'] < $b['popularity']) {
                        return -1;
                    } else {
                        return 1;
                    }
                });
            }
        }
        $show = $change;
    }

    echo $twig->render('show.html.twig', ['show' => $show, 'error' => $err]);
}

function acteurController($twig, $db)
{
    $fichierLog = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'data.log';
    $acteur = [];
    $err = "";
    if (isset($_POST['Recherche'])) {
        $inputTest = $_POST['inputTitle'];
        $log = date('d-m-Y H:i:s') . ' Acteur : ' . $inputTest . PHP_EOL;

        if (file_exists($fichierLog)) {
            file_put_contents($fichierLog, $log, FILE_APPEND);
        } else {
            file_put_contents($fichierLog, $log);
        }

        $req = $db['SEARCH_ACTEUR'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $inputTest;

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);
        if ($json['total_results'] == 0) {
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
    $dtl = [];
    $err = "";
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $req = $db['SEARCH_DETAIL_FILM'] . '/' . $id . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);

        if ($json['original_title'] == null) {
            $err = "404 Unfound";
        } else {
            foreach ($json as $d) {
                array_push($dtl, $d);
            }
        }
    }
    echo $twig->render('detailFilm.html.twig', ['detail' => $dtl, 'err' => $err]);
}

function detailShowController($twig, $db)
{
    $dtl = [];
    $err = "";
    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $req = $db['SEARCH_DETAIL_SHOW'] . '/' . $id . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';

        $client = new GuzzleHttp\Client();
        $res = $client->request('GET', $req, [
            'verify' => false,
        ]);

        $json = json_decode($res->getBody()->getContents(), true);

        if ($json['original_name'] == null) {
            $err = "404 Unfound";
        } else {
            foreach ($json as $d) {
                array_push($dtl, $d);
            }
        }
    }

    echo $twig->render('detailShow.html.twig', ['detail' => $dtl, 'err' => $err]);
}
