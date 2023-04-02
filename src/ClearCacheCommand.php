<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCacheCommand extends Command
{
    protected function configure()
    {
        $this->setName('clear-cache')
            ->setDescription('Clears the application cache.')
            ->setHelp('Allows you to delete the application cache. Pass the --groups parameter to clear caches of specific groups.')
            ->addOption(
                'groups',
                'g',
                InputOption::VALUE_OPTIONAL,
                'Pass the comma separated group names if you don\'t want to clear all caches.',
                ''
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('groups')) {
            $groups = explode(",", $input->getOption('groups'));
            $progressBar = new ProgressBar($output, count($groups));

            $progressBar->start();

            if (is_array($groups) && count($groups)) {
                foreach ($groups as $group) {
                    sleep(5);
                    $progressBar->advance();
                }
            }
            $progressBar->finish();
        } else {
            $output->writeln('All caches are cleared.');
        }

        $output->writeln('');
        return Command::SUCCESS;
    }
}
