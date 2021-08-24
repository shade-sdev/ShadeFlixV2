<?php

class TMDB
{

    public function request($link)
    {
        $file = $link;
        $data = file_get_contents($file);
        $result = json_decode($data, true);
        return $result;
    }

    public function getGenres($genresArray, $genreIdArray)
    {
        $genres = "";
        foreach ($genreIdArray as $gids) {
            foreach ($genresArray as $g) {
                if ($gids == $g['id']) {

                    $genres .= $g['name'] . ", ";
                }
            }
        }
        $genres = rtrim($genres, ", ");
        return $genres;
    }
}
