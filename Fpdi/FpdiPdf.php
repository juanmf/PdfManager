<?php

namespace DocDigital\Lib\PdfManager\Fpdi;

use DocDigital\Lib\PdfManager\Pdf;
use fpdi\FPDI as Fpdi;

/**
 *    
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
class FpdiPdf extends Fpdi implements Pdf
{
    
    /**
     * To accomplish engine specifics.
     * 
     * @return mixed The underlying object providing functionality
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * Must import an exsting PDF and allow to continue working with it.
     * 
     * @param string|Pdf $filename        Either the path or an other Pdf Instance
     * @param boolean    $onlyPreImported If $filename is a Pdf Instance, it might 
     * have already imported just some pages of its {@link FPDI#currentFilename}. 
     * if this is the case, respect that page selection instead of importing all.
     * Optional, defaults to false.
     */
    public function importPdf($filename, $onlyPreImported = false)
    {
        $pages = $this->setSourceFile($filename);
        if ($onlyPreImported) {
            if (! ($filename instanceof Pdf)) {
                return;
            }
            
            foreach ($filename->_importedPages as $k => $tplId) {
                // Recycling $filename's Tpls
                $tpl = $filename->_tpls[$tplId];
                $this->tpl++;
                $this->_tpls[$this->tpl] = $tpl;
                $this->_importedPages[$k] = $this->tpl;
                //use the imported page and place it at point 0,0; calculate width and height
                //automaticallay and ajust the page size to the size of the imported page 
                $this->addPage();
                $this->useTemplate($this->tpl, null, null, 0, 0, true); 
            }
            return;
        }
        for ($i = 1; $i <= $pages; $i++) {
            $this->addPage();
            //use the imported page and place it at point 0,0; calculate width and height
            //automaticallay and ajust the page size to the size of the imported page 
            $this->useTemplate($this->importPage($i), null, null, 0, 0, true); 
        }
    }
    
    /**
     * overrides setSourceFile to replace currentParser if $filename is already a 
     * Pdf instance.
     * 
     * @param Pdf|string $filename
     */
    public function setSourceFile($filename)
    {
        if ($filename instanceof Pdf) {
            return parent::setSourceFile($filename->currentFilename);
        } else {
            return parent::setSourceFile($filename);
        }
        // FIX: tried to be more efficiend but using same parsers brings issues clonning too.
        $newPdf = $filename;
        $this->currentFilename =  $newPdf->currentFilename;

        $this->parsers[$newPdf->currentFilename] = $newPdf->parsers[$newPdf->currentFilename];
        $this->setPdfVersion(
            max($this->getPdfVersion(), $newPdf->currentParser->getPdfVersion())
        );
        $this->currentParser = $this->parsers[$newPdf->currentFilename];
        return $this->currentParser->getPageCount();
    }
    
    /*
     * Adds a new page to the document.
     *
     * See FPDF/TCPDF documentation.
     *
     * This method cannot be used if you'd started a template.
     *
     * @see http://fpdf.org/en/doc/addpage.htm
     * @see http://www.tcpdf.org/doc/code/classTCPDF.html#a5171e20b366b74523709d84c349c1ced
     */
    public function addPage($orientation = '', $format = '', $keepmargins = false, $tocpage = false)
    {
        return parent::AddPage($orientation, $format, $keepmargins, $tocpage);
    }
    
    public function setFont($family, $style = '', $size = null, $fontfile = '', $subset = 'default', $out = true)
    {
        return parent::setFont($family, $style, $size, $fontfile, $subset, $out);
    }
            
    public function setXY($x, $y)
    {
        return parent::SetXY($x, $y);
    }
    
    public function setX($x)
    {
        return parent::SetX($x);
    }
    
    public function setY($y)
    {
        return parent::SetY($y);
    }

    public function render()
    {
        return $this->Output('', 'S');
    }

    public function renderFile($filename)
    {
        return $this->Output($filename);
    }

    public function getPageCount()
    {
        return $this->currentParser->getPageCount();
    }
}
