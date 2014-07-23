<?php

namespace DocDigital\Lib\PdfManager;

/**
 * This Interface exposes required method signatures for:<pre>
 *   Merging
 *   explode
 *   Append Range
 *   Prepend Range
 *   Extract Range
 *   Insert Range after Page N
 *   
 * Wish List:
 *   Find Pages in PDF given a single pdf Page.
 * </pre>
 * 
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
interface PdfManager
{
    /**
     * Merges all pdfs in the given array into One.
     * 
     * @param string[]|Pdf[] $pdfs Each element could be PDF path or Pdf Object.
     * 
     * @return mixed the PDF
     */
    public function merge(array $pdfs);
    
    /**
     * Divide a pdf into multiple Pdfs, each containing its corresponding number 
     * of pages.
     * 
     * @param string|Pdf $pdf        Could be PDF path or Pdf Object.
     * @param int[]      $pageRanges The number of pages each resulting PDF must have.
     * Optional, if not given generates one pdf per page.
     * 
     * @return Pdf The PDFs
     */
    public function explode($pdf, array $pageRanges = array());
    
    /**
     * Concatenate the PDF in path to the given PDF object. 
     * 
     * @param string|Pdf  $pdf1
     * @param string|Pdf  $pdf2
     * 
     * @return Pdf The PDF
     */
    public function append($pdf, $path);
    
    /**
     * Get the pages present in $range.
     * 
     * @param Pdf|string $pdf    The PDF or its path
     * @param int        $offset The page at wich start, 1 based. 
     * @param int        $length the number of pages
     * 
     * @return  Pdf The PDF containing range pages.
     */
    public function getRange($pdf, $offset, $length);
    
    /**
     * Insert given PDF at page $offset. I.e. Pdf1 = {a, b, c}. Pdf2 = {x}
     * insert(Pdf1, Pdf2, 1) = {x, a, b, c}  
     * insert(Pdf1, Pdf2, 2) = {a, x, b, c}  
     * insert(Pdf1, Pdf2, 10) = {a, b, c, x}  
     * 
     * @param string|Pdf $mainPdf      The PDF that will gain $insertingPdf pages at $offset
     * @param string|Pdf $insertingPdf The inserting pages.
     * @param int        $offset       The page number at which $insertingPdf pages 
     * will start. Optional, defaults to 1 which makes insert act as prepend.
     * 
     * @return Pdf Resulting PDF.
     */
    public function insert($mainPdf, $insertingPdf, $offset = 1);
    
    /**
     * If $pdfPath is a string, import thereferenced PDF and return a Pdf instance.
     * 
     * @param string|Pdf $pdfPath     Either the path or the Pdf Object
     * @param boolean    $importPages If Import PDF pages or not.
     * 
     * @return \DocDigital\Lib\PdfManager\Pdf
     */
    public function getPdfInstance($pdfPath = '', $importPages = true);
}
