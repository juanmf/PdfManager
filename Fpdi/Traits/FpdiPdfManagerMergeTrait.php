<?php

namespace DocDigital\Lib\PdfManager\Fpdi\Traits;

use \DocDigital\Lib\PdfManager\Pdf;

/**
 * Default implementation of PdfManager#merge method with the FPDI engine.
 * 
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
trait FpdiPdfManagerMergeTrait
{
    /**
     * Merges all pdfs in the given array into One. Enlarging the first Pdf in Array.
     * 
     * @param string[]|Pdf[] $pdfs Each element could be PDF path or Pdf Object.
     * 
     * @return Pdf the PDF
     */
    public function merge(array $pdfs = array())
    {
        $outPdf = $this->getPdfInstance(array_shift($pdfs));
        
        foreach ($pdfs as $pdf) {
            $outPdf->importPdf($pdf, ($pdf instanceof Pdf));
        }
        return $outPdf;
    }
}
