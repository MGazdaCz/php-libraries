<?php

namespace MGazdaCz\PhpLibraries\String;

use MGazdaCz\PhpLibraries\String\KeyWordBuilder;

/**
 * Jednoducha trida pro analyzu predanych vet (slov)
 */
class WordAnalyzer {
    private $words     = [];
    private $keyWords  = [];
    private $keyWords2 = [];

    public function __construct() {

    }

    /**
     * Prida analyzovane slovo do statistik
     */
    public function analyzeWord($word) {
        $this->word[] = $word;
        
        $keyWords = explode(' ', $word);

        if (!empty($keyWords)) {
            // kontrola jednoslovnych slov
            foreach ($keyWords as $keyWord) {
                if (!KeyWordBuilder::containtWordNumber($keyWord)) {
                    if (isset($this->keyWords[$keyWord])) {
                        $this->keyWords[$keyWord]++;
                    } else {
                        $this->keyWords[$keyWord] = 1;
                    }
                }
            }

            // kontrola viceslovnych slov (kombinaci)
            $keyWordBuilder = new KeyWordBuilder($keyWords);
            $keyWordBuilder->buildKeyWords();
            foreach ($keyWordBuilder->getKeyWords() as $newKeyWord) {
                if (empty($word) || empty($newKeyWord)) {
                    continue;
                }
                if (strpos($word, $newKeyWord) !== false) {
                    if (isset($this->keyWords2[$newKeyWord])) {
                        $this->keyWords2[$newKeyWord]++;
                    } else {
                        $this->keyWords2[$newKeyWord] = 1;
                    }
                }
            }
        }
    }

    /**
     * Seradi klicova slova podle vyskytu od nejcetnejsich
     */
    public function sortKeyWords() {
        arsort($this->keyWords);
        arsort($this->keyWords2);
    }

    public function removeNumbersFromKeyWords() {
        foreach ($this->keyWords as $keyWord => $count) {
            if (is_numeric($keyWord)) {
                unset($this->keyWords[$keyWord]);
            }
        }
    }

    /**
     * Metoda preda zadany pocet klicovych slov v poli
     */
    public function getFirstWords($limit = 10) {
        return $this->getWords($this->keyWords, $limit);
    }

    /**
     * Metoda preda zadany pocet klicovych slov v poli
     */
    public function getFirstWords2($limit = 10) {
        return $this->getWords($this->keyWords2, $limit);
    }

    private function getWords($words, $limit) {
        $retWords = [];
        $i = 1;
        foreach ($words as $keyWord => $count) {
            $retWords[] = [
                $keyWord,
                $count
            ];

            if ($i++ > $limit) {
                break;
            }
        }

        return $retWords;
    }

}