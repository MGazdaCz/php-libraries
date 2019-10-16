<?php

namespace MGazdaCz\PhpLibraries\String;

use Nette\Utils\Strings;

class Utils {

    /**
     * Metoda hleda bud text nebo pole textu pomoci metody strpos.
     */
    public static function strpos($haystack, $needle) {
        if (!is_array($needle)) {
            $needle = [$needle];
        }

        if (!empty($needle)) {
            foreach ($needle as $findMe) {
                if (strpos($haystack, $findMe) !== false) {
                    return true;
                }
            }
        }

        return false;
    }
    
    public static function upperCamelCase(string $string) {
      $string = Strings::toAscii($string);
      $string = Strings::lower($string);
      
      $stringArray = explode(' ', $string);
      
      if (!empty($stringArray)) {
        foreach ($stringArray as $key => $s) {
          if (strlen($s) > 0) {
            $s{0} = strtoupper($s{0});
            
            $stringArray[$key] = $s;
          }
        }
        
        $string = implode('', $stringArray);
      }
      
      return $string;
    }

}
