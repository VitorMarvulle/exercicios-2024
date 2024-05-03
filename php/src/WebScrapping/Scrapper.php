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
    $NodeListTitle = $xPath->query("//h4[@class='my-xs paper-title']/text()");
    $NodeListType = $xPath->query("//div[@class='tags mr-sm']/text()");
    $papers = []; //armazenar os dados dos papers em array

    for ($i = 0; $i < $NodeList->length; $i++) {
      $id = $NodeList->item($i)->textContent;
      $title = $NodeListTitle->item($i)->textContent;
      $type = $NodeListType->item($i)->textContent;
      $papers[] = new Paper(
          $id,
          $title,
          $type
      );
  }

  return $papers;
}



}
