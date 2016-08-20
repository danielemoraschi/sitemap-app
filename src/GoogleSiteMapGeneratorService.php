<?php
/**
 * This file is part of Google Sitemap generator.
 *
 * (c) 2016 Daniele Moraschi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GoogleSiteMapGenerator;


use GuzzleHttp\Client;
use SiteMap\SiteMapGenerator;
use SiteMap\Crawler;
use SiteMap\Http\Url;
use SiteMap\Output\File\FileWriter;
use SiteMap\Parse\RegexBasedLinkParser;
use SiteMap\Policy\SameHostPolicy;
use SiteMap\Policy\UniqueUrlPolicy;
use SiteMap\Policy\ValidExtensionPolicy;
use SiteMap\Template\XmlTemplate;

class GoogleSiteMapGeneratorService
{

    /**
     * GoogleSiteMapGeneratorService.
     *
     * @param $url
     * @param $deep
     * @param $priority
     * @param $frequency
     * @param $outputFileName
     * @return mixed
     */
    public function execute($url, $deep, $priority, $frequency, $outputFileName)
    {
        $baseUrl = new Url($url);

        $crawler = new Crawler(
            $baseUrl,
            new RegexBasedLinkParser(),
            new Client()
        );

        $crawler->setPolicies([
            'host' => new SameHostPolicy($baseUrl),
            'url'  => new UniqueUrlPolicy(),
            'ext'  => new ValidExtensionPolicy(),
        ]);

        $urls = $crawler->crawl($deep);

        $generator = new SiteMapGenerator(
            new FileWriter($outputFileName),
            new XmlTemplate()
        );

        foreach ($urls as $url) {
            $generator->addUrl($url, $frequency, $priority);
        }

        return $generator->execute();
    }

}