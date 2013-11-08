<?php

namespace Matmar10\TheMoneyConverter\ScreenScraper;

use Goutte\Client;

class CurrencyExchangeRate
{

    public static $urlTemplate = 'http://themoneyconverter.com/{fromCurrencyCode}/{toCurrencyCode}.aspx';

    public static function setUrlTemplate($urlTemplate)
    {
        self::$urlTemplate = $urlTemplate;
    }

    public static function quote($fromCurrencyCode, $toCurrencyCode)
    {
        $url = self::$urlTemplate;
        $url = str_replace('{fromCurrencyCode}', $fromCurrencyCode, $url);
        $url = str_replace('{toCurrencyCode}', $toCurrencyCode, $url);
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $rateNode = self::selectRateNode($crawler);
        return self::parseRateNode($rateNode);
    }

    public static function selectRateNode($crawler)
    {
        return $crawler->filter('#ratebox');
    }

    public static function parseRateNode($rateNode)
    {
        $resultText = $rateNode->text();
        return (float)preg_replace('/[^\d\.]/', '', $resultText);
    }
}
