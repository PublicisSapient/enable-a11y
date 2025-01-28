<?php

header("Content-Type: application/json; charset=utf-8");

$response = json_cached_api_results(); //file_get_contents("http://newsapi.org/v2/top-headlines?country=us&apiKey=d25934a07be84a96a22d882d5d91075b");
echo $response;


/**
 * API Request Caching
 *
 *  Use server-side caching to store API request's as JSON at a set
 *  interval, rather than each pageload.
 *
 * @arg Argument description and usage info
 */
function json_cached_api_results($cache_file = null, $expires = null)
{
    global $request_type, $purge_cache, $limit_reached, $request_limit;

    if (!$cache_file) {
        $cache_file = dirname(__FILE__) . "/api-cache/news.json";
    }
    if (!$expires) {
        $expires = time() - 60 * 60;
    }

    // Check that the file is older than the expire time and that it's not empty
    if (
        !file_exists($cache_file) ||
        filectime($cache_file) < $expires ||
        file_get_contents($cache_file) == "" ||
        ($purge_cache && intval($_SESSION["views"]) <= $request_limit)
    ) {
        // File is too old, refresh cache
        $api_results = file_get_contents(
            "http://newsapi.org/v2/top-headlines?country=us&apiKey=d25934a07be84a96a22d882d5d91075b",
        );
        $json_results = json_encode($api_results);

        // Remove cache file on error to avoid writing wrong xml
        if ($api_results && $json_results) {
            if (!file_exists(dirname(__FILE__) . "/api-cache")) {
                mkdir(dirname(__FILE__) . "/api-cache", 0777, true);
            }

            file_put_contents($cache_file, $json_results);
        } elseif (file_exists($cache_file)) {
            unlink($cache_file);
        }
    } else {
        // Check for the number of purge cache requests to avoid abuse
        if (isset($_SESSION) && intval($_SESSION["views"]) >= $request_limit) {
            $limit_reached = " <span class='error'>Request limit reached ($request_limit). Please try purging the cache later.</span>";
        }
        // Fetch cache
        $json_results = file_get_contents($cache_file);
        $request_type = "JSON";
    }

    return json_decode($json_results);
}
