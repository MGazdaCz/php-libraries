<?php

namespace MGazdaCz\PhpLibraries\String;

use MGazdaCz\PhpLibraries\String\KeyWordBuilder;

use PHPUnit\Framework\TestCase;

/**
 * Test pro analyzu klicovych slov
 */
class KeyWordBuilderTest extends TestCase {
    
  public function testBuildOneWords() {
    $kb = new KeyWordBuilder(['a']);
    $this->assertEquals(['a'], $kb->getKeyWords());
    
    $kb = new KeyWordBuilder(['word']);
    $this->assertEquals(['word'], $kb->getKeyWords());
  }
  
  public function testBuild2Words() {
    $kb = new KeyWordBuilder(['a', 'b']);
    $this->assertEquals(['a b', 'b a'], $kb->getKeyWords());
  }
  
  public function testBuild3Words() {
    $kb = new KeyWordBuilder(['a', 'b', 'c']);
    $this->assertEquals([
        'a b c', 
        'a c b', 
        'b a c', 
        'b c a', 
        'c a b',
        'c b a'
    ], $kb->getKeyWords());
  }
  

}