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
    $NodeList = $xPath->query("//a[@class='paper-card p-lg bd-gradient-left']");
    $NodeListId = $xPath->query("//div[@class='volume-info']/text()");
    $NodeListTitle = $xPath->query("//h4[@class='my-xs paper-title']/text()");
    $NodeListType = $xPath->query("//div[@class='tags mr-sm']/text()");

    //iteração id, title, type
    for ($i = 0; $i < $NodeList->length; $i++) {      //usarei o xPath dos cards como índice para iterar
      $id = $NodeListId->item($i)->textContent;
      $title = $NodeListTitle->item($i)->textContent;
      $type = $NodeListType->item($i)->textContent;
      
      $authors = [];

    //iteração authors_name, authors_inst  
      $NodeListAuthors = $xPath->query("//a[$i+1]//div[@class='authors']/span/text()");        $NodeListAuthors_name = $xPath->query("//a[$i+1]//div[@class='authors']/span/text()");
      $NodeListAuthors_inst = $xPath->query("//a[$i+1]//div[@class='authors']//span/@title");
       for ($j = 0; $j < $NodeListAuthors->length; $j++){
            
            $name = $NodeListAuthors_name->item($j)->textContent;
            $institution = $NodeListAuthors_inst->item($j)->textContent;
            $authors[] = new Person(
              $name,
              $institution
            );
          }
      
      $papers[] = new Paper(
          $id,
          $title,
          $type,
          $authors
      );
  }
  return $papers;
}



}
