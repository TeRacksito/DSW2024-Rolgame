<?php

use TeRacksito\Rolgame\Warrior;
use PHPUnit\Framework\TestCase;

class WarriorTest extends TestCase
{
  public function testCreateWarrior()
  {
    $warrior = new Warrior('Thorin', 10, 100, 50);

    $this->assertEquals('Thorin', $warrior->name);
    $this->assertEquals(10, $warrior->level);
    $this->assertEquals(100, $warrior->hp);
    $this->assertEquals(50, $warrior->strength);
  }

  // Test para probar el ataque de un Guerrero
  public function testWarriorAttacks()
  {
    $warrior = new Warrior('Thorin', 10, 100, 50);
    $attack = $warrior->attack();

    $this->assertGreaterThan(0, $attack, 'Se espera que el ataque sea mayor a 0'); 
    $this->assertIsInt($attack, 'Se espera que el ataque sea un número entero'); 
    $this->assertEquals(500, $attack, "El ataque es el nivel por la fuerza");
  }

  // Test para probar la defensa de un Guerrero
  public function testWarriorDefends()
  {
    $warrior = new Warrior('Thorin', 10, 100, 50);
    $initial_damage = 50;
    $final_damage = $warrior->defend($initial_damage);

    $this->assertLessThan($initial_damage, $final_damage, 'El daño final debe ser menor tras defender');
    $this->assertEquals(25, $final_damage, "Al daño inicial se le resta la mitad de la fuerza");
    
    $this->assertEquals(0, $warrior->defend(10), "Al daño final no puede ser menos de 0");
  }
}
