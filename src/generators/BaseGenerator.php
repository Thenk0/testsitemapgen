<?php

namespace Thenk0\SitemapParser\generators;

use Thenk0\SitemapParser\exceptions\ErrorCreatingFile;

interface GeneratorInterface
{
    public function writeFile(array $pages, string $filePath);
}

abstract class BaseGenerator implements GeneratorInterface
{

    public function writeFile(array $pages, string $filePath)
    {
        $dirname = pathinfo($filePath, PATHINFO_DIRNAME);
        if (!file_exists($dirname)) {
            mkdir($dirname, 0755, true);
        }

        $firstPage = reset($pages);
        $keys = array_keys($firstPage);

        $file = fopen($filePath, "w");
        if (!$file) {
            throw new ErrorCreatingFile("Problem with creating file, check permissions", 1);
        }

        $this->writeFileHeader($file, $keys);
        $this->writeFileBody($file, $pages);
        $this->writeFileFooter($file);
        fclose($file);
    }

    protected function writeFileHeader($file, array $keys) {}

    protected function writeFileBody($file, array $pages) {}

    protected function writeFileFooter($file) {}
}
