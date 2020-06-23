<?php

/**
 * COVID19-CLI (https://github.com/kuyoto/covid19-cli/).
 *
 * PHP version 7
 *
 * @category  Library
 *
 * @author    Tolulope Kuyoro <nifskid1999@gmail.com>
 * @copyright 2020 Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license   https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 *
 * @version   GIT: master
 *
 *
 */

declare(strict_types=1);

namespace Kuyoto\Covid19\Service;

use PHPUnit\Framework\TestCase;

/**
 * CovidApiTest.
 *
 * @category Library
 *
 * @author   Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license  https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 * @group internet
 *
 * @internal
 * @coversNothing
 */
class CovidApiTest extends TestCase
{
    /**
     * @var CovidApi
     */
    private $api;

    /**
     * @var string
     */
    private $slug;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->api = new CovidApi();
        $this->slug = 'nigeria';
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        $this->api = null;
        $this->slug = null;
    }

    /**
     * Covid19Test::testGetByCountryAllStatus().
     */
    public function testGetByCountryAllStatus(): void
    {
        $data = $this->api->getByCountryAllStatus($this->slug);

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDayOneAllStatus().
     */
    public function testGetDayOneAllStatus(): void
    {
        $data = $this->api->getDayOneAllStatus($this->slug);

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDayOneTotalAllStatus().
     */
    public function testGetDayOneTotalAllStatus(): void
    {
        $data = $this->api->getDayOneTotalAllStatus($this->slug);
        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetLiveByCountryAllStatus().
     */
    public function testGetLiveByCountryAllStatus(): void
    {
        $data = $this->api->getLiveByCountryAllStatus($this->slug);

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfirmedCasesByCountry().
     */
    public function testGetConfirmedCasesByCountry(): void
    {
        $data = $this->api->getByCountry($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfirmedCasesByCountryLive().
     */
    public function testGetConfirmedCasesByCountryLive(): void
    {
        $data = $this->api->getByCountryLive($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfirmedCasesByCountryTotal().
     */
    public function testGetConfirmedCasesByCountryTotal(): void
    {
        $data = $this->api->getByCountryTotal($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfimedCasesDayOne().
     */
    public function testGetConfimedCasesDayOne(): void
    {
        $data = $this->api->getDayOne($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfimedCasesDayLive().
     */
    public function testGetConfimedCasesDayOneLive(): void
    {
        $data = $this->api->getDayOneLive($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfimedCasesDayTotal().
     */
    public function testGetConfimedCasesDayOneTotal(): void
    {
        $data = $this->api->getDayOneTotal($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfirmedCasesLiveByCountryAndStatusAfterDate().
     */
    public function testGetConfirmedCasesLiveByCountryAndStatusAfterDate(): void
    {
        $data = $this->api->getLiveByCountryAndStatusAfterDate($this->slug, 'confirmed', new \DateTimeImmutable('2 months ago'));

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetConfirmedCasesLiveByCountryAndStatus().
     */
    public function testGetConfirmedCasesLiveByCountryAndStatus(): void
    {
        $data = $this->api->getLiveByCountryAndStatus($this->slug, 'confirmed');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetCountries().
     */
    public function testGetCountries(): void
    {
        $data = $this->api->getCountries();

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetByCountryTotalAllStatus().
     */
    public function testGetByCountryTotalAllStatus(): void
    {
        $data = $this->api->getByCountryTotalAllStatus($this->slug);

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesByCountry().
     */
    public function testGetDeathsCasesByCountry(): void
    {
        $data = $this->api->getByCountry($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesByCountryLive().
     */
    public function testGetDeathsCasesByCountryLive(): void
    {
        $data = $this->api->getByCountryLive($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesDayOne().
     */
    public function testGetDeathsCasesDayOne(): void
    {
        $data = $this->api->getDayOne($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesDayOneLive().
     */
    public function testGetDeathsCasesDayOneLive(): void
    {
        $data = $this->api->getDayOneLive($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesDayOneTotal().
     */
    public function testGetDeathsCasesDayOneTotal(): void
    {
        $data = $this->api->getDayOneTotal($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesByCountryTotal().
     */
    public function testGetDeathsCasesByCountryTotal(): void
    {
        $data = $this->api->getByCountryTotal($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesLiveByCountryAndStatus().
     */
    public function testGetDeathsCasesLiveByCountryAndStatus(): void
    {
        $data = $this->api->getLiveByCountryAndStatus($this->slug, 'deaths');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetDeathsCasesLiveByCountryAndStatusAfterDate().
     */
    public function testGetDeathsCasesLiveByCountryAndStatusAfterDate(): void
    {
        $data = $this->api->getLiveByCountryAndStatusAfterDate($this->slug, 'deaths', new \DateTimeImmutable('2 months ago'));

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesByCountry().
     */
    public function testGetRecoveredCasesByCountry(): void
    {
        $data = $this->api->getByCountry($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesByCountryLive().
     */
    public function testGetRecoveredCasesByCountryLive(): void
    {
        $data = $this->api->getByCountryLive($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesDayOne().
     */
    public function testGetRecoveredCasesDayOne(): void
    {
        $data = $this->api->getDayOne($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesDayOneLive().
     */
    public function testGetRecoveredCasesDayOneLive(): void
    {
        $data = $this->api->getDayOneLive($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesDayOneTotal().
     */
    public function testGetRecoveredCasesDayOneTotal(): void
    {
        $data = $this->api->getDayOneTotal($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesByCountryTotal().
     */
    public function testGetRecoveredCasesByCountryTotal(): void
    {
        $data = $this->api->getByCountryTotal($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesLiveByCountryAndStatus().
     */
    public function testGetRecoveredCasesLiveByCountryAndStatus(): void
    {
        $data = $this->api->getLiveByCountryAndStatus($this->slug, 'recovered');

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetRecoveredCasesLiveByCountryAndStatusAfterDate().
     */
    public function testGetRecoveredCasesLiveByCountryAndStatusAfterDate(): void
    {
        $data = $this->api->getLiveByCountryAndStatusAfterDate($this->slug, 'recovered', new \DateTimeImmutable('2 months ago'));

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetStatistics().
     */
    public function testGetStatistics(): void
    {
        $data = $this->api->getStatstics();

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetSummary().
     */
    public function testGetSummary(): void
    {
        $data = $this->api->getSummary();

        $this->assertArrayHasKey('Global', $data);
        $this->assertIsArray($data['Global']);
        $this->assertArrayHasKey('Countries', $data);
        $this->assertIsArray($data['Countries']);
        $this->assertArrayHasKey('Date', $data);
        $this->assertIsNotArray($data['Date']);
    }

    /**
     * Covid19Test::testGetWorldWIP().
     */
    public function testGetWorldWIP(): void
    {
        $data = $this->api->getWorldWIP();

        $this->assertNotEmpty($data);
    }

    /**
     * Covid19Test::testGetWorldTotalWIP().
     */
    public function testGetWorldTotalWIP(): void
    {
        $data = $this->api->getWorldTotalWIP();

        $this->assertNotEmpty($data);
    }
}
