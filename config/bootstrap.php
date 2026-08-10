<?php
// check de tateus van de spel/sessie als die niet gestart dan start je hem
if(session_status() === PHP_SESSION_NONE)
{
    session_start();
}
// hier roeppen we de benodigde onderdelen die het spel aan het praten zet 
require_once  __DIR__ . "/../src/Dice.php";
require_once  __DIR__ . "/../src/Scoreboard.php";
require_once  __DIR__ . "/../src/Game.php";
require_once  __DIR__ . "/../src/Action.php"; // Nieuwe bestand toegevoegd.

// Maak de index.php schoon de controllers in de te roepen bestand.
verwerkActie();

initSpel();
$categorieen = [
    'ones'           => 'Enen', 
    'twos'           => 'Tweeën', 
    'threes'         => 'Drieën',
    'fours'          => 'Vieren',
    'fives'          => 'Vijven',
    'sixes'          => 'Zessen',
    'three_kind'     => 'Three of a Kind',
    'four_kind'      => 'Four of a Kind',
    'full_house'     => 'Full House',
    'small_straight' => 'Kleine Straat',
    'large_straight' => 'Grote Straat',
    'yahtzee'        => 'Yahtzee',
    'chance'         => 'Chance'
];

