<?php
define('API_URL', 'https://pokeapi.co/api/v2');
include 'CustomCache.php';

function request(String $url = null)
{
    if ($url == null) {
        return false;
    } else {
        $cache = new CustomCache;
        $url = API_URL . $url;
        $isCached = $cache->checkCache($url);

        if ($isCached == true) {
            $res = $cache->getFromCache($url);
            return $res;
        } else {
            $cache->setCache($url);
            $res = $cache->getFromCache($url);

            // cache fallback
            if ($res) {
                return $res;
            } else {
                return file_get_contents($url);
            }
        }
    }
}