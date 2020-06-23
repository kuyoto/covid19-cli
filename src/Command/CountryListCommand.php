<?php

/**
 * COVID19-CLI (https://github.com/kuyoto/covid19-cli).
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

namespace Kuyoto\Covid19\Command;

use GuzzleHttp\Exception\GuzzleException;
use Kuyoto\Covid19\Service\CovidApi;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * CountryListCommand.
 *
 * @category Library
 *
 * @author   Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license  https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 */
class CountryListCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('all')
            ->setDescription('Display the available countries')
            ->addOption('sort', 's', InputOption::VALUE_OPTIONAL, 'Sort countries list by key (location|cases|deaths|recovered)')
            ->setHelp(
                <<<'EOT'
The <info>all</info> command displays a list of total cases in all countries.

EOT
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $sortByTable = [
            'location' => 'Country',
            'cases' => 'TotalConfirmed',
            'deaths' => 'TotalDeaths',
            'recovered' => 'TotalRecovered',
        ];

        if (!$input->getOption('sort')) {
            $sortBy = 'TotalConfirmed';
        } else {
            $sort = strtolower($input->getOption('sort'));

            if (!isset($sortByTable[$sort])) {
                $io->error('Invalid sort option expected (location|cases|deaths|recovered).');

                return Command::FAILURE;
            }

            $sortBy = $sortByTable[$sort];
        }

        try {
            $io->writeln("\e[32m\xe2\x9c\x94\e[0m  Retrieving and preparing the data...");

            $response = (new CovidApi())->getSummary();

            $items = $this->getRequiredCountriesStats($response['Countries']);

            if ($sortBy === 'Country') {
                ksort($items, SORT_DESC);
            } else {
                usort($items, function ($item1, $item2) use ($sortBy): int {
                    return intval(str_replace(',', '', $item2[$sortBy])) <=> intval(str_replace(',', '', $item1[$sortBy]));
                });
            }

            $io->writeln("\e[32m\xe2\x9c\x94\e[0m  Building data table");
            $io->table(['Location', 'Cases', 'Deaths', 'Recovered'], $items);
        } catch (GuzzleException $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * Returns the required stats for each country.
     */
    private function getRequiredCountriesStats(array $countries): array
    {
        $callback = function ($item, $key): array {
            $filtercallback = function ($key): bool {
                return in_array($key, ['Country', 'TotalConfirmed', 'TotalDeaths', 'TotalRecovered']);
            };

            $items = array_filter($item, $filtercallback, ARRAY_FILTER_USE_KEY);

            $callback = function ($item, $key): string {
                if (in_array($key, ['TotalConfirmed', 'TotalDeaths', 'TotalRecovered'])) {
                    return number_format($item);
                }

                return $item;
            };

            return array_combine(array_keys($items), array_map($callback, $items, array_keys($items)));
        };

        return array_combine(array_keys($countries), array_map($callback, $countries, array_keys($countries)));
    }
}
