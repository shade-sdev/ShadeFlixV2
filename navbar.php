<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/config.php");

?>
<div class="header__wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="/" class="header__logo">
                        <img src="/assets/img/logo.png" alt="">
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <ul class="header__nav">




                        <li class="header__nav-item">
                            <a href="/movie/page/1" class="header__nav-link">Movie</a>
                        </li>

                        <li class="header__nav-item">
                            <a href="/tv/page/1" class="header__nav-link">TV Shows</a>
                        </li>

                        <!-- dropdown -->
                        <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Genre</a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuMore">
                                <li><a href="/genre/28/page/1">Action</a></li>
                                <li><a href="/genre/12/page/1">Adventure</a></li>
                                <li><a href="/genre/16/page/1">Animation</a></li>
                                <li><a href="/genre/35/page/1">Comedy</a></li>
                                <li><a href="/genre/80/page/1">Crime</a></li>
                                <li><a href="/genre/99/page/1">Documentary</a></li>
                                <li><a href="/genre/18/page/1">Drama</a></li>
                                <li><a href="/genre/10751/page/1">Family</a></li>
                                <li><a href="/genre/14/page/1">Fantasy</a></li>
                                <li><a href="/genre/36/page/1">History</a></li>
                                <li><a href="/genre/10402/page/1">Music</a></li>
                                <li><a href="/genre/9648/page/1">Mystery</a></li>
                                <li><a href="/genre/10749/page/1">Romance</a></li>
                                <li><a href="/genre/878/page/1">Science Fiction</a></li>
                                <li><a href="/genre/10770/page/1">TV Movie</a></li>
                                <li><a href="/genre/53/page/1">Thriller</a></li>
                                <li><a href="/genre/10752/page/1">War</a></li>
                                <li><a href="/genre/37/page/1">Western</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->

                        <!-- dropdown -->
                        <li class="dropdown header__nav-item">
                            <a class="dropdown-toggle header__nav-link" href="#" role="button" id="dropdownMenuMore" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Custom Search</a>

                            <ul class="dropdown-menu header__dropdown-menu" aria-labelledby="dropdownMenuMore">
                                <li><a href="/customsearch/torrent9">Torrent9</a></li>
                                <li><a href="/customsearch/yggtorrent">YGGTorrent</a></li>
                            </ul>
                        </li>
                        <!-- end dropdown -->

                        <li class="header__nav-item">
                            <a href="/settings" class="header__nav-link">Settings</a>
                        </li>
                    </ul>
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth">
                        <button class="header__search-btn" type="button">
                            <i class="icon ion-ios-search"></i>
                        </button>


                        <?php


                        if ($_SESSION['email'] != '') {
                            echo '<a href="/logout" class="header__sign-in">';
                            echo '<i class="icon ion-ios-log-in"></i>';
                            echo '<span>logout</span>';
                            echo '</a>';
                        } else {


                            echo '<a href="/login" class="header__sign-in">';
                            echo '<i class="icon ion-ios-log-in"></i>';
                            echo '<span>sign in</span>';
                            echo '</a>';
                        }

                        ?>

                    </div>
                    <!-- end header auth -->

                    <!-- header menu btn -->
                    <button class="header__btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end header menu btn -->
                </div>
            </div>
        </div>
    </div>
</div>