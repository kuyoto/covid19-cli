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

namespace Kuyoto\Covid19;

use Symfony\Component\Console\Application as ConsoleApplication;

/**
 * Application.
 *
 * @category Library
 *
 * @author   Tolulope Kuyoro <nifskid1999@gmail.com>
 * @license  https://github.com/kuyoto/covid19-cli/blob/master/LICENSE.md (MIT License)
 */
class Application extends ConsoleApplication
{
    const VERSION = '1.0.0';

    private static $logo = '
  ____           _     _ _  ___             _ _
 / ___|_____   _(_) __| / |/ _ \        ___| (_)
| |   / _ \ \ / / |/ _` | | (_) |_____ / __| | |
| |__| (_) \ V /| | (_| | |\__, |_____| (__| | |
 \____\___/ \_/ |_|\__,_|_|  /_/       \___|_|_|

';

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct('COVID-19 CLI', self::VERSION);
    }

    /**
     * {@inheritdoc}
     */
    public function getHelp()
    {
        return self::$logo.parent::getHelp();
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        return array_merge(parent::getDefaultCommands(), [
            new Command\AboutCommand(),
            new Command\CountryListCommand(),
            new Command\CountryCommand(),
            new Command\GlobalCommand(),
            new Command\SlugCommand(),
        ]);
    }
}
