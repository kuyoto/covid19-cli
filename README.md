# COVID-19 CLI

This package provides a simple command-line tool for diplaying COVID-19 stats. The data is sourced from the [John Hopkins University Center for Systems Science and Engineering (JHU CSSE)](https://github.com/CSSEGISandData/COVID-19) via [covid19api.com](https://covid19api.com).

```console
  ____           _     _ _  ___             _ _
 / ___|_____   _(_) __| / |/ _ \        ___| (_)
| |   / _ \ \ / / |/ _` | | (_) |_____ / __| | |
| |__| (_) \ V /| | (_| | |\__, |_____| (__| | |
 \____\___/ \_/ |_|\__,_|_|  /_/       \___|_|_|

COVID-19 CLI 1.0.0

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  about    Display the short information about COVID-19 CLI.
  all      Display the available countries.
  country  Display the summary of total cases for a given country.
  global   Display the summary of total cases world wide.
  help     Displays help for a command
  list     Lists commands
  slug     Display a list of available location, slug and country code
```

## Installation

The recommnended way to install this library is through [composer](https://getcomposer.org):

```bash
composer require kuyoto/covid19-cli
```

## Usage

To use the `covid19` command, make sure to add `~/composer/vendor/bin` to your `PATH` environment variable.

Run `covid19` command in your terminal for starting the application or `covid19 help` for displaying all available commands.

## License

The package is an open-sourced software licensed under the [MIT License](LICENSE).
