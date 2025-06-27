<?php

namespace Thenk0\SitemapParser\validation;

use Thenk0\SitemapParser\enums\SitemapFileType;
use Thenk0\SitemapParser\exceptions\EmptyPathException;
use Thenk0\SitemapParser\exceptions\NoPagesException;
use Thenk0\SitemapParser\exceptions\ValidationInvalidUrlException;
use Thenk0\SitemapParser\exceptions\ValidationNoKeyException;
use Thenk0\SitemapParser\exceptions\ValidationConstraintException;
use Thenk0\SitemapParser\exceptions\ValidationTypeException;
use DateTime;
use Thenk0\SitemapParser\exceptions\ValidationInvalidDateException;

interface ISitemapValidation {}

class SitemapValidation implements ISitemapValidation
{

    static $changefreq = [
        "always",
        "hourly",
        "daily",
        "weekly",
        "monthly",
        "yearly",
        "never"
    ];

    public static function parse(SitemapFileType $fileType, array $sitePages, string $savePath)
    {
        if (!count($sitePages)) throw new NoPagesException();

        if (!strlen($savePath)) throw new EmptyPathException();

        $pageIndex = 0;
        foreach ($sitePages as $page) {
            self::validatePage($page, $pageIndex);
            $pageIndex++;
        }
    }

    private static function validatePage(array $page, int $pageIndex)
    {
        if (!isset($page["loc"])) throw new ValidationNoKeyException("Key 'loc' is missing from page index: $pageIndex");
        if (!isset($page["lastmod"])) throw new ValidationNoKeyException("Key 'lastmod' is missing from page index: $pageIndex");
        if (!isset($page["priority"])) throw new ValidationNoKeyException("Key 'priority' is missing from page index: $pageIndex");
        if (!isset($page["changefreq"])) throw new ValidationNoKeyException("Key 'changefreq' is missing from page index: $pageIndex");

        $loc = $page["loc"];
        $lastmod = $page["lastmod"];
        $priority = $page["priority"];
        $changefreq = $page["changefreq"];

        if (!filter_var($loc, FILTER_VALIDATE_URL)) throw new ValidationInvalidUrlException("Key 'loc' url is invalid on page index: $pageIndex");

        if (DateTime::createFromFormat('Y-m-d', $lastmod) === false) {
            throw new ValidationInvalidDateException("Key 'lastmod' date is invalid on page index: $pageIndex");   
        } 

        if (!is_float($priority)) {
            throw new ValidationTypeException("Key 'priority' constraint fail on page index: $pageIndex, value must be float");
            
        }
        if ($priority < 0.0 || $priority > 1.0) {
            throw new ValidationConstraintException("Key 'priority' constraint fail on page index: $pageIndex, value must be in range of 0.0, 1.0, value is $priority");
        }

        if (!in_array($changefreq, self::$changefreq)) {
            $freq = implode(', ',self::$changefreq);
            $freq = "[ $freq ]";
            throw new ValidationConstraintException("Key 'changefreq' value is invalid on page index: $pageIndex: Value $changefreq must be one of $freq");
        }
    }
}
