<?php

namespace DocDigital\Lib\PdfManager\Fpdi\Traits;

/**
 * Default implementation of PdfManager#append method with the FPDI engine.
 * 
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
trait FpdiPdfManagerGetRangeTrait
{
    /**
     * Get the pages present in $range.
     * 
     * @param Pdf|string $pdf    The PDF or its path
     * @param int        $offset The page at wich start, 1 based. 
     * @param int        $length the number of pages
     * 
     * @return null|Pdf The PDF containing range pages. Null if offset is out of
     * boundaries.
     */
    public function getRange($pdf, $offset, $length = null)
    {
        $outPdf = $this->getPdfInstance();
        $outPdf->setSourceFile($pdf);
        $offset > $outPdf->getPageCount() && $offset = $outPdf->getPageCount() + 1;
        $top = (null === $length) ? $outPdf->getPageCount() + 1 : ($offset + $length);
        $top > ($outPdf->getPageCount() + 1) && $top = $outPdf->getPageCount() + 1;
        $retNull = true;
        for ($i = $offset; $i < $top; $i++) {
            $retNull = false;
            $outPdf->addPage();
            //use the imported page and place it at point 0,0; calculate width and height
            //automaticallay and ajust the page size to the size of the imported page 
            $outPdf->useTemplate($outPdf->importPage($i), null, null, 0, 0, true);
        }
        return $retNull ? null : $outPdf;
    }
}
