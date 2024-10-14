<?php

use TeRacksito\Rolgame\Cleric;
use TeRacksito\Rolgame\Warrior;
use TeRacksito\Rolgame\Magician;
use TeRacksito\Rolgame\Game;
use TeRacksito\Rolgame\Character;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
  public function testAddCharacter()
  {
    $game = new Game();
    $warrior = new Warrior('Conan', 1, 100, 20);

    $game->addCharacter($warrior);
    $this->assertCount(1, $game->obtenerCharacters(), "El número de personajes debe ser 1");
    $this->assertContains($warrior, $game->obtenerCharacters(), "El guerrero creado está en la partida");
  }

  public function testAddSeveralCharacters()
  {
    $game = new Game();

    $warrior = new Warrior('Conan', 1, 100, 20);
    $game->addCharacter($warrior);
    $this->assertCount(1, $game->obtenerCharacters(), "El número de personajes debe ser 1");
    $this->assertContains($warrior, $game->obtenerCharacters(), "El guerrero creado está en la partida");

    $magician = new Magician('Gandalf', 1, 80, 100);
    $game->addCharacter($magician);
    $this->assertCount(2, $game->obtenerCharacters(), "El número de personajes debe ser 2");
    $this->assertContains($magician, $game->obtenerCharacters(), "El mago creado está en la partida");
  }

  public function testRemoveCharacter()
  {
    $game = new Game();

    $warrior = new Warrior('Conan', 1, 100, 20);
    $magician = new Magician('Gandalf', 1, 80, 100);
    $cleric = new Cleric('Elrond', 8, 90, 30);
    $game->addCharacter($warrior);
    $game->addCharacter($magician);
    $game->addCharacter($cleric);
    $this->assertCount(3, $game->obtenerCharacters(), "El número de personajes debe ser 3");
    $this->assertContains($warrior, $game->obtenerCharacters(), "El guerrero creado está en la partida");
    $this->assertContains($magician, $game->obtenerCharacters(), "El mago creado está en la partida");
    $this->assertContains($cleric, $game->obtenerCharacters(), "El clerigo creado está en la partida");

    $game->removeCharacter($magician);
    $this->assertCount(2, $game->obtenerCharacters(), "El número de personajes debe ser 2");
    $this->assertContains($warrior, $game->obtenerCharacters(), "El guerrero está en la partida");
    $this->assertNotContains($magician, $game->obtenerCharacters(), "El mago eliminado ya no está en la partida");
    $this->assertContains($cleric, $game->obtenerCharacters(), "El clerigo está en la partida");

    $game->removeCharacter($cleric);
    $this->assertCount(1, $game->obtenerCharacters(), "El número de personajes debe ser 1");
    $this->assertContains($warrior, $game->obtenerCharacters(), "El guerrero está en la partida");
    $this->assertNotContains($magician, $game->obtenerCharacters(), "El mago eliminado ya no está en la partida");
    $this->assertNotContains($cleric, $game->obtenerCharacters(), "El clerigo eliminado ya no está en la partida");

    $game->removeCharacter($warrior);
    $this->assertCount(0, $game->obtenerCharacters(), "El número de personajes debe ser 0");
    $this->assertNotContains($warrior, $game->obtenerCharacters(), "El guerrero eliminado ya no está en la partida");
    $this->assertNotContains($magician, $game->obtenerCharacters(), "El mago eliminado ya no está en la partida");
    $this->assertNotContains($cleric, $game->obtenerCharacters(), "El clerigo eliminado ya no está en la partida");
  }

  public function testObtenerCharactersPorClase()
  {
    $game = new Game();

    $warrior1 = new Warrior('Conan', 1, 100, 20);
    $magician1 = new Magician('Gandalf', 1, 80, 100);
    $cleric1 = new Cleric('Elrond', 8, 90, 30);
    $warrior2 = new Warrior('Aquiles', 3, 30, 30);
    $magician2 = new Magician('Merlin', 2, 60, 80);
    $warrior3 = new Warrior('Goku', 2, 80, 30);

    $game->addCharacter($warrior1);
    $game->addCharacter($magician1);
    $game->addCharacter($cleric1);
    $game->addCharacter($warrior2);
    $game->addCharacter($magician2);
    $game->addCharacter($warrior3);

    $this->assertCount(3, $game->obtenerCharactersPorClase(Warrior::class));
    $this->assertContains($warrior1, $game->obtenerCharactersPorClase(Warrior::class), "El guerrero1 está en la partida");
    $this->assertNotContains($magician1, $game->obtenerCharactersPorClase(Warrior::class), "El mago1 no está en la partida");
    $this->assertNotContains($cleric1, $game->obtenerCharactersPorClase(Warrior::class), "El clerigo1 no está en la partida");
    $this->assertContains($warrior2, $game->obtenerCharactersPorClase(Warrior::class), "El guerrero2 está en la partida");
    $this->assertNotContains($magician2, $game->obtenerCharactersPorClase(Warrior::class), "El mago2 no está en la partida");
    $this->assertContains($warrior3, $game->obtenerCharactersPorClase(Warrior::class), "El guerrero3 está en la partida");

    $this->assertCount(2, $game->obtenerCharactersPorClase(Magician::class));
    $this->assertCount(1, $game->obtenerCharactersPorClase(Cleric::class));
    $this->assertCount(6, $game->obtenerCharactersPorClase(Character::class));
    $this->assertCount(0, $game->obtenerCharactersPorClase(Game::class));
  }

  public function testLucha()
  {
    $warrior1 = new Warrior('Conan', 1, 100, 20);
    $warrior2 = new Warrior('Aquiles', 3, 30, 30);
    Character::lucha($warrior1, $warrior2);
    $this->assertSame(20, $warrior1->puntosDeVida);
    $this->assertSame(25, $warrior2->puntosDeVida);

    $magician1 = new Magician('Gandalf', 1, 80, 100);
    $cleric1 = new Cleric('Elrond', 8, 90, 30);
    Character::lucha($magician1, $cleric1);
    $this->assertSame(40, $magician1->puntosDeVida);
    $this->assertSame(55, $cleric1->puntosDeVida);
  }

  public function testEliminarMuertos() {
    $game = new Game();
    $warrior1 = new Warrior('Conan', 1, 100, 20);
    $warrior2 = new Warrior('Aquiles', 3, 30, 30);
    $game->addCharacter($warrior1);
    $game->addCharacter($warrior2);
    
    Character::lucha($warrior1, $warrior2);
    $this->assertSame(20, $warrior1->puntosDeVida);
    $this->assertSame(25, $warrior2->puntosDeVida);
    $game->eliminarMuertos();
    $this->assertCount(2, $game->obtenerCharacters(), "El número de personajes debe ser 2");

    Character::lucha($warrior2, $warrior1);
    $this->assertSame(-60, $warrior1->puntosDeVida);
    $this->assertSame(20, $warrior2->puntosDeVida);
    $game->eliminarMuertos();
    $this->assertCount(1, $game->obtenerCharacters(), "El número de personajes debe ser 1");
    $this->assertNotContains($warrior1, $game->obtenerCharacters(), "El guerrero1 no eestá en la partida");
    $this->assertContains($warrior2, $game->obtenerCharacters(), "El guerrero2 está en la partida");
  }
}
