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
 */

declare(strict_types=1);

namespace Kuyoto\Covid19\Service;

use GuzzleHttp\Client;

/**
 * A simple API wrapper for covid19api.
 *
 * @category Library
 *
 * @author   Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license  https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 */
class CovidApi
{
    public const ENDPOINT = 'https://api.covid19api.com/';
    private const URI_DAY_ONE = 'dayone/country/%s/status/%s';
    private const URI_DAY_ONE_ALL_STATUS = 'dayone/country/%s';
    private const URI_DAY_ONE_LIVE = 'dayone/country/%s/status/%s/live';
    private const URI_DAY_ONE_TOTAL = 'total/dayone/country/%s/status/%s';
    private const URI_DAY_ONE_TOTAL_ALL_STATUS = 'total/dayone/country/%s';
    private const URI_COUNTRY = 'country/%s/status/%s';
    private const URI_COUNTRY_ALL_STATUS = 'country/%s';
    private const URI_COUNTRY_LIVE = 'country/%s/status/%s/live';
    private const URI_COUNTRY_TOTAL = 'total/country/%s/status/%s';
    private const URI_COUNTRY_TOTAL_ALL_STATUS = 'total/country/%s';
    private const URI_LIVE_COUNTRY_ALL_STATUS = 'live/country/%s';
    private const URI_LIVE_COUNTRY_AND_STATUS_AFTER_DATE = 'live/country/%s/status/%s/date/%s';
    private const URI_LIVE_COUNTRY_AND_STATUS = 'live/country/%s/status/%s';
    private const URI_COUNTRIES = 'countries';
    private const URI_ALL_DATA = 'all';
    private const URI_STATS = 'stats';
    private const URI_SUMMARY = 'summary';
    private const URI_WORLD = 'world';
    private const URI_WORLD_TOTAL = 'world/total';

    /**
     * @var Client the guzzle client
     */
    private $client;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::ENDPOINT,
        ]);
    }

    /**
     * Returns all cases by case type for a country.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getByCountry(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_COUNTRY, $slug, $case));
    }

    /**
     * @param string $slug the country slug
     */
    public function getByCountryAllStatus(string $slug): array
    {
        return $this->request(sprintf(self::URI_COUNTRY_ALL_STATUS, $slug));
    }

    /**
     * Returns all the cases by case type for a country from the first recorded case with the latest record being the live count.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getByCountryLive(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_COUNTRY_LIVE, $slug, $case));
    }

    /**
     * Returns all the cases by case type for a country from the first recorded case.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getByCountryTotal(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_COUNTRY_TOTAL, $slug, $case));
    }

    /**
     * @param string $slug the country slug
     */
    public function getByCountryTotalAllStatus(string $slug): array
    {
        return $this->request(sprintf(self::URI_COUNTRY_TOTAL_ALL_STATUS, $slug));
    }

    /**
     * Returns all the cases by case type for a country from the first recorded case.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getDayOne(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_DAY_ONE, $slug, $case));
    }

    /**
     * Returns all the cases by case type for a country from the first recorded case.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     */
    public function getDayOneAllStatus(string $slug): array
    {
        return $this->request(sprintf(self::URI_DAY_ONE_ALL_STATUS, $slug));
    }

    /**
     * Returns all the cases by case type for a country from the first recorded case with the latest record being the live count.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getDayOneLive(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_DAY_ONE_LIVE, $slug, $case));
    }

    /**
     * Returns all the cases by case type for a country from the first recorded case.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getDayOneTotal(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_DAY_ONE_TOTAL, $slug, $case));
    }

    /**
     * @param string $slug the country slug
     */
    public function getDayOneTotalAllStatus(string $slug): array
    {
        return $this->request(sprintf(self::URI_DAY_ONE_TOTAL_ALL_STATUS, $slug));
    }

    /**
     * Returns all the available countries and provinces, as well as the country slug per country request.
     */
    public function getCountries(): array
    {
        return $this->request(self::URI_COUNTRIES);
    }

    /**
     * Returns all live cases by case type for a country.
     * This records a pulled every 10 minutes and are ungrouped.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string $slug the country slug
     * @param string $case the case must be one of: confirmed, recovered, deaths
     */
    public function getLiveByCountryAndStatus(string $slug, string $case): array
    {
        return $this->request(sprintf(self::URI_LIVE_COUNTRY_AND_STATUS, $slug, $case));
    }

    /**
     * @param string $slug the country slug
     */
    public function getLiveByCountryAllStatus(string $slug): array
    {
        return $this->request(sprintf(self::URI_LIVE_COUNTRY_ALL_STATUS, $slug));
    }

    /**
     * Returns all live cases by case type for a country after a given date.
     * This records a pulled every 10 minutes and are ungrouped.
     * Country must be a slug from /countries or /summary. Cases must be one of: confirmed, recovered, deaths.
     *
     * @param string             $slug     the country slug
     * @param string             $case     the case must be one of: confirmed, recovered, deaths
     * @param \DateTimeInterface $dateTime the DateTimeInterface implementation
     */
    public function getLiveByCountryAndStatusAfterDate(string $slug, string $case, \DateTimeInterface $dateTime): array
    {
        if (($dateTime instanceof \DateTime) || ($dateTime instanceof \DateTimeImmutable)) {
            $dateTime->setTimeZone(new \DateTimeZone('UTC'));
        }

        return $this->request(
            sprintf(self::URI_LIVE_COUNTRY_AND_STATUS_AFTER_DATE, $slug, $case, $dateTime->format('Y-m-d\TH:i:s\Z'))
        );
    }

    /**
     * Returns a complete list of statistics.
     */
    public function getStatstics(): array
    {
        return $this->request(self::URI_STATS);
    }

    /**
     * Returns a summary of new and total cases per country updated daily.
     */
    public function getSummary(): array
    {
        return $this->request(self::URI_SUMMARY);
    }

    public function getWorldWIP(): array
    {
        return $this->request(self::URI_WORLD);
    }

    public function getWorldTotalWIP(): array
    {
        return $this->request(self::URI_WORLD_TOTAL);
    }

    /**
     * Returns all daily data. This call results in 10MB of data being returned and should be used infrequently.
     */
    public function getAllData(): array
    {
        return $this->request(self::URI_ALL_DATA);
    }

    /**
     * Sends a GET request.
     *
     * @param string $uri the uri
     */
    private function request(string $uri, array $options = []): array
    {
        $response = $this->client->request('GET', $uri, $options);

        if ($response->getStatusCode() !== 200) {
            return [];
        }

        return json_decode($response->getBody()->getContents(), true) ?? [];
    }
}
