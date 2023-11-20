<?php

declare(strict_types=1);

namespace phpDocumentor\Guides\Cli\Command;

use RuntimeException;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Webmozart\Assert\Assert;

use function chdir;
use function sprintf;

final class WorkingDirectorySwitcher
{
    public function __invoke(ConsoleCommandEvent $event): void
    {
        $workingDir = $event->getInput()->getOption('working-dir');
        Assert::nullOrStringNotEmpty($workingDir);
        if ($workingDir === null) {
            return;
        }

        if (!@chdir($workingDir)) {
            throw new RuntimeException(sprintf(
                'Could not switch to working directory "%s"',
                $workingDir,
            ));
        }

        $event->getOutput()->writeln(
            sprintf(
                'Changing working directory to %s',
                $workingDir,
            ),
        );
    }
}
