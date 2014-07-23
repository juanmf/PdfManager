<?php

namespace DocDigital\Lib\PdfManager\Fpdi;

use DocDigital\Lib\PdfManager\Fpdi\Traits;
use DocDigital\Lib\PdfManager\PdfManager;
use DocDigital\Lib\PdfManager\Pdf;

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
class FpdiPdfManager implements PdfManager
{
    use Traits\FpdiPdfManagerAppendTrait, Traits\FpdiPdfManagerMergeTrait, 
        Traits\FpdiPdfManagerExplodeTrait, Traits\FpdiPdfManagerInsertTrait, 
        Traits\FpdiPdfManagerGetRangeTrait;
    
    /**
     * If $pdfPath is a string, import thereferenced PDF and return a Pdf instance.
     * 
     * @param string|\DocDigital\Lib\PdfManager\Pdf $pdfPath Either the path 
     * or the Pdf Object
     * @param boolean                                     $importPages If Import
     * PDF pages or not.
     * 
     * @return \DocDigital\Lib\PdfManager\Pdf
     */
    public function getPdfInstance($pdfPath = '', $importPages = true)
    {
        if ('' === $pdfPath) {
            return new FpdiPdf();
        }
        if (! ($pdfPath instanceof Pdf)) {
            $pdf = new FpdiPdf();
            $pdf->importPdf($pdfPath, ! $importPages);
        } else {
            $pdf = $pdfPath;
        }
        return $pdf;
    }
}
