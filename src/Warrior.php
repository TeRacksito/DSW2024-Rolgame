<?php

namespace TeRacksito\Rolgame;

class Warrior extends Character
{
  public $strength;

  public function __construct($name, $level, $hp, $strength)
  {
    parent::__construct($name, $level, $hp);
    $this->strength = $strength;
  }

  public function attack()
  {
    return $this->level * $this->strength;
  }

  public function defend($initial_damage)
  {
    $final_damage = $initial_damage - $this->strength / 2;
    return max($final_damage, 0);
  }
}
