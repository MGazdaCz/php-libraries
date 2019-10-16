<?php

namespace MGazdaCz\PhpLibraries\FileSystem;

class Utils {

    /**
     * Metoda hleda bud text nebo pole textu pomoci metody strpos.
     */
    public static function dirContent($dirPath, $removeDots = false) {
        $dirContent = [];
        
        if (is_dir($dirPath)) {
          $dirContent = scandir($dirPath);
          
          if ($removeDots) {
            $dirContentCount = count($dirContent);
            for ($i = 0; $i < $dirContentCount; $i++) {
              if (in_array($dirContent[$i], ['.', '..'])) {
                unset($dirContent[$i]);
              }
            }
          }
        }
        
        return array_values($dirContent);
    }

}
