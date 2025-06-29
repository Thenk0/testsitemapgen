<?php

namespace Thenk0\SitemapParser;

use Thenk0\SitemapParser\enums\SitemapFileType;
use Thenk0\SitemapParser\validation\SitemapValidation;

interface ISitemapGenerator {}

class SitemapGenerator implements ISitemapGenerator
{
    function __construct(SitemapFileType $fileType, array $sitePages, string $savePath)
    {
        SitemapValidation::parse($fileType, $sitePages, $savePath);

        $this->generate($fileType, $sitePages, $savePath);
    }

    private function generate(SitemapFileType $fileType, array $sitePages, string $savePath)
    {
        $writer = $this->getWriter($fileType);
        $writer->writeFile($sitePages, $savePath);
    }

    private function getWriter(SitemapFileType $fileType)
    {
        return $fileType->writer();
    }
}
