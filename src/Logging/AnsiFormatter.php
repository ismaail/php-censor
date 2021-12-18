<?php

namespace PHPCensor\Logging;

use Monolog\Formatter\LineFormatter;

class AnsiFormatter extends LineFormatter
{
    /**
     * {@inheritDoc}
     */
    public function format(array $record): string
    {
        return str_replace(
            ["\033[0;31m", "\033[0m", "\033[0;32m", "\033[0;36m"],
            '',
            parent::format($record)
        );
    }
}
