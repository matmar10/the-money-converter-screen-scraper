<?php

namespace Matmar10\TheMoneyConverter\Tests\ExchangeRate;

use Matmar10\TheMoneyConverter\ScreenScraper\CurrencyExchangeRate;
use PHPUnit_Framework_TestCase as TestCase;

class ClientTest extends TestCase
{
    /**
     * @dataProvider provideTestQuoteData
     * @group web
     */
    public function testQuote($from, $to, $expectedRate)
    {
        $rawRate = CurrencyExchangeRate::quote($from, $to);
        $this->assertInternalType('float', $rawRate);
        $this->assertEquals($expectedRate, $rawRate);
    }

    public function provideTestQuoteData()
    {
        return array(
            array(
                'USD', 'USD', 1,
            ),
            array(
                'GBP', 'GBP', 1,
            ),
        );

    }
}
