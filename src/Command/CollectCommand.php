<?php

namespace Kix\PhpstanUtils\Command;

use Kix\PhpstanUtils\Collector;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CollectCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('collect')
            ->addArgument('baseline-filename', InputArgument::REQUIRED, 'Path to baseline file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $collector = new Collector();
        $collector->collect($input->getArgument('baseline-filename'));

        return 0;
    }
}