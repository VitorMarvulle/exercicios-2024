<?php

namespace Chuva\Php\WebScrapping;

libxml_use_internal_errors(true);
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;

/**
 * Runner for the Webscrapping exercice.
 */
class Main{

    /**
     * Main runner, instantiates a Scrapper and runs.
     */
    public static function run(): void{

        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');
        $xPath = new \DOMXPath($dom);
        $filePath = './assets/model.xlsx';

        $scrapper = new Scrapper();
        $papers = $scrapper->scrap($xPath);
        /**
         * Recupera todos os dados e armazena em arrays separadamente
         */
        print_r($papers);

        /**
         * SCRIPT para escrever no doc model.xlsx usando a lib Spout.
         */

        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($filePath);

        /**
         * Busca paper com maior número de autores para gerar o Header da planilha.
         */

        $maxAuthors = 0;
        foreach ($papers as $paper) {
            $numAuthors = count($paper->authors);
            if ($numAuthors > $maxAuthors) {
                $maxAuthors = $numAuthors;
            }
        }

        /**
         * Headers (Author/Author Inst) dinâmicos com base no número máximo de autores coletados no scrapper.
         */

        $headers = ['ID', 'Title', 'Type'];
        for ($i = 1; $i < $maxAuthors - 1; $i++) {
            $headers[] = "Author{$i}";
            $headers[] = "Author{$i} Institution";
        }

        /**
         * Estilização simples da planilha com fontBold e bg-color dos headers.
         */

        $rowStyle = (new StyleBuilder())
            ->setFontBold()
            ->setBackgroundColor(Color::rgb(118, 206, 250))
            ->build();
        $headerRow = WriterEntityFactory::createRowFromArray($headers, $rowStyle);
        $writer->addRow($headerRow);

        foreach ($papers as $paper) {
            $id = $paper->id;
            $title = $paper->title;
            $type = $paper->type;
            $authors = $paper->authors;
            $rowPaper = [$id, $title, $type];

            foreach ($authors as $author) {
                $rowPaper[] = $author->name;
                $rowPaper[] = $author->institution;
            }

            $row = WriterEntityFactory::createRowFromArray($rowPaper);
            $writer->addRow($row);
        }

        $writer->close();
    }
    
}
