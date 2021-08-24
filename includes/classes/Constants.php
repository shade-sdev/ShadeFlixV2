<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/Dotenv.php");

$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'] . "/.env");
$dotenv->load();

class Constants
{
    public static $host = "localhost";
    public static $username = "root";
    public static $password = "";
    public static $database = "ShadeFlix";
    public static $tmdbapi;
    public static $yggid;
    public static $yggpass;
    public static $torrent9domain;
    public static $yggdomain;
}

Constants::$tmdbapi = getenv('TMDB_API_KEY');
Constants::$yggid = getenv('YGGTORRENT_USERNAME');
Constants::$yggpass = getenv('YGGTORRENT_PASSWORD');
Constants::$torrent9domain = getenv('TORRENT9_DOMAIN');
Constants::$yggdomain = getenv('YGGTORRENT_DOMAIN');
