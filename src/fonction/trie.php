<?php
function trieShow($change)
{
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
    return $change;
}

function trieFilm($change)
{
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
    return $change;
}
