<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper
{

    /**
     * Loads paper information from the HTML and returns the array with the data.
     */
    public function scrap(\DOMXPath $xPath): array
    {
        $nodeList = $xPath->query("//a[@class='paper-card p-lg bd-gradient-left']");
        $nodeListId = $xPath->query("//div[@class='volume-info']/text()");
        $nodeListTitle = $xPath->query("//h4[@class='my-xs paper-title']/text()");
        $nodeListType = $xPath->query("//div[@class='tags mr-sm']/text()");


        for ($i = 0; $i < $nodeList->length; $i++) {
            $id = $nodeListId->item($i)->textContent;
            $title = $nodeListTitle->item($i)->textContent;
            $type = $nodeListType->item($i)->textContent;

            $authors = [];

  
            $nodeListAuthors = $xPath->query("//a[$i+1]//div[@class='authors']/span/text()");
            $nodeListAuthors_name = $xPath->query("//a[$i+1]//div[@class='authors']/span/text()");
            $nodeListAuthors_inst = $xPath->query("//a[$i+1]//div[@class='authors']//span/@title");
            for ($j = 0; $j < $nodeListAuthors->length; $j++) {
                $name = $nodeListAuthors_name->item($j)->textContent;
                $institution = $nodeListAuthors_inst->item($j)->textContent;
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
