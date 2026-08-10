<?php
//Wist alle oude gegevens en start een nieuw Yahtzee-spel vanaf de allereerste stand
function resetSpel(){
    $_SESSION = [];
    $_SESSION["game"] = [
    'ronde' => 1,
    'beurt' => 0,
    'dobbelstenen' => [1, 1, 1, 1, 1],
    'vasthouden' => [false, false, false, false, false],
    'scores' => [
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
    ]
];
}
// Zorgt ervoor dat er altijd een spel klaar staat
function initSpel(){
    if(!isset($_SESSION["game"])){return resetSpel();}
}

// Voert een worp uit als de speler nog worpen over heeft (max. 3), anders geeft hij een waarschuwing.
// Waarom ['game']?: Bundelt alle spelgegevens netjes bij elkaar in de sessie, zodat het overzichtelijk blijft en niet in de war raakt met andere data.
function verWerkGooi(){
    if($_SESSION["game"]["beurt"] < 3)
    {
        $_SESSION["game"]["dobbelstenen"] = gooi_A_D_S(
            $_SESSION["game"]["dobbelstenen"] ?? [],
            $_SESSION["game"]["vasthouden"] ?? []);
        $_SESSION["game"]["beurt"]++;
    }else{
        return "je mag niet meer dan 3 keer gooien! Kies een categorie op je scorekaart.";
    }
}

// $index geeft aan welke dobbelsteen je aanklikt (0 t/m 4).
function wisselVasthouden($index)
{
    // isset() checkt voor de zekerheid of die dobbelsteen wel echt bestaat.
    if(isset($_SESSION['game']["vasthouden"][$index]))
    {
        // Het uitroepteken (!) keert de waarde om: van true naar false (of andersom)
        $_SESSION['game']["vasthouden"][$index] = !$_SESSION['game']["vasthouden"][$index];
    }
    
}
