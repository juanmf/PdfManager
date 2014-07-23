<?php

namespace DocDigital\Lib\PdfManager\Fpdi\Traits;

/**
 * Default implementation of PdfManager#explode method with the FPDI engine.
 * 
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
trait FpdiPdfManagerExplodeTrait
{
    /**
     * Divide a pdf into multiple Pdfs, each containing its corresponding number 
     * of pages.
     * 
     * @param string|Pdf $pdf        Could be PDF path or Pdf Object.
     * @param int[]      $pageRanges The number of pages each resulting PDF must have.
     * Optional, if not given generates one pdf per page.
     * 
     * @return Pdf[] The PDFs
     */
    public function explode($pdf, array $pageRangesLength = array())
    {
        $pdf = $this->getPdfInstance($pdf);
        if (empty($pageRangesLength)) {
            $pageRangesLength = array_fill(0, $pdf->getPageCount(), 1);
        }
        $pdfs = array();
        $offset = 1;
        foreach ($pageRangesLength as $length) {
            $pdfs[] = $this->getRange($pdf, $offset, $length);
            $offset += $length;
        }
        return $pdfs;
    }
}
