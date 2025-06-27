<?php

require 'vendor/autoload.php';

use Thenk0\SitemapParser\SitemapGenerator;
use Thenk0\SitemapParser\enums\SitemapFileType;

new SitemapGenerator(SitemapFileType::CSV, [], './');