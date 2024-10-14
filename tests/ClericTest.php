<?php

use TeRacksito\Rolgame\Cleric;
use PHPUnit\Framework\TestCase;

class ClericTest extends TestCase
{
  public function testCreateCleric()
  {
    $cleric = new Cleric('Elrond', 8, 90, 30);

    $this->assertEquals('Elrond', $cleric->name);
    $this->assertEquals(8, $cleric->level);
    $this->assertEquals(90, $cleric->hp);
    $this->assertEquals(30, $cleric->healing_power);
  }

  // Test para probar la curación de un Cleric
  public function testClericHeal()
  {
    $cleric = new Cleric('Elrond', 8, 90, 30);
    $heal = $cleric->heal();

    $this->assertGreaterThan(0, $heal, 'La curación debe ser mayor a 0');
    $this->assertIsInt($heal, 'Se espera que la curación sea un número entero');
    $this->assertEquals(90, $heal, "Curar es tres veces el poder curativo");
  }

  // Test para probar que un Cleric puede atacar
  public function testClericAttack()
  {
    $cleric = new Cleric('Elrond', 8, 90, 30);
    $attack = $cleric->attack();

    $this->assertGreaterThan(0, $attack, 'El ataque del clérigo debe ser mayor a 0');
    $this->assertEquals(60, $attack, "El ataque es el poder curativo * 2 ");
  }

  public function testClericDefends()
  {
    $cleric = new Cleric('Elrond', 8, 90, 30);
    $initial_damage = 50;
    $final_damage = $cleric->defend($initial_damage);

    $this->assertLessThan($initial_damage, $final_damage, 'El daño final debe ser menor tras defender');
    $this->assertEquals(35, $final_damage, "Al daño inicial se le resta la mitad del poder curativo");

    $this->assertEquals(0, $cleric->defend(10), "Al daño final no puede ser menos de 0");
  }

  public function testLevelUp()
  {
    $cleric = new Cleric('Elrond', 8, 90, 30);
    $this->assertEquals(8, $cleric->level, 'El nivel no es el creado');
    $cleric->levelUp();
    $this->assertEquals(9, $cleric->level, 'El nivel no ha aumentado');
  }
}
