<?php

function callAPI($api, $db, $search)
{
    switch ($api) {
        case 'base':
            $req = $db['BASE_URL'] . '/discover/movie?api_key=' . $db['API_KEY'] . '&language=fr-FR&sort_by=popularity.desc';
            break;
        case 'film':
            $req = $db['SEARCH_FILM'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $search;
            break;
        case 'show':
            $req = $db['SEARCH_SHOW'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $search;
            break;
        case 'acteur':
            $req = $db['SEARCH_ACTEUR'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR' . '&query=' . $search;
            break;
        case 'genre':
            $req = $db['GENRE'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
            break;
        default:
            $req = "";
            break;
    }
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', $req, [
        'verify' => false,
    ]);

    $json = json_decode($res->getBody()->getContents(), true);

    return $json;
}

function callAPIDTL($api, $db, $search)
{
    switch ($api) {
        case 'film':
            $req = $db['SEARCH_DETAIL_FILM'] . '/' . $search . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
            $reqV = $db['SEARCH_DETAIL_FILM'] . '/' . $search . '/videos' . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
            break;
        case 'show':
            $req = $db['SEARCH_DETAIL_SHOW'] . '/' . $search . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
            $reqV = $db['SEARCH_DETAIL_SHOW'] . '/' . $search . '/videos' . '?api_key=' . $db['API_KEY'] . '&language=fr-FR';
            break;
        default:
            $req = "";
            $reqV = "";
            break;
    }

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', $req, [
        'verify' => false,
    ]);
    $resV = $client->request('GET', $reqV, [
        'verify' => false,
    ]);

    $json = json_decode($res->getBody()->getContents(), true);
    $jsonV = json_decode($resV->getBody()->getContents(), true);

    return [$json, $jsonV];
}

function testVide($json)
{
    $bool = false;
    if ($json['total_results'] == 0) {
        $bool = true;
    }
    return $bool;
}

function callAPIGenre($id, $db)
{
    $req  = $db['SEARCH_GENRE'] . '?api_key=' . $db['API_KEY'] . '&language=fr-FR&with_genres=' . $id;
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', $req, [
        'verify' => false,
    ]);


    $json = json_decode($res->getBody()->getContents(), true);
    return $json['results'];
}
