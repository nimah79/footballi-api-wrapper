<?php

/**
 * Simple PHP wrapper for Footballi.net API
 * By NimaH79
 * NimaH79.ir.
 */
class Footballi
{
    public static function getMatchesOfToday()
    {
        return self::curlRequest('http://api.footballiapp.ir/football/index.php/competition/match/date/'.date('Y-m-d'));
    }

    public static function getMatchesOfDate($date)
    {
        return self::curlRequest('http://api.footballiapp.ir/football/index.php/competition/match/date/'.$date);
    }

    public static function searchMatches($filters, $sort = 'DESC')
    {
        return self::curlRequest('http://api.footballiapp.ir/football/index.php/api/competition/?'.urldecode(http_build_query([
                'filter' => json_encode($filters),
                'sort'   => json_encode([['property' => 'SORT', 'direction' => $sort]]), ]
        )));
    }

    public static function getMatchInfo($match_id)
    {
        return self::curlRequest('http://api.footballi.net/api/v2/match/'.$match_id.'/overview');
    }

    public static function getCompetitionStandings($comp_id)
    {
        return self::curlRequest('http://api.footballi.net/api/v2/competition/'.$comp_id.'/standings');
    }

    public static function getCompetitionFixtures($comp_id)
    {
        return self::curlRequest('http://api.footballiapp.ir/football/index.php/competition/fixture/compId/'.$comp_id);
    }

    public static function getTopScorersOfCompetition($comp_id)
    {
        return self::curlRequest('http://api.footballiapp.ir/football/index.php/topScorer/get/compId/'.$comp_id);
    }

    public static function getLatestNews($category_id)
    {
        return self::curlRequest('http://api.footballi.net/api/v2/news/latest/'.$category_id);
    }

    public static function getNewsContent($news_id)
    {
        return self::curlRequest('http://api.footballi.net/api/v2/news/'.$news_id);
    }

    private static function curlRequest($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
