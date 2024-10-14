<?php
namespace TeRacksito\Rolgame;

class Cleric extends Character implements Healable
{
  public $healing_power;

  public function __construct($name, $level, $hp, $healing_power)
  {
    parent::__construct($name, $level, $hp);
    $this->healing_power = $healing_power;
  }

  public function attack()
  {
    return $this->healing_power * 2;
  }

  public function defend($initial_damage)
  {
    $final_damage = $initial_damage - $this->healing_power / 2;
    return $final_damage > 0 ? $final_damage : 0;
  }

  public function heal()
  {
    return $this->healing_power * 3;
  }
}