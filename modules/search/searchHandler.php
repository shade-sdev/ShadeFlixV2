<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/ScrapSearch.php");



if (isset($_GET['searchQuery'])) {
    $searchQuery = $_GET['searchQuery'];
    $SS = new ScrapSearch();
    $result = $SS->searchAll($searchQuery);
}

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $SS = new ScrapSearch();
    $result = $SS->getMagnet($url);
}
