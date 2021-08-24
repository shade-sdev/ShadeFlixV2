<?php


require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/Dotenv.php");

$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'] . "/.env");
$dotenv->load();


if (isset($_GET['setting'])) {
    $env = array('TMDB_API_KEY' => $_GET['TMDB_API_KEY'], 'YGGTORRENT_USERNAME' => $_GET['YGGTORRENT_USERNAME'], 'YGGTORRENT_PASSWORD' => $_GET['YGGTORRENT_PASSWORD'], 'TORRENT9_DOMAIN' => $_GET['TORRENT9_DOMAIN'], 'YGGTORRENT_DOMAIN' => $_GET['YGGTORRENT_DOMAIN']);
    $dotenv->setEnvironmentValue($env);



    echo json_encode(['response' => TRUE]);
}
