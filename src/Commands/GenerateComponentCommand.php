<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class GenerateComponentCommand extends Command
{
    protected static $defaultName = 'generate:component';
    protected function configure()
    {
        $this
            ->setDescription('Generate a Joomla 4 custom component folder structure')
            ->setHelp('This command generates a custom component folder structure for Joomla 4');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating Joomla 4 custom component folder structure...');

        // Get the component name from user input
        $componentName = $this->askForComponentName($input, $output);

        // Create the component folder structure
        $this->createComponentFolders($componentName);

        $output->writeln('Joomla 4 custom component folder structure generated successfully!');
        return Command::SUCCESS;
    }
    protected function askForComponentName(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('Enter the name of your custom component: ');
        return $helper->ask($input, $output, $question);
    }
    protected function createComponentFolders($componentName)
    {
        // Set the root path to your Joomla installation
        $rootPath = '/path/to/your/joomla/installation';

        // Set the path to your components folder
        $componentsPath = $rootPath . '/components';

        // Set the path to your new component folder
        $componentPath = $componentsPath . '/' . $componentName;

        // Create the component folder if it doesn't exist
        if (!file_exists($componentPath)) {
            mkdir($componentPath);
        }

        // Create the necessary subfolders
        $subfolders = ['admin', 'site', 'shared', 'media'];
        foreach ($subfolders as $subfolder) {
            $path = $componentPath . '/' . $subfolder;
            if (!file_exists($path)) {
                mkdir($path);
            }
        }
    }
}
