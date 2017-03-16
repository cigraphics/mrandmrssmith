<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CalculatorControllerTest extends WebTestCase
{
    public function testCalculateAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/calculator/calculate', array('a' => 10, 'b' => 10, 'symbol' => '+'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('20', $crawler->filter('#resultPage')->text());
    }

    public function testCalculateSub()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/calculator/calculate', array('a' => 100, 'b' => 10, 'symbol' => '-'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('90', $crawler->filter('#resultPage')->text());
    }

    public function testCalculateMul()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/calculator/calculate', array('a' => 100, 'b' => 10, 'symbol' => '*'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('100', $crawler->filter('#resultPage')->text());
    }

    public function testCalculateDiv()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/calculator/calculate', array('a' => 10, 'b' => 10, 'symbol' => '/'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('1', $crawler->filter('#resultPage')->text());
    }

    public function testCalculateDiv0()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/calculator/calculate', array('a' => 10, 'b' => "0", 'symbol' => '/'));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Cannot divide by 0', $crawler->filter('#resultPage')->text());
    }
}
