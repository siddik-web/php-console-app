<?php

namespace App\Commands;

use App\Component\Manifest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ManifestCommand extends Command
{
    protected function configure()
    {
        $this->setName('make:manifest')
            ->setDescription('Create Component Manifest')
            ->setHelp('Allows you to create the component manifest file. Pass the --manifest parameter.')
            ->addOption(
                'manifest',
                'm',
                InputOption::VALUE_OPTIONAL,
                'Pass the comma separated manifest info.',
                ''
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('manifest')) {
            $manifest = explode(",", $input->getOption('manifest'));
            $progressBar = new ProgressBar($output, count($manifest));

            $progressBar->start();

            if (is_array($manifest) && count($manifest)) {
                $doc =  Manifest::getInstance();
                $doc::createManifest($manifest);
                foreach ($manifest as $info) {
                    sleep(5);
                    $progressBar->advance();
                }
            }
            $progressBar->finish();
        } else {
            $output->writeln('Component manifest file created');
        }

        $output->writeln('');
        return Command::SUCCESS;
    }
}
