<?php

namespace MGazdaCz\PhpLibraries\PhpSpreadsheet;

use PhpOffice\PhpSpreadsheet\IOFactory;

class SpreadsheetReader {

  /**
   *
   * @var Spreadsheet
   */
  protected $spreadsheet;
  
  /**
   *
   * @var Worksheet
   */
  protected $activeSheet;
    

  /**
   * Konstruktor nacte existujici soubor s preklady.
   * @param string $filePath
   * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
   */
  public function __construct($filePath) {
    $this->spreadsheet = IOFactory::load($filePath);
    $this->activeSheet = $this->spreadsheet->getActiveSheet();
  }
  
  /**
   * Metoda vrati pocet listu v souboru.
   * @return int
   */
  public function getSheetsCount() {
    return $this->spreadsheet->getSheetCount();
  }
  
  /**
   * Metoda nastavi aktivni sheet dle zadaneho indexu.
   * @param int $index
   * @return bool
   */
  public function setActiveSheet(int $index) {
    if ($index > 0 && $index <= $this->getSheetsCount()) {
      $this->activeSheet = $this->spreadsheet->getSheet($index);
      
      return true;
    }
    
    return false;
  }
  
  /**
   * Metoda vrati aktivni list.
   * @return Worksheet
   */
  public function getActiveSheet() {
    return $this->activeSheet;
  }

}
