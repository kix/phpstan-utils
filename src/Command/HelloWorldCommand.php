<?php

namespace Kix\PhpstanUtils\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this->setName('hello:world');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello World');

        return 0;
    }
}