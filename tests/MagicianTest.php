<?php

use TeRacksito\Rolgame\Magician;
use PHPUnit\Framework\TestCase;

class MagicianTest extends TestCase
{
  public function testCreateMagician()
  {
    $magician = new Magician('Gandalf', 12, 80, 200);

    $this->assertEquals('Gandalf', $magician->name);
    $this->assertEquals(12, $magician->level);
    $this->assertEquals(80, $magician->hp);
    $this->assertEquals(200, $magician->mana, 'Al magician le falta la propiedad "mana" o no es 200');
  }

  // Test para probar el ataque de un Mago
  public function testMagicianAttacks()
  {
    $magician = new Magician('Gandalf', 12, 80, 200);
    $attack = $magician->attack();

    $this->assertGreaterThan(0, $attack, 'El attack del magician debe ser mayor a 0');
    $this->assertIsInt($attack, 'Se espera que el attack sea un número entero');
    $this->assertEquals(100, $attack, "El attack es la mitad del mana");
  }

  // Test para probar la defensa de un Mago
  public function testMagicianDefends()
  {
    $magician = new Magician('Gandalf', 12, 80, 200);
    $initial_damage = 60;
    $final_damage = $magician->defend($initial_damage);

    $this->assertLessThan($initial_damage, $final_damage); // El daño final debe ser menor tras defender
    $this->assertEquals(20, $final_damage, "Al daño inicial se le resta una quinta parte del mana");
    
    $this->assertEquals(0, $magician->defend(10), "Al daño final no puede ser menos de 0");

  }
}
