<?php

namespace Thenk0\SitemapParser\generators;

class CSVGenerator extends BaseGenerator
{
    protected function writeFileHeader($file, array $keys)
    {
        fwrite($file, implode(";", $keys));
        fwrite($file, "\n");
    }

    protected function writeFileBody($file, array $pages)
    {
        foreach ($pages as $page) {
            fwrite($file, implode(";", array_values($page)));
            fwrite($file, "\n");
        }
    }
}
