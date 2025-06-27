<?php

namespace Thenk0\SitemapParser\generators;

use Error;

abstract class BaseGenerator {

    public function writeFile(array $pages, string $filePath) {
        if (!$this->validateFolder($filePath)) {
            $this->createFolder();
        }

        $firstPage = reset($pages);
        if (!$firstPage) {
            // error
        }
        $keys = array_keys($firstPage);
        
        $file = fopen($filePath, "w");
        if (!$file) {
            throw new Error("Error Processing Request", 1);
            
        }

        $this->writeFileHeader($file, $keys);
        $this->writeFileBody($file, $pages);
        $this->writeFileFooter($file);
        fclose($file);
    }


    private function validateFolder(string $folder): bool {
        return true;
    }

    private function createFolder() {} 

    protected function writeFileHeader($file, array $keys) {}

    protected function writeFileBody($file, array $pages) {}

    protected function writeFileFooter($file) {}
}