<?php

namespace DocDigital\Lib\PdfManager;

/**
 * This Interface exposes required method signatures for:
 *   Generating Pdf stream and returning it.
 *   Getting Page Count.  
 *   
 * TODO:
 *   So far is too similar to FPDI interface. Think it might be useful when 
 *   implementing other engines
 *    
 * @author Juan Manuel Fernandez <juanmf@gmail.com>
 */
interface Pdf
{
    /**
     * To accomplish engine specifics.
     * 
     * @return mixed The underlying object providing functionality
     */
    public function getEngine();
    
    /**
     * Returns de PDF Page Count.
     * 
     * @return mixed The underlying object providing functionality
     */
    public function getPageCount();
    
    /**
     * Renders the PDF binary stream.
     * 
     * @return string The PDF binary stream
     */
    public function render();
    
    /**
     * Renders the PDF binary stream to the given path.
     * 
     * @return string The PDF binary stream
     */
    public function renderFile($filename);
    
    /**
     * Must import an exsting PDF and allow to continue working with it.
     * 
     * @param string|Pdf $filename        Either the path or an other Pdf Instance
     * @param boolean    $onlyPreImported If $filename is a Pdf Instance, it might 
     * have already imported just some pages of its source. 
     * if this is the case, respect that page selection instead of importing all.
     * Optional, defaults to false.
     */
    public function importPdf($filename, $onlyPreImported = false);
    
    /**
     * For importing pages from other PDF into this PDF
     * @param type $filename
     */
    public function setSourceFile($filename);
    
    /**
     * For importing pages from other PDF into this PDF
     * @param type $filename
     */
    public function importPage($pageNo, $boxName = 'CropBox', $groupXObject = true);
    
    public function addPage($orientation = '', $format = '', $keepmargins = false, $tocpage = false);
    public function setFont($family, $style = '', $size = null, $fontfile = '', $subset = 'default', $out = true);
    public function setXY($x, $y);
    public function setX($x);
    public function setY($y);
}
