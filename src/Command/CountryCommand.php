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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * CountryCommand.
 *
 * @category Library
 *
 * @author   Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license  https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 */
class CountryCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('country')
            ->setDescription('Display the summary of total cases for a given country')
            ->addArgument('slug', InputArgument::REQUIRED, 'Country slug. Use the "slug" command to display all available slugs.')
            ->setHelp(
                <<<'EOT'
This <info>country</info> command displays the summary of total cases for a given country.
Use the <info>slug</info> command to display all available slugs.

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

        try {
            $response = (new CovidApi())->getByCountryTotalAllStatus($input->getArgument('slug'));

            if (empty($response)) {
                $io->error('Invalid slug was provided! Use <info>slug</info> command to display all available slugs and their country.');

                return Command::FAILURE;
            }

            $filterCallback = function ($key) {
                return in_array($key, ['Confirmed', 'Deaths', 'Recovered', 'Country']);
            };

            $items = array_filter(end($response), $filterCallback, ARRAY_FILTER_USE_KEY);

            $callback = function ($item, $key) {
                if (in_array($key, ['Confirmed', 'Deaths', 'Recovered'])) {
                    return number_format($item);
                }

                return $item;
            };

            $items = array_combine(array_keys($items), array_map($callback, $items, array_keys($items)));

            $io->writeln(sprintf("\e[32m\xe2\x9c\x94\e[0m  Country: %s", $items['Country']));
            $io->write(sprintf('<options=bold>Cases:</> <fg=yellow>%s</>, ', $items['Confirmed']));
            $io->write(sprintf('<options=bold>Deaths:</> <fg=red>%s</>, ', $items['Deaths']));
            $io->write(sprintf('<options=bold>Recovered:</> <fg=green>%s</>', $items['Recovered']));
        } catch (GuzzleException $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
