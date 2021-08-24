<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/TMDB.php");


$tmdb = new TMDB();
// if ($_SESSION['email'] == '') {
// 	header("Location: login");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->

    <link rel="stylesheet" href="/assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="/assets/css/nouislider.min.css">
    <link rel="stylesheet" href="/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/plyr.css">
    <link rel="stylesheet" href="/assets/css/photoswipe.css">
    <link rel="stylesheet" href="/assets/css/default-skin.css">
    <link rel="stylesheet" href="/assets/css/main.css">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="/assets/icon/favicon-32x32.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/assets/icon/favicon-32x32.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Shade">
    <title>ShadeFlix - F NetFlix</title>
    <style>
        .showcontent {
            display: block !important;
        }
    </style>
</head>

<body class="body">

    <!-- header -->
    <header class="header">
        <?php include('navbar.php'); ?>

        <!-- header search -->
        <form class="header__search">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header__search-content">
                            <input type="text" id="searchText" placeholder="Search for a movie, TV Series that you are looking for">
                            <select id="searchType">
                                <option value="movie">Movie</option>
                                <option value="tv">TV Show</option>
                            </select>
                            <button onclick="searchRedirect()" type="button">search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- end header search -->
    </header>
    <!-- end header -->
    <section class="home">
        <!-- catalog -->
        <div class="catalog">
            <div class="container">
                <div class="row">
                    <?php
                    $movieArray = $tmdb->request("https://api.themoviedb.org/3/search/movie?api_key=" . Constants::$tmdbapi . "&language=en-US&query=" . $_GET['search'] . "&page=1");
                    $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/movie/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
                    $genreids = array();
                    foreach ($movieArray['results'] as $r) {

                        foreach ($r['genre_ids'] as $gid) {
                            array_push($genreids, $gid);
                        }
                        echo '<!-- card -->';
                        echo '<div class="col-4 col-sm-4 col-lg-3 col-xl-2.5">' . PHP_EOL;
                        echo '<div class="card">' . PHP_EOL;
                        echo '<div class="card__cover">' . PHP_EOL;
                        echo '<img src="https://image.tmdb.org/t/p/original/' . $r['poster_path'] . '" alt="">' . PHP_EOL;
                        echo '<a href="/movie/view/' . $r['id'] . '" class="card__play">' . PHP_EOL;
                        echo '<i class="icon ion-ios-play"></i>' . PHP_EOL;
                        echo '</a>' . PHP_EOL;
                        echo '</div>' . PHP_EOL;
                        echo '<div class="card__content">' . PHP_EOL;
                        echo '<h3 class="card__title"><a href="/movie/view/' . $r['id'] . '">' . $r['title'] . '</a></h3>' . PHP_EOL;
                        echo '<span class="card__category">' . PHP_EOL;
                        echo '<a href="#">' . $tmdb->getGenres($genresArray['genres'], $genreids) . '</a>' . PHP_EOL;
                        echo '</span>' . PHP_EOL;
                        echo '<span class="card__rate"><i class="icon ion-ios-star"></i>' . $r['vote_average'] . '</span>' . PHP_EOL;
                        echo '</div>' . PHP_EOL;
                        echo '</div>' . PHP_EOL;
                        echo '</div>' . PHP_EOL;
                        echo '<!-- end card -->';
                        $genreids = array();
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- end catalog -->
    </section>


    <?php include('footer.php'); ?>




    <!-- JS -->
    <script src="/assets/js/jquery-3.5.1.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.mousewheel.min.js"></script>
    <script src="/assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="/assets/js/wNumb.js"></script>
    <script src="/assets/js/nouislider.min.js"></script>
    <script src="/assets/js/plyr.min.js"></script>
    <script src="/assets/js/jquery.morelines.min.js"></script>
    <script src="/assets/js/photoswipe.min.js"></script>
    <script src="/assets/js/photoswipe-ui-default.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <?php

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    if (strpos($url, 'movie/view/') !== false) {
        echo '<script src="https://cdn.jsdelivr.net/npm/@webtor/embed-sdk-js/dist/index.min.js" charset="utf-8" async></script>' . PHP_EOL;
        echo '<script src="/modules/scrapper/scrap.js"></script>' . PHP_EOL;
    }

    ?>

</body>


</html>