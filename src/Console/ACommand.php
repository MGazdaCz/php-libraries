<?php

namespace MGazdaCz\PhpLibraries\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class ACommand extends Command {
  /**
   * 
   * @var SymfonyStyle $io
   */
  protected $io;
  
  public function setSymfonyStyle(InputInterface $input, OutputInterface $output) {
    $this->io = new SymfonyStyle($input, $output);
  }
  
  public function title($title) {
    $this->io->title($title);
  }
  
  public function error($message) {
    $this->io->error($message);
  }
  
  public function warning($message) {
    $this->io->warning($message);
  }
  
  public function success($message) {
    $this->io->success($message);
  }

  public function write($messages, $newline = false, $timestamp = false) {
    if ($timestamp) {
      $this->io->write(date('[Y-m-d H:i:s] '));
    }

    $this->io->write($messages, $newline);
  }
  
  public function writeln($messages, $timestamp = false) {
    if ($timestamp) {
      $this->io->write(date('[Y-m-d H:i:s] '));
    }

    $this->io->writeln($messages);
  }
  
}
