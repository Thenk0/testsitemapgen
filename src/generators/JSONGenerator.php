<?php

namespace Thenk0\SitemapParser\generators;

class JSONGenerator extends BaseGenerator {
    protected function writeFileBody($file, array $pages) {
        fwrite($file, json_encode($pages));
    }
}