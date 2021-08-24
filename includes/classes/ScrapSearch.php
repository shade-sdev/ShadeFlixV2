<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/FrameworkFunctions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/Constants.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/Curl.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/lightbenc.php");

class ScrapSearch
{

    public function search($searchQuery)
    {

        $sanitizeSearch = str_replace(" ", "-", $searchQuery);

        $curl = new Curl();
        $html = $curl->get(Constants::$torrent9domain . "/search_torrent/$sanitizeSearch.html");


        preg_match_all('/<a title="(.*?)">(.*?)<\/a>/s', $html, $matches);

        $searchResults = array();
        foreach ($matches[0] as $match) {

            // Fetching Title and URL

            preg_match('~<a .*?href=[\'"]+(.*?)[\'"]+.*?><h3>(.*?)</h3></a>~ims', $match, $result);
            $title = $result[2];
            $url = Constants::$torrent9domain . $result[1];


            array_push($searchResults, (object)[
                'title' => $title,
                'url' => $url,

            ]);
            break;
        }
        echo json_encode(['rows' => $searchResults,  'response' => true]);
        return $searchResults;
    }

    public function searchAll($searchQuery)
    {

        $sanitizeSearch = str_replace(" ", "-", $searchQuery);

        $curl = new Curl();
        $html = $curl->get(Constants::$torrent9domain . "/search_torrent/$sanitizeSearch.html");


        preg_match_all('/<a title="(.*?)">(.*?)<\/a>/s', $html, $matches);

        $searchResults = array();
        foreach ($matches[0] as $match) {

            // Fetching Title and URL

            preg_match('~<a .*?href=[\'"]+(.*?)[\'"]+.*?><h3>(.*?)</h3></a>~ims', $match, $result);
            $title = $result[2];
            $url = Constants::$torrent9domain . $result[1];


            array_push($searchResults, (object)[
                'title' => $title,
                'url' => $url,

            ]);
        }
        echo json_encode(['rows' => $searchResults,  'response' => true]);
        return $searchResults;
    }

    public function getMagnet($url)
    {

        // Fetching Magnet

        $curl2 = new Curl();
        $html2 = $curl2->get($url);
        preg_match_all('/<a class="btn btn-danger download" href=[\'"]+(.*?)[\'"]+.*?>(.*?)<\/a>/s', $html2, $magnet);
        $magnet = $magnet[1][0];

        echo json_encode(['magnet' => $magnet, 'response' => true]);
    }


    public function yggLogin($ch)
    {
        $postFields = array(
            "id" => Constants::$yggid,
            "pass" => Constants::$yggpass,

        );


        $url = Constants::$yggdomain . "/user/login";


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_URL, $url);
        $cookie = 'cookies.txt';
        $timeout = 30;

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT,         10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,  $timeout);
        curl_setopt($ch, CURLOPT_COOKIEJAR,       $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE,      $cookie);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));

        $result = curl_exec($ch);
    }


    public function yggScrap($url)
    {
        $ch = curl_init();
        $this->yggLogin($ch);


        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);

        preg_match_all('/<a id="torrent_name" href="(.*?)">(.*?)<\/a>/s', $result, $matches);

        curl_close($ch);
        $searchResults = array();
        foreach ($matches[0] as $m) {
            preg_match('~<a .*?href=[\'"]+(.*?)[\'"]+.*?>(.*?)</a>~ims', $m, $resultf);
            // preg_match('!https?://[\S]+!', $resultf[1], $matchz);
            preg_match('~>\K[^<>]*(?=<)~', $resultf[0], $titlematch);

            // echo "Title: " . $titlematch[0] . " URL: "  . $resultf[1] . "<br>";
            array_push($searchResults, (object)[
                'title' => $titlematch[0],
                'url' => $resultf[1],

            ]);
        }



        echo json_encode(['rows' => $searchResults,  'response' => true]);
        return $searchResults;
    }

    public function yggSearch($searchQuery)
    {

        $sanitizeSearch = str_replace(" ", "+", $searchQuery);
        $url = Constants::$yggdomain . "/engine/search?name=$sanitizeSearch&do=search";
        $ch = curl_init();
        $this->yggLogin($ch);


        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);

        preg_match_all('/<a id="torrent_name" href="(.*?)">(.*?)<\/a>/s', $result, $matches);

        curl_close($ch);
        $searchResults = array();
        foreach ($matches[0] as $m) {
            preg_match('~<a .*?href=[\'"]+(.*?)[\'"]+.*?>(.*?)</a>~ims', $m, $resultf);
            // preg_match('!https?://[\S]+!', $resultf[1], $matchz);
            preg_match('~>\K[^<>]*(?=<)~', $resultf[0], $titlematch);

            // echo "Title: " . $titlematch[0] . " URL: "  . $resultf[1] . "<br>";
            array_push($searchResults, (object)[
                'title' => $titlematch[0],
                'url' => $resultf[1],
                'domain' => Constants::$yggdomain

            ]);
        }



        echo json_encode(['rows' => $searchResults,  'response' => true]);
        return $searchResults;
    }

    public function torrent2magnet($url)
    {

        $ch = curl_init();
        $this->yggLogin($ch);
        curl_setopt(
            $ch,
            CURLOPT_URL,
            $url
        );
        /**
         * Create a new file
         */
        $fp = fopen('ygg.torrent', 'w');
        /**
         * Ask cURL to write the contents to a file
         */
        curl_setopt($ch, CURLOPT_FILE, $fp);
        /**
         * Execute the cURL session
         */
        $result = curl_exec($ch);

        /**
         * Close cURL session and file
         */
        curl_close($ch);
        fclose($fp);

        $info = Lightbenc::bdecode_getinfo("ygg.torrent");
        // $sanitizeName = str_replace(" ", "%20", $info['info']['name']);
        // $sanitizeUrl = str_replace(" ", "%20", $info['announce']);
        echo json_encode(['magnet' => "magnet:?xt=urn:btih:" . $info['info_hash'] . "&dn=" . urlencode($info['info']['name']) . "&tr=" . urlencode($info['announce']),  'response' => true]);
        return "magnet:?xt=urn:btih:" . $info['info_hash'];
    }
}
