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

    foreach ($papers as $paper){
      $paper->id;
    }

    print_r($papers);


    //$data = (new Scrapper())->scrap($dom);

    // Write your logic to save the output file bellow.
    //print_r($data);
    //echo($data);
    
    

  }

}
