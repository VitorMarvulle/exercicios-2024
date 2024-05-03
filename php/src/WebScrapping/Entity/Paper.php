<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * The Paper class represents the row of the parsed data.
 */
class Paper {

  /**
   * Paper Id.
   *
   * @var int
   */
  public $id;

  /**
   * Paper Title.
   *
   * @var string
   */
  public $title;


  /**
   * The paper type (e.g. Poster, Nobel Prize, etc).
   *
   * @var string
   */
  public $type;

  /**
   * Paper authors.
   *
   * @var \Chuva\Php\WebScrapping\Entity\Person[]
   */
  public $authors;

  /**
   * Builder.
   */
  public function __construct($id, $title, $type /* $authors = [] */) {
    
    $this->id = $id;
    $this->title = $title;
    $this->type = $type;
    //$this->authors = $authors; */ 
  }

  //Funçao p/ percorrer e capturar os IDs nos cards e salvar em uma NodeList.
/*   public function getPaperId(\DOMXPath $xPath): ?String {
    $NodeListId = $xPath->query("//div[@class='volume-info']/text()");
    if ($NodeListId->length > 0) {
      return $NodeListId->item(0)->textContent;
    }
  }

  public function getPaperTitle(){
    $NodeListTitle = $xPath->query("//h4[@class='my-xs paper-title']/text()");
    if ($NodeListTitle->length > 0) {
      return $NodeListTitle->item(0)->textContent;
    }
  }

  public function getPaperType(){
    
  } */
  
}
