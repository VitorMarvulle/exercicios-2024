<?php

namespace Chuva\Php\WebScrapping;
libxml_use_internal_errors(true); //nao imprime os warnings de tags (CSS) inválidas
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

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
    $filePath = './assets/model.xlsx';
   
    $scrapper = new Scrapper();
    $papers = $scrapper->scrap($xPath);

    print_r($papers);  //recupera todos os dados e armazena em arrays separadamente

  


  $writer = WriterEntityFactory::createXLSXWriter();

  
  $writer->openToFile($filePath); // write data to a file or to a PHP stream
  //$writer->openToBrowser($fileName); // stream data directly to the browser

  
  /** Shortcut: add a row from an array of values */
  $values = ['Carl', 'is', 'greataaasdasdasdas!'];
  $rowFromValues = WriterEntityFactory::createRowFromArray($values);
  $writer->addRow($rowFromValues);
  
  $writer->close();

  }

}
