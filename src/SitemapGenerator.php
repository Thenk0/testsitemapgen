<?php

namespace Thenk0\SitemapParser;

use Thenk0\SitemapParser\enums\SitemapFileType;
use Thenk0\SitemapParser\parser\SitemapParser;

interface ISitemapGenerator {}

class SitemapGenerator implements ISitemapGenerator
{
    function __construct(SitemapFileType $fileType, array $sitePages, string $savePath) {
        SitemapParser::parse($fileType, $sitePages, $savePath);

        $this->generate();
    }

    private function generate() {

    }

    private function getWriter() {
        
    }
}
