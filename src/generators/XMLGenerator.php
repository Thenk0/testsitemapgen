<?php

namespace Thenk0\SitemapParser\generators;

use SimpleXMLElement;

class XMLGenerator extends BaseGenerator {

    private SimpleXMLElement $xml;

    function __construct()
    {
        $this->xml = new SimpleXMLElement('<urlset/>');
    }
    
    protected function writeFileHeader($file, array $keys) {
        $this->xml = new SimpleXMLElement('<urlset/>');
        $this->xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        $this->xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $this->xml->addAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    }

    protected function writeFileBody($file, array $pages) {
        foreach ($pages as $page) {
            $pagexml = $this->xml->addChild('url');
            foreach ($page as $key => $value) {
                $pagexml->addChild($key, $value);
            }
        }
    }

    protected function writeFileFooter($file) {
        fwrite($file, $this->xml->asXML());
    }
}