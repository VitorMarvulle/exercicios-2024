<?php

namespace Chuva\Php\WebScrapping;
libxml_use_internal_errors(true); //nao imprime os warnings de tags (CSS) inválidas

/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');
    $xPath = new \DOMXPath($dom);
   
    $scrapper = new Scrapper();
    $papers = $scrapper->scrap($xPath);

    print_r($papers);

  }

}
