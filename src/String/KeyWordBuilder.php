<?php

namespace MGazdaCz\PhpLibraries\String;

class KeyWordBuilder {
    /**
     * Vstupni klicova slova, z kterych budu tvorit kombinace.
     */
    private $keyWords = [];

    /**
     * Pole rozpracovanych klicovych slov. Slova jsou rozlozena v poli.
     */
    private $keyWordsArray = [];

    /**
     * Pole jiz sestavenych klicovych slov pro vraceni uzivateli.
     */
    private $retKeyWords = [];

    /**
     * Konstruktor nastavi klicova slova, z kterych budu tvorit nova klicova slova.
     */
    public function __construct(array $keyWords) {
        $this->keyWords = $keyWords;
    }

    public function buildKeyWords() {
        foreach ($this->keyWords as $startingKeyWord) {
            if ($this->containtWordNumber($startingKeyWord)) {
                continue;
            }

            $buffer = [$startingKeyWord];

            //$this->keyWordsArray[] = $buffer;

            $this->buildKeyWord($buffer, array_diff($this->keyWords, $buffer));
        }

        foreach ($this->keyWordsArray as $keyWordArray) {
            $this->retKeyWords[] = implode(' ', $keyWordArray);
        }
    }

    private function buildKeyWord(array $buffer, array $keyWords) {
        foreach ($keyWords as $keyWord) {
            if (in_array($keyWord, $buffer)) {
                continue;
            }
            if ($this->containtWordNumber($keyWord)) {
                continue;
            }

            $buffer2   = $buffer;
            $buffer2[] = $keyWord;
            $this->keyWordsArray[] = $buffer2;

            $this->buildKeyWord($buffer2, array_diff($keyWords, $buffer));
        }

        return $buffer;
    }

    /**
     * Metoda zkontroluje, zda zadane slovo obsahuje cislo. Pokud ano, vraci true.
     */
    public static function containtWordNumber($word) {
        $length = strlen($word);

        if ($length > 0) {
            for ($i = 0; $i < $length; $i++) {
                if (is_numeric($word{$i})) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Metoda vrati seznam (pole) vytvorenych klicovych slov.
     */
    public function getKeyWords() {
        return $this->retKeyWords;
    }

}