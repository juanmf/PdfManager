<?php

namespace DocDigital\Lib\PdfManager\Fpdi\Traits;

/**
 * Default implementation of PdfManager#append method with the FPDI engine.
 * 
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
trait FpdiPdfManagerInsertTrait
{    
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
    public function insert($mainPdf, $insertingPdf, $offset = 1)
    {
        $mainPdf = $this->getPdfInstance($mainPdf, false);
        $insertingPdf = $this->getPdfInstance($insertingPdf);
        
        $before = $this->getRange($mainPdf, 1, $offset - 1);
        $after = $this->getRange($mainPdf, $offset);
        
        return $this->merge(array_filter(array($before, $insertingPdf, $after)));
    }
}
