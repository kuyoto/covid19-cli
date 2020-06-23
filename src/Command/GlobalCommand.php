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
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * GlobalCommand.
 *
 * @category Library
 *
 * @author   Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license  https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 */
class GlobalCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('global')
            ->setDescription('Display the summary of total cases world wide')
            ->setHelp(
                <<<'EOT'
The <info>global</info> command displays the summary of total cases world wide.

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
            $response = (new CovidApi())->getWorldTotalWIP();

            $callback = function ($item, $key) {
                if (in_array($key, ['TotalConfirmed', 'TotalDeaths', 'TotalRecovered'])) {
                    return number_format($item);
                }

                return $item;
            };

            $items = array_combine(array_keys($response), array_map($callback, $response, array_keys($response)));

            $io->writeln("\e[32m\xe2\x9c\x94\e[0m  Global statistics");
            $io->write(sprintf('<options=bold>Confirmed:</> <fg=yellow>%s</>, ', $items['TotalConfirmed']));
            $io->write(sprintf('<options=bold>Deaths:</> <fg=red>%s</>, ', $items['TotalDeaths']));
            $io->write(sprintf('<options=bold>Recovered:</> <fg=green>%s</>', $items['TotalRecovered']));
        } catch (GuzzleException $e) {
            $io->error($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
