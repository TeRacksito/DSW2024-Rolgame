<?php

use TeRacksito\Rolgame\Character;
use PHPUnit\Framework\TestCase; 

class CharacterTest extends TestCase
{
  public function testAbstractCharacter()
  {
    // Utilizamos ReflectionClass para obtener información de la clase
    $reflection = new ReflectionClass(Character::class);

    // Verificamos si la clase es abstracta
    $this->assertTrue($reflection->isAbstract(), 'La clase Character debe ser abstracta.');
  }

  public function testPersonajeHasProperties()
  {
      // Obtener la clase usando ReflectionClass
      $reflection = new ReflectionClass(Character::class);
      
      // Obtener las propiedades de la clase
      $properties = $reflection->getProperties();

      // Comprobamos que las propiedades concretas existen
      $property_names = array_map(function($property) {
          return $property->getName();
      }, $properties);

      $this->assertContains('nombre', $property_names, 'La clase Character debe tener la propiedad "nombre".');
      $this->assertContains('nivel', $property_names, 'La clase Character debe tener la propiedad "nivel".');
      $this->assertContains('puntosDeVida', $property_names, 'La clase Character debe tener la propiedad "puntosDeVida".');
  }

  public function testPersonajeHasMethods()
  {
      // Obtener la clase usando ReflectionClass
      $reflection = new ReflectionClass(Character::class);

      // Obtener los métodos de la clase
      $methods = $reflection->getMethods();

      // Separar los métodos concretos y abstractos
      $abstract_methods = [];
      $concrete_methods = [];

      foreach ($methods as $method) {
          if ($method->isAbstract()) {
              $abstract_methods[] = $method->getName();
          } else {
              $concrete_methods[] = $method->getName();
          }
      }

      // Verificar que existe un método abstracto llamado "atacar"
      $this->assertContains('atacar', $abstract_methods, 'La clase Character debe tener un método abstracto llamado "atacar".');
      $this->assertContains('defender', $abstract_methods, 'La clase Character debe tener un método abstracto llamado "defender".');

      // Verificar que existe un método concreto llamado "subirNivel"
      $this->assertContains('subirNivel', $concrete_methods, 'La clase Character debe tener un método concreto llamado "subirNivel".');
  }
}