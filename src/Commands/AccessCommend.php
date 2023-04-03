<?php

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateXmlCommand extends Command
{
    protected static $defaultName = 'generate:xml';

    protected function configure()
    {
        $this->setDescription('Generates an XML file with access information for a component.')
            ->setHelp('This command allows you to generate an XML file with access information for a component.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $component = 'com_contact';
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->formatOutput = true;

        $access = $doc->createElement('access');
        $access->setAttribute('component', $component);

        $section = $doc->createElement('section');
        $section->setAttribute('name', 'component');

        while (true) {
            $actionName = $this->askActionName($input, $output);
            if (!$actionName) {
                break;
            }
            $title = $this->askActionTitle($input, $output);

            $action = $doc->createElement('action');
            $action->setAttribute('name', $actionName);
            $action->setAttribute('title', $title);

            $section->appendChild($action);
        }

        $access->appendChild($section);
        $doc->appendChild($access);

        $xml = $doc->saveXML();
        file_put_contents('access.xml', $xml);

        $output->writeln('XML file generated successfully.');

        return Command::SUCCESS;
    }

    private function askActionName(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new \Symfony\Component\Console\Question\Question('Action name (leave empty to stop): ');

        return $helper->ask($input, $output, $question);
    }

    private function askActionTitle(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new \Symfony\Component\Console\Question\Question('Action title: ');

        return $helper->ask($input, $output, $question);
    }
}
