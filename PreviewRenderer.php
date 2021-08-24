<?php

$count = count($_GET);

switch ($count) {
    case 0:

        $movieArray = $tmdb->request("https://api.themoviedb.org/3/movie/popular?api_key=" . Constants::$tmdbapi . "&page=1");
        $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/movie/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
        $genreids = array();



        echo '<section class="home">';
        echo '<!-- expected premiere -->';
        echo '<section class="section">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<!-- section title -->';
        echo '<div class="col-12">';
        echo '<h2 class="section__title">Movies</h2>';
        echo '</div>';
        echo '<!-- end section title -->';
        echo '';
        echo '';
        echo '';
        echo '<!-- card -->';
        $i = 0;
        foreach ($movieArray['results'] as $r) {
            $i++;
            foreach ($r['genre_ids'] as $gid) {
                array_push($genreids, $gid);
            }

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
            $genreids = array();
            if ($i == 8) {
                break;
            }
        }
        echo '<!-- end card -->';
        echo '';
        echo '';
        echo '';
        echo '</div>';
        echo '</div>';
        echo '</section>';
        echo '<!-- end expected premiere -->';
        echo '';


        $movieArray = $tmdb->request("https://api.themoviedb.org/3/tv/popular?api_key=" . Constants::$tmdbapi . "&page=1");
        $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/tv/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
        $genreids = array();




        echo '<!-- expected premiere -->';
        echo '<section class="section">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<!-- section title -->';
        echo '<div class="col-12">';
        echo '<h2 class="section__title">TV Shows</h2>';
        echo '</div>';
        echo '<!-- end section title -->';
        echo '';
        echo '';
        echo '';
        echo '<!-- card -->';
        $i = 0;
        foreach ($movieArray['results'] as $r) {
            $i++;
            foreach ($r['genre_ids'] as $gid) {
                array_push($genreids, $gid);
            }

            echo '<div class="col-4 col-sm-4 col-lg-3 col-xl-2.5">' . PHP_EOL;
            echo '<div class="card">' . PHP_EOL;
            echo '<div class="card__cover">' . PHP_EOL;
            echo '<img src="https://image.tmdb.org/t/p/original/' . $r['poster_path'] . '" alt="">' . PHP_EOL;
            echo '<a href="/tv/view/' . $r['id'] . '" class="card__play">' . PHP_EOL;
            echo '<i class="icon ion-ios-play"></i>' . PHP_EOL;
            echo '</a>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<div class="card__content">' . PHP_EOL;
            echo '<h3 class="card__title"><a href="/tv/view/' . $r['id'] . '">' . $r['name'] . '</a></h3>' . PHP_EOL;
            echo '<span class="card__category">' . PHP_EOL;
            echo '<a href="#">' . $tmdb->getGenres($genresArray['genres'], $genreids) . '</a>' . PHP_EOL;
            echo '</span>' . PHP_EOL;
            echo '<span class="card__rate"><i class="icon ion-ios-star"></i>' . $r['vote_average'] . '</span>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            $genreids = array();
            if ($i == 8) {
                break;
            }
        }
        echo '<!-- end card -->';
        echo '';
        echo '';
        echo '';
        echo '</div>';
        echo '</div>';
        echo '</section>';
        echo '<!-- end expected premiere -->';
        echo '';
        echo '';
        echo '';
        echo '';
        echo '</section>';

        break;

    case 1:
        if ($count == 1 && isset($_GET['movieview'])) {
            $genres = "";
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/movie/" . $_GET['movieview'] . "?api_key=" . Constants::$tmdbapi . "&language=en-US");
            foreach ($movieArray['genres'] as $genreitem) {
                $genres .= $genreitem['name'] . ", ";
            }
            $genres = rtrim($genres, ", ");

            echo '';
            echo '<section class="section details">' . PHP_EOL;
            echo '';
            echo '<div class="details__bg" data-bg="https://image.tmdb.org/t/p/original/' . $movieArray['backdrop_path'] . '"></div>' . PHP_EOL;
            echo '';
            echo '';
            echo '';
            echo '<div class="container">' . PHP_EOL;
            echo '<div class="row">' . PHP_EOL;
            echo '<!-- title -->' . PHP_EOL;
            echo '<div class="col-12">' . PHP_EOL;
            echo '<h1 id="getTitle" class="details__title">' . $movieArray['title'] . '</h1>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '<div class="col-12 col-xl-6">' . PHP_EOL;
            echo '<div class="card card--details">' . PHP_EOL;
            echo '<div class="row">' . PHP_EOL;
            echo '<!-- card cover -->' . PHP_EOL;
            echo '<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">' . PHP_EOL;
            echo '<div class="card__cover">' . PHP_EOL;
            echo '<img src="https://image.tmdb.org/t/p/original/' . $movieArray['poster_path'] . '" alt="">' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '';
            echo '';
            echo '<div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">' . PHP_EOL;
            echo '<div class="card__content">' . PHP_EOL;
            echo '<div class="card__wrap">' . PHP_EOL;
            echo '<span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>' . PHP_EOL;
            echo '';
            echo '<ul class="card__list">' . PHP_EOL;
            echo '<li>HD</li>' . PHP_EOL;
            echo '</ul>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '<ul class="card__meta">' . PHP_EOL;
            echo '<li><span>Genre:</span> <a href="#">' . $genres . '</a>' . PHP_EOL;
            echo '<li><span>Release Date:</span> ' . $movieArray['release_date'] . '</li>' . PHP_EOL;
            echo '<li><span>Running time:</span> ' . $movieArray['runtime'] . ' min</li>' . PHP_EOL;
            echo '<li><span>Country:</span> <a href="#">' . $movieArray['production_countries'][0]['name'] . '</a> </li>' . PHP_EOL;
            echo '</ul>' . PHP_EOL;
            echo '';
            echo '<div class="card__description card__description--details">' . PHP_EOL;
            echo $movieArray['overview'];
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '';
            echo '<!-- player -->' . PHP_EOL;
            echo '<div id="player" style="" class="col-12 col-xl-6">' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- player end -->';
            echo '<div class="col-12">';
            echo '<div class="details__wrap">';
            echo '<!-- availables -->';
            echo '<div class="details__devices">';
            echo '<span class="details__devices-title">Downloads:</span>';
            echo '<ul class="details__devices-list">';
            echo '<li><a id="magnetPlaceholder"><i class="icon ion-ios-magnet"></i></a><span>Magnet</span></li>';
            echo '</ul>';
            echo '</div>';
            echo '<!-- end availables -->';
            echo '';
            echo '<div class="details__share">' . PHP_EOL;
            echo '<span class="details__share-title">Share with friends:</span>' . PHP_EOL;
            echo '';
            echo '<ul class="details__share-list">' . PHP_EOL;
            echo '<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>' . PHP_EOL;
            echo '<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>' . PHP_EOL;
            echo '<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>' . PHP_EOL;
            echo '<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>' . PHP_EOL;
            echo '</ul>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '</section>' . PHP_EOL;
            echo '';
        } else

        if ($count == 1 && isset($_GET['moviepage'])) {
            echo '<section class="home">' . PHP_EOL;
            echo '<div class="catalog">' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<div id="movieHolder" class="row">' . PHP_EOL;
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/movie/now_playing?api_key=" . Constants::$tmdbapi . "&page=" . $_GET['moviepage'] . "");
            $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/movie/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
            $genreids = array();
            $totalPages = $movieArray['total_pages'];
            $currentPage = $_GET['moviepage'];
            foreach ($movieArray['results'] as $r) {

                foreach ($r['genre_ids'] as $gid) {
                    array_push($genreids, $gid);
                }

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
                $genreids = array();
            }

            echo '</div>' . PHP_EOL;
            echo '<div id="pagination" class="col-12">' . PHP_EOL;
            echo '<ul class="paginator">' . PHP_EOL;

            if ($currentPage == 1) {

                echo '<li class="paginator__item paginator__item--active"><a href="#">' . $currentPage . '</a></li>' . PHP_EOL;
                for ($i = ($currentPage + 1); $i <= ($currentPage + 5); $i++) {
                    if ($i <= $totalPages) {
                        echo '<li class="paginator__item"><a href="/movie/page/' . $i . '">' . $i . '</a></li>' . PHP_EOL;
                    }
                }
                echo '<li class="paginator__item"><a href="/movie/page/' . ($totalPages) . '">' . ($totalPages) . '</a></li>' . PHP_EOL;
                echo '<li class="paginator__item paginator__item--next">' . PHP_EOL;
                echo '<a href="/movie/page/' . ($currentPage + 1) . '"><i class="icon ion-ios-arrow-forward"></i></a>' . PHP_EOL;
                echo '</li>' . PHP_EOL;
            } else
            if ($currentPage > 1) {



                echo '<li class="paginator__item paginator__item--prev">';
                echo '<a href="/movie/page/' . ($currentPage - 1) . '"><i class="icon ion-ios-arrow-back"></i></a>';
                echo '</li>';
                echo '<li class="paginator__item"><a href="/movie/page/1">1</a></li>' . PHP_EOL;
                echo '<li class="paginator__item paginator__item--active"><a href="#">' . $currentPage . '</a></li>' . PHP_EOL;
                for ($i = ($currentPage + 1); $i < ($currentPage + 4); $i++) {
                    if ($i < $totalPages && $currentPage != $totalPages) {
                        echo '<li class="paginator__item"><a href="/movie/page/' . $i . '">' . $i . '</a></li>' . PHP_EOL;
                    }
                }

                if ($currentPage != $totalPages) {
                    echo '<li class="paginator__item"><a href="/movie/page/' . ($totalPages) . '">' . ($totalPages) . '</a></li>' . PHP_EOL;
                    echo '<li class="paginator__item paginator__item--next">' . PHP_EOL;
                    echo '<a href="/movie/page/' . ($currentPage + 1) . '"><i class="icon ion-ios-arrow-forward"></i></a>' . PHP_EOL;
                    echo '</li>' . PHP_EOL;
                }
            }




            echo '</ul>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</section>' . PHP_EOL;
        } else
        if ($count == 1 && isset($_GET['customsearch'])) {
            if ($_GET['customsearch'] == 'torrent9') {
                echo '<br> <br> <br> <br> <br> <br>';
                echo '<div>';
                echo '';
                echo '<!-- header search -->';
                echo '<form action="#" class="">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-12">';
                echo '<div class="header__search-content">';
                echo '<input id="searchQuery" type="text" placeholder="Search for a movie, TV Series that you are looking for">';
                echo '';
                echo '<button id="search" type="button">search</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
                echo '<!-- end header search -->';
                echo '</div>';
                echo '';
                echo '<div id="searchResultsContainer" class="container">';
                echo '';
                echo '';
                echo '</div>';
                echo '<br> <br> <br> <br> <br> <br>';
            } else
            if ($_GET['customsearch'] == 'yggtorrent') {
                echo '<br> <br> <br> <br> <br> <br>';
                echo '<div>';
                echo '';
                echo '<!-- header search -->';
                echo '<form action="#" class="">';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-12">';
                echo '<div class="header__search-content">';
                echo '<input id="searchQuery" type="text" placeholder="Search for a movie, TV Series that you are looking for">';
                echo '';
                echo '<button id="search" type="button">search</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</form>';
                echo '<!-- end header search -->';
                echo '</div>';
                echo '';
                echo '<div id="searchResultsContainer" class="container">';
                echo '';
                echo '';
                echo '</div>';
                echo '<br> <br> <br> <br> <br> <br>';
            }
        } else

        if ($count == 1 && isset($_GET['tvpage'])) {
            echo '<section class="home">' . PHP_EOL;
            echo '<div class="catalog">' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<div id="movieHolder" class="row">' . PHP_EOL;
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/tv/on_the_air?api_key=" . Constants::$tmdbapi . "&language=en-US&page=" . $_GET['tvpage']);
            $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/tv/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
            $genreids = array();
            $totalPages = $movieArray['total_pages'];
            $currentPage = $_GET['tvpage'];
            foreach ($movieArray['results'] as $r) {

                foreach ($r['genre_ids'] as $gid) {
                    array_push($genreids, $gid);
                }

                echo '<div class="col-4 col-sm-4 col-lg-3 col-xl-2.5">' . PHP_EOL;
                echo '<div class="card">' . PHP_EOL;
                echo '<div class="card__cover">' . PHP_EOL;
                echo '<img src="https://image.tmdb.org/t/p/original/' . $r['poster_path'] . '" alt="">' . PHP_EOL;
                echo '<a href="/tv/view/' . $r['id'] . '" class="card__play">' . PHP_EOL;
                echo '<i class="icon ion-ios-play"></i>' . PHP_EOL;
                echo '</a>' . PHP_EOL;
                echo '</div>' . PHP_EOL;
                echo '<div class="card__content">' . PHP_EOL;
                echo '<h3 class="card__title"><a href="/tv/view/' . $r['id'] . '">' . $r['name'] . '</a></h3>' . PHP_EOL;
                echo '<span class="card__category">' . PHP_EOL;
                echo '<a href="#">' . $tmdb->getGenres($genresArray['genres'], $genreids) . '</a>' . PHP_EOL;
                echo '</span>' . PHP_EOL;
                echo '<span class="card__rate"><i class="icon ion-ios-star"></i>' . $r['vote_average'] . '</span>' . PHP_EOL;
                echo '</div>' . PHP_EOL;
                echo '</div>' . PHP_EOL;
                echo '</div>' . PHP_EOL;
                $genreids = array();
            }

            echo '</div>' . PHP_EOL;
            echo '<div id="pagination" class="col-12">' . PHP_EOL;
            echo '<ul class="paginator">' . PHP_EOL;

            if ($currentPage == 1) {

                echo '<li class="paginator__item paginator__item--active"><a href="#">' . $currentPage . '</a></li>' . PHP_EOL;
                for ($i = ($currentPage + 1); $i <= ($currentPage + 5); $i++) {
                    if ($i <= $totalPages) {
                        echo '<li class="paginator__item"><a href="/tv/page/' . $i . '">' . $i . '</a></li>' . PHP_EOL;
                    }
                }
                echo '<li class="paginator__item"><a href="/tv/page/' . ($totalPages) . '">' . ($totalPages) . '</a></li>' . PHP_EOL;
                echo '<li class="paginator__item paginator__item--next">' . PHP_EOL;
                echo '<a href="/tv/page/' . ($currentPage + 1) . '"><i class="icon ion-ios-arrow-forward"></i></a>' . PHP_EOL;
                echo '</li>' . PHP_EOL;
            } else
            if ($currentPage > 1) {



                echo '<li class="paginator__item paginator__item--prev">';
                echo '<a href="/tv/page/' . ($currentPage - 1) . '"><i class="icon ion-ios-arrow-back"></i></a>';
                echo '</li>';
                echo '<li class="paginator__item"><a href="/tv/page/1">1</a></li>' . PHP_EOL;
                echo '<li class="paginator__item paginator__item--active"><a href="#">' . $currentPage . '</a></li>' . PHP_EOL;
                for ($i = ($currentPage + 1); $i < ($currentPage + 4); $i++) {
                    if ($i < $totalPages && $currentPage != $totalPages) {
                        echo '<li class="paginator__item"><a href="/tv/page/' . $i . '">' . $i . '</a></li>' . PHP_EOL;
                    }
                }

                if ($currentPage != $totalPages) {
                    echo '<li class="paginator__item"><a href="/tv/page/' . ($totalPages) . '">' . ($totalPages) . '</a></li>' . PHP_EOL;
                    echo '<li class="paginator__item paginator__item--next">' . PHP_EOL;
                    echo '<a href="/tv/page/' . ($currentPage + 1) . '"><i class="icon ion-ios-arrow-forward"></i></a>' . PHP_EOL;
                    echo '</li>' . PHP_EOL;
                }
            }




            echo '</ul>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</section>' . PHP_EOL;
        } else

        if ($count == 1 && isset($_GET['tview'])) {
            $genres = "";
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/tv/" . $_GET['tview'] . "?api_key=" . Constants::$tmdbapi . "&language=en-US");
            foreach ($movieArray['genres'] as $genreitem) {
                $genres .= $genreitem['name'] . ", ";
            }
            $genres = rtrim($genres, ", ");
            $numberseasons = $movieArray['number_of_seasons'];

            echo '<!-- details -->' . PHP_EOL;
            echo '<section class="section details">' . PHP_EOL;
            echo '<!-- details background -->' . PHP_EOL;
            echo '<div class="details__bg" data-bg="https://image.tmdb.org/t/p/original/' . $movieArray['backdrop_path'] . '"></div>' . PHP_EOL;
            echo '<!-- end details background -->' . PHP_EOL;
            echo '';
            echo '<!-- details content -->' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<div class="row">' . PHP_EOL;
            echo '<!-- title -->' . PHP_EOL;
            echo '<div class="col-12">' . PHP_EOL;
            echo '<h1 class="details__title">' . $movieArray['name'] . '</h1>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- end title -->' . PHP_EOL;
            echo '';
            echo '<!-- content -->' . PHP_EOL;
            echo '<div class="col-10">' . PHP_EOL;
            echo '<div class="card card--details card--series">' . PHP_EOL;
            echo '<div class="row">' . PHP_EOL;
            echo '<!-- card cover -->' . PHP_EOL;
            echo '<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3">' . PHP_EOL;
            echo '<div class="card__cover">' . PHP_EOL;
            echo '<img src="https://image.tmdb.org/t/p/original/' . $movieArray['poster_path'] . '" alt="">' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- end card cover -->' . PHP_EOL;
            echo '' . PHP_EOL;
            echo '<!-- card content -->' . PHP_EOL;
            echo '<div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9">' . PHP_EOL;
            echo '<div class="card__content">' . PHP_EOL;
            echo '<div class="card__wrap">' . PHP_EOL;
            echo '<span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>' . PHP_EOL;
            echo '' . PHP_EOL;
            echo '<ul class="card__list">' . PHP_EOL;
            echo '<li>SD</li>' . PHP_EOL;
            echo '</ul>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '<ul class="card__meta">' . PHP_EOL;
            echo '<li><span>Genre:</span> <a href="#">' . $genres . '</a>' . PHP_EOL;
            echo '</li>' . PHP_EOL;
            echo '<li><span>Release Date:</span> ' . $movieArray['first_air_date'] . '</li>' . PHP_EOL;
            echo '<li><span>Running time:</span> ' . $movieArray['episode_run_time'][0] . ' min</li>' . PHP_EOL;
            echo '<li><span>Country:</span> <a href="#">' . $movieArray['production_countries'][0]['name'] . '</a> </li>' . PHP_EOL;
            echo '</ul>' . PHP_EOL;
            echo '';
            echo '<div class="card__description card__description--details">' . PHP_EOL;
            echo $movieArray['overview'] . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- end card content -->' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- end content -->' . PHP_EOL;


            echo '<!-- accordion -->' . PHP_EOL;
            echo '<div class="col-12 col-xl-12">';
            echo '<div class="accordion" id="accordion">';
            for ($i = 1; $i <= $numberseasons; $i++) {
                echo '<div class="accordion__card">';
                echo '<div class="card-header" id="headingOne">';
                echo '<button type="button" data-toggle="collapse" data-target="#collapse' . $i . '"';
                echo 'aria-expanded="true" aria-controls="collapse' . $i . '">';
                echo '<span>Season: ' . $i . '</span>';
                echo '<span>' . $movieArray['seasons'][$i - 1]['episode_count'] . ' Episodes from ' . $movieArray['seasons'][$i - 1]['air_date'] . '</span>';
                echo '</button>';
                echo '</div>';
                echo '';
                echo '<div id="collapse' . $i . '" class="collapse" aria-labelledby="headingOne"';
                echo 'data-parent="#accordion">';
                echo '<div class="card-body">';
                echo '<table class="accordion__list">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '</tr>';
                echo '</thead>';
                echo '';
                echo '<tbody>';
                $sanitizeName = str_replace(" ", "-", $movieArray['name']);
                for ($j = 1; $j <= $movieArray['seasons'][$i - 1]['episode_count']; $j++) {
                    echo '<tr>';
                    echo '<th><a href="/episode/view/' . $sanitizeName . '/season/' . $i . '/episode/' . $j . '">' . $j . '</a></th>';
                    echo '</tr>';
                }


                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '<!-- end accordion -->';


            echo '<div class="col-12">';
            echo '<div class="details__wrap">';
            echo '<!-- availables -->';
            echo '<div class="details__devices">';
            echo '<span class="details__devices-title">Available on devices:</span>';
            echo '<ul class="details__devices-list">';
            echo '<li><i class="icon ion-logo-apple"></i><span>IOS</span></li>';
            echo '<li><i class="icon ion-logo-android"></i><span>Android</span></li>';
            echo '<li><i class="icon ion-logo-windows"></i><span>Windows</span></li>';
            echo '<li><i class="icon ion-md-tv"></i><span>Smart TV</span></li>';
            echo '</ul>';
            echo '</div>';
            echo '<!-- end availables -->';
            echo '';
            echo '<!-- share -->';
            echo '<div class="details__share">';
            echo '<span class="details__share-title">Share with friends:</span>';
            echo '';
            echo '<ul class="details__share-list">';
            echo '<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>';
            echo '<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>';
            echo '<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>';
            echo '<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>';
            echo '</ul>';
            echo '</div>';
            echo '<!-- end share -->';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<!-- end details content -->';
            echo '</section>';
            echo '<!-- end details -->';
        } else

        if ($count == 1 && isset($_GET['setting'])) {

            $dotenv->load();



            echo '<!-- details -->' . PHP_EOL;
            echo '<section class="section details">' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<h1 class="details__title">Settings</h1>';
            echo '<form class="form form--contacts">' . PHP_EOL;
            echo '<input type="text" class="form__input" id="TMDB_API_KEY" value="' . getenv('TMDB_API_KEY') . '" placeholder="TMDB_API_KEY">' . PHP_EOL;
            echo '<input type="text" class="form__input" id="YGGTORRENT_USERNAME" value="' . getenv('YGGTORRENT_USERNAME') . '" placeholder="YGGTORRENT_USERNAME">' . PHP_EOL;
            echo '<input type="text" class="form__input" id="YGGTORRENT_PASSWORD" value="' . getenv('YGGTORRENT_PASSWORD') . '" placeholder="YGGTORRENT_PASSWORD">' . PHP_EOL;
            echo '<input type="text" class="form__input" id="TORRENT9_DOMAIN" value="' . getenv('TORRENT9_DOMAIN') . '" placeholder="TORRENT9_DOMAIN">' . PHP_EOL;
            echo '<input type="text" class="form__input" id="YGGTORRENT_DOMAIN" value="' . getenv('YGGTORRENT_DOMAIN') . '" placeholder="YGGTORRENT_DOMAIN">' . PHP_EOL;
            echo '<button type="button" id="settingBtn" class="form__btn">Send</button>' . PHP_EOL;
            echo '</form>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</section>' . PHP_EOL;
            echo '<!-- end details -->' . PHP_EOL;
        }
        break;

    case 2:
        if ($count == 2 && isset($_GET['search']) && ($_GET['type'] == 'movie')) {
            echo '<section class="home">' . PHP_EOL;
            echo '<!-- catalog -->' . PHP_EOL;
            echo '<div class="catalog">' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<div class="row">' . PHP_EOL;

            $sanitizeSearch = str_replace(" ", "%20", $_GET['search']);
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/search/movie?api_key=" . Constants::$tmdbapi . "&language=en-US&query=" . $sanitizeSearch . "&page=1");
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
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- end catalog -->' . PHP_EOL;
            echo '</section>' . PHP_EOL;
        } else

        if ($count == 2 && isset($_GET['search']) && ($_GET['type'] == 'tv')) {
            echo '<section class="home">' . PHP_EOL;
            echo '<!-- catalog -->' . PHP_EOL;
            echo '<div class="catalog">' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<div class="row">' . PHP_EOL;

            $sanitizeSearch = str_replace(" ", "%20", $_GET['search']);
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/search/tv?api_key=" . Constants::$tmdbapi . "&language=en-US&query=" . $sanitizeSearch . "&page=1");
            $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/tv/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
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
                echo '<a href="/tv/view/' . $r['id'] . '" class="card__play">' . PHP_EOL;
                echo '<i class="icon ion-ios-play"></i>' . PHP_EOL;
                echo '</a>' . PHP_EOL;
                echo '</div>' . PHP_EOL;
                echo '<div class="card__content">' . PHP_EOL;
                echo '<h3 class="card__title"><a href="/tv/view/' . $r['id'] . '">' . $r['name'] . '</a></h3>' . PHP_EOL;
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
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '<!-- end catalog -->' . PHP_EOL;
            echo '</section>' . PHP_EOL;
        } else
        if ($count == 2 && isset($_GET['genre'])) {
            echo '<section class="home">' . PHP_EOL;
            echo '<div class="catalog">' . PHP_EOL;
            echo '<div class="container">' . PHP_EOL;
            echo '<div id="movieHolder" class="row">' . PHP_EOL;
            $movieArray = $tmdb->request("https://api.themoviedb.org/3/discover/movie?api_key=" . Constants::$tmdbapi . "&language=en-US&sort_by=release_date.desc&page=" . $_GET['page'] . "&year=" . date('Y') . "&release_date.lte=" . date('Y-m-d') . "&with_genres=" . $_GET['genre']);
            $genresArray = $tmdb->request("https://api.themoviedb.org/3/genre/movie/list?api_key=" . Constants::$tmdbapi . "&language=en-US");
            $genreids = array();
            $totalPages = $movieArray['total_pages'];

            $currentPage = $_GET['page'];
            foreach ($movieArray['results'] as $r) {

                foreach ($r['genre_ids'] as $gid) {
                    array_push($genreids, $gid);
                }

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
                $genreids = array();
            }

            echo '</div>' . PHP_EOL;
            echo '<div id="pagination" class="col-12">' . PHP_EOL;
            echo '<ul class="paginator">' . PHP_EOL;

            if ($currentPage == 1) {

                echo '<li class="paginator__item paginator__item--active"><a href="/genre/' . $_GET['genre'] . '/page/' . $currentPage . '">' . $currentPage . '</a></li>' . PHP_EOL;
                for ($i = ($currentPage + 1); $i <= ($currentPage + 5); $i++) {
                    if ($i <= $totalPages) {
                        echo '<li class="paginator__item"><a href="/genre/' . $_GET['genre'] . '/page/' . $i . '">' . $i . '</a></li>' . PHP_EOL;
                    }
                }
                echo '<li class="paginator__item"><a href="/genre/' . $_GET['genre'] . '/page/' . ($totalPages) . '">' . ($totalPages) . '</a></li>' . PHP_EOL;
                echo '<li class="paginator__item paginator__item--next">' . PHP_EOL;
                echo '<a href="/genre/' . $_GET['genre'] . '/page/' . ($currentPage + 1) . '"><i class="icon ion-ios-arrow-forward"></i></a>' . PHP_EOL;
                echo '</li>' . PHP_EOL;
            } else
            if ($currentPage > 1) {



                echo '<li class="paginator__item paginator__item--prev">';
                echo '<a href="/genre/' . $_GET['genre'] . '/page/'  . ($currentPage - 1) . '"><i class="icon ion-ios-arrow-back"></i></a>';
                echo '</li>';
                echo '<li class="paginator__item"><a href="/genre/' . $_GET['genre'] . '/page/1">1</a></li>' . PHP_EOL;
                echo '<li class="paginator__item paginator__item--active"><a href="/genre/' . $_GET['genre'] . '/page/' . $currentPage . '">' . $currentPage . '</a></li>' . PHP_EOL;
                for ($i = ($currentPage + 1); $i < ($currentPage + 4); $i++) {
                    if ($i < $totalPages && $currentPage != $totalPages) {
                        echo '<li class="paginator__item"><a href="/genre/' . $_GET['genre'] . '/page/'  . $i . '">' . $i . '</a></li>' . PHP_EOL;
                    }
                }

                if ($currentPage != $totalPages) {
                    echo '<li class="paginator__item"><a href="/genre/' . $_GET['genre'] . '/page/'  . ($totalPages) . '">' . ($totalPages) . '</a></li>' . PHP_EOL;
                    echo '<li class="paginator__item paginator__item--next">' . PHP_EOL;
                    echo '<a href="/genre/' . $_GET['genre'] . '/page/'  . ($currentPage + 1) . '"><i class="icon ion-ios-arrow-forward"></i></a>' . PHP_EOL;
                    echo '</li>' . PHP_EOL;
                }
            }




            echo '</ul>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '';
            echo '</div>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
            echo '</section>' . PHP_EOL;
        } else
        if ($count == 2 && isset($_GET['custom'])) {
            if ($_GET['custom'] == 'torrent9') {
                echo '<!-- details -->';
                echo '<section id="moviedetail" class="section details">';
                echo '<!-- details background -->';
                echo '<div class="details__bg" id="coverpage"></div>';
                echo '<!-- end details background -->';
                echo '';
                echo '<!-- details content -->';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<!-- title -->';
                echo '<div class="col-12">';
                echo '<h1 class="details__title" id="movietitle"></h1>';
                echo '</div>';
                echo '<!-- end title -->';
                echo '';
                echo '';
                echo '';
                echo '<!-- player -->';
                echo '<div style="width: 100% !important;" id="playercontainer">';
                echo '<div style="width: 100% !important;" id="player"></div>';
                echo '</div>';
                echo '';
                echo '<!-- end player -->';
                echo '';
                echo '<div class="col-12">';
                echo '<div class="details__wrap">';
                echo '<!-- availables -->';
                echo '<div class="details__devices">';
                echo '<span class="details__devices-title">Available on devices:</span>';
                echo '<ul class="details__devices-list">';
                echo '<li><a id="magnetPlaceholder"><i class="icon ion-ios-magnet"></i></a><span>Magnet</span></li>';
                echo '</ul>';
                echo '</div>';
                echo '<!-- end availables -->';
                echo '';
                echo '<!-- share -->';
                echo '<div class="details__share">';
                echo '<span class="details__share-title">Share with friends:</span>';
                echo '';
                echo '<ul class="details__share-list">';
                echo '<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>';
                echo '<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>';
                echo '<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>';
                echo '<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>';
                echo '</ul>';
                echo '</div>';
                echo '<!-- end share -->';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<!-- end details content -->';
                echo '</section>';
                echo '<!-- end details -->';
            } else
            if ($_GET['custom'] == 'yggtorrent') {
                echo '<!-- details -->';
                echo '<section id="moviedetail" class="section details">';
                echo '<!-- details background -->';
                echo '<div class="details__bg" id="coverpage"></div>';
                echo '<!-- end details background -->';
                echo '';
                echo '<!-- details content -->';
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<!-- title -->';
                echo '<div class="col-12">';
                echo '<h1 class="details__title" id="movietitle"></h1>';
                echo '</div>';
                echo '<!-- end title -->';
                echo '';
                echo '';
                echo '';
                echo '<!-- player -->';
                echo '<div style="width: 100% !important;" id="playercontainer">';
                echo '<div style="width: 100% !important;" id="player"></div>';
                echo '</div>';
                echo '';
                echo '<!-- end player -->';
                echo '';
                echo '<div class="col-12">';
                echo '<div class="details__wrap">';
                echo '<!-- availables -->';
                echo '<div class="details__devices">';
                echo '<span class="details__devices-title">Available on devices:</span>';
                echo '<ul class="details__devices-list">';
                echo '<li><a id="magnetPlaceholder"><i class="icon ion-ios-magnet"></i></a><span>Magnet</span></li>';
                echo '</ul>';
                echo '</div>';
                echo '<!-- end availables -->';
                echo '';
                echo '<!-- share -->';
                echo '<div class="details__share">';
                echo '<span class="details__share-title">Share with friends:</span>';
                echo '';
                echo '<ul class="details__share-list">';
                echo '<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>';
                echo '<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>';
                echo '<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>';
                echo '<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>';
                echo '</ul>';
                echo '</div>';
                echo '<!-- end share -->';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<!-- end details content -->';
                echo '</section>';
                echo '<!-- end details -->';
            }
        }

        break;


    case 3:
        $search = "";
        if ($count = 3 && isset($_GET['episodeview'])) {
            if ($_GET['season'] > 9 && $_GET['episode'] > 9) {
                $search = $_GET['episodeview'] . "-" . "S" . $_GET['season'] . "E" . $_GET['episode'] . "-FRENCH-HDTV";
            } else 
            
            if ($_GET['season'] < 9 && $_GET['episode'] > 9) {
                $search = $_GET['episodeview'] . "-" . "S0" . $_GET['season'] . "E" . $_GET['episode'] . "-FRENCH-HDTV";
            } else 
            
            if ($_GET['season'] > 9 && $_GET['episode'] < 9) {
                $search = $_GET['episodeview'] . "-" . "S" . $_GET['season'] . "E0" . $_GET['episode'] . "-FRENCH-HDTV";
            } else 
            
            if ($_GET['season'] < 9 && $_GET['episode'] < 9) {
                $search = $_GET['episodeview'] . "-" . "S0" . $_GET['season'] . "E0" . $_GET['episode'] . "-FRENCH-HDTV";
            }
        }

        echo '<!-- details -->';
        echo '<section id="moviedetail" class="section details">';
        echo '<!-- details background -->';
        echo '<div class="details__bg" id="coverpage"></div>';
        echo '<!-- end details background -->';
        echo '';
        echo '<!-- details content -->';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<!-- title -->';
        echo '<div class="col-12">';
        echo '<h1 class="details__title" id="getTitle">' . $search . '</h1>';
        echo '</div>';
        echo '<!-- end title -->';
        echo '';
        echo '';
        echo '';
        echo '<!-- player -->';
        echo '<div style="width: 100% !important;" id="playercontainer">';
        echo '<div style="width: 100% !important;" id="player"></div>';
        echo '</div>';
        echo '';
        echo '<!-- end player -->';
        echo '';
        echo '<div class="col-12">';
        echo '<div class="details__wrap">';
        echo '<!-- availables -->';
        echo '<div class="details__devices">';
        echo '<span class="details__devices-title">Available on devices:</span>';
        echo '<ul class="details__devices-list">';
        echo '<li><a id="magnetPlaceholder"><i class="icon ion-ios-magnet"></i></a><span>Magnet</span></li>';
        echo '</ul>';
        echo '</div>';
        echo '<!-- end availables -->';
        echo '';
        echo '<!-- share -->';
        echo '<div class="details__share">';
        echo '<span class="details__share-title">Share with friends:</span>';
        echo '';
        echo '<ul class="details__share-list">';
        echo '<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>';
        echo '<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>';
        echo '<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>';
        echo '<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>';
        echo '</ul>';
        echo '</div>';
        echo '<!-- end share -->';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<!-- end details content -->';
        echo '</section>';
        echo '<!-- end details -->';


        break;
}
