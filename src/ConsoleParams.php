<?php

namespace MGazdaCz\PhpLibraries\ConsoleParams;

class ConsoleParams {

    private $paramsMap;

    private $params;

    public function __construct(array $paramsMap = []) {
        $this->paramsMap = $paramsMap;
        $this->params = $_SERVER['argv'];
    }

    public function getParam($paramNumber) {
        if (isset($this->params[$paramNumber])) {
            return $this->params[$paramNumber];
        }

        return null;
    }

}
