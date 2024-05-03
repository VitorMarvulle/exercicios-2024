<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMXPath $xPath): array {
    $NodeList = $xPath->query("//div[@class='volume-info']/text()");
    $papers = []; //armazenar os dados dos papers em array

    foreach ($NodeList as $Node){
      $id = $Node->textContent;

      $papers[]= new Paper(
        $id,
        'Título teste',
        'Título teste2'
      );
    }
    return $papers;
  }



}
