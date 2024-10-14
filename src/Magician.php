<?php
namespace TeRacksito\Rolgame;

class Magician extends Character
{
  public $mana;

  public function __construct($name, $level, $hp, $mana)
  {
    parent::__construct($name, $level, $hp);
    $this->mana = $mana;
  }

  public function attack()
  {
    return $this->mana / 2;
  }

  public function defend($initial_damage)
  {
    $final_damage = $initial_damage - $this->mana / 5;
    return max($final_damage, 0);
  }
}