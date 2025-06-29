<?php

namespace Thenk0\SitemapParser\enums;

use Thenk0\SitemapParser\generators\BaseGenerator;
use Thenk0\SitemapParser\generators\CSVGenerator;
use Thenk0\SitemapParser\generators\JSONGenerator;
use Thenk0\SitemapParser\generators\XMLGenerator;

enum SitemapFileType
{
    case CSV;
    case JSON;
    case XML;

    public function writer(): BaseGenerator
    {
        return match ($this) {
            SitemapFileType::CSV, SitemapFileType::CSV => new CSVGenerator(),
            SitemapFileType::JSON, SitemapFileType::JSON => new JSONGenerator(),
            SitemapFileType::XML, SitemapFileType::XML => new XMLGenerator(),
        };
    }

    public function getStringExtension(): string
    {
        return match ($this) {
            SitemapFileType::CSV, SitemapFileType::CSV => 'csv',
            SitemapFileType::JSON, SitemapFileType::JSON => 'json',
            SitemapFileType::XML, SitemapFileType::XML => 'xml',
        };
    }
}
