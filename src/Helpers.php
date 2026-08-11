<?php

// Start een nieuw spel (standaard 1 speler als er niks wordt meegegeven)
function newGame($speler = ['speler 1'])
{
    // Blanco scorekaart-sjabloon
    $legeCat = [
        'ones' => null,
        'twos' => null,
        'threes' => null,
        'fours' => null,
        'fives' => null,
        'sixes' => null,
        'three_kind' => null,
        'four_kind' => null,
        'full_house' => null,
        'small_straight' => null,
        'large_straight' => null,
        'chance' => null,
        'yahtzee' => null
    ];

    // Kent aan de index (stoelnummer) van elke speler een eigen lege scorekaart toe
    $scores = [];
    foreach($speler as $index => $naam){
        $scores[$index] = $legeCat;
    }

    return [
        'melding'       => "",
        'ronde'         => 1,
        'beurt'         => 0,
        'dobbelstenen'  => [1, 1, 1, 1, 1],
        'vasthouden'    => [false, false, false, false, false],
        'actieveSpeler' => 0, // Index van de speler die aan de beurt is
        'speler'        => $speler,
        'scores'         => $scores
    ];
}