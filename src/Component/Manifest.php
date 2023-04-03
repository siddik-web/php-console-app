<?php

namespace App\Component;

use Symfony\Component\Filesystem\Filesystem;

class Manifest
{
    private static $instance;

    public static function getInstance()
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }

        return new self();
    }

    public static function createManifest(array $info = ['component', 'contact'])
    {
        $manifest = file_get_contents(dirname(__FILE__, 3) . '/resources/extension.txt');

        $manifest = str_replace(['{{type}}', '{{name}}'], $info, $manifest);

        $filesystem = new Filesystem();

        if (!$filesystem->exists(dirname(__FILE__, 3) . '/build/com_' . $info[1])) {
            $filesystem->mkdir(dirname(__FILE__, 3) . '/build/com_' . $info[1]);
        }

        if ($filesystem->exists(dirname(__FILE__, 3) . '/build/com_' . $info[1])) {
            $filesystem->appendToFile(dirname(__FILE__, 3) . '/build/com_' . $info[1] . '/' . $info[1] . '.xml', $manifest);
        }

        echo json_encode($manifest) . PHP_EOL;
    }
}
