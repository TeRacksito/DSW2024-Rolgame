<?php
namespace TeRacksito\Rolgame;

abstract class Character 
{
  public $name;
  public $level;
  public $hp;

  public function __construct($name, $level, $hp)
  {
    $this->name = $name;
    $this->level = $level;
    $this->hp = $hp;
  }

  abstract public function attack();
  abstract public function defend($initial_damage);

  public function levelUp() 
  {
    $this->level++;
  }
}