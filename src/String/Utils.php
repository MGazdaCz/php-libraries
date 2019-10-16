<?php

namespace MGazdaCz\PhpLibraries\String;

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

}
