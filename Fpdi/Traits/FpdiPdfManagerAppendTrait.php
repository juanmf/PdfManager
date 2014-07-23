<?php

namespace DocDigital\Lib\PdfManager\Fpdi\Traits;

/**
 * Default implementation of PdfManager#append method with the FPDI engine.
 * 
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
trait FpdiPdfManagerAppendTrait
{
    /**
     * Concatenate the PDF in path to the given PDF object. 
     * 
     * @param string|Pdf $mainPdf      The Pdf to append to, or its path.
     * @param string|Pdf $appendingPdf The Pdf to append, or its path.
     * 
     * @return Pdf The PDF
     */
    public function append($mainPdf, $appendingPdf)
    {
        return $this->merge(array($mainPdf, $appendingPdf));
    }
}
