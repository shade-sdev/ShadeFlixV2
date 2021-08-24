<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/ScrapSearch.php");

if (isset($_GET['search'])) {
    $scrapSearch = new ScrapSearch();
    $scrapSearch->search($_GET['search']);
}

if (isset($_GET['magnet'])) {
    $scrapSearch = new ScrapSearch();
    $scrapSearch->getMagnet($_GET['magnet']);
}
