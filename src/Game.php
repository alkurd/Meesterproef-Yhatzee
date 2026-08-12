<?php
//Wist alle oude gegevens en start een nieuw Yahtzee-spel vanaf de allereerste stand
function resetSpel(){
    $actieveSpelers = $_SESSION['game']['speler'] ?? ['speler 1'];
    unset($_SESSION['game']); // unset zorgt ervoor om dew sessie helmaal leeg gooit
    $_SESSION['game'] = newGame(['speler 1']);
}

// Zorgt ervoor dat er altijd een spel klaar staat
function initSpel($speler =['speler 1']){
    if(!isset($_SESSION["game"]))
    {
        $_SESSION['game'] = newGame($speler);
    }
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
    $_SESSION["game"]["melding"] = ""; // melding leeg maken
}

// $index geeft aan welke dobbelsteen je aanklikt (0 t/m 4).
function wisselVasthouden($index)
{
    if($_SESSION["game"]["beurt"] === 0){
        $_SESSION["game"]["melding"] = "Je moet eerst dobbelstenen gooien";
        return;
    }
    $_SESSION["game"]["melding"] = ""; // De melding leeg maken
    // isset() checkt voor de zekerheid of die dobbelsteen wel echt bestaat.
    if(isset($_SESSION['game']["vasthouden"][$index]))
    {
        // Het uitroepteken (!) keert de waarde om: van true naar false (of andersom)
        $_SESSION['game']["vasthouden"][$index] = !$_SESSION['game']["vasthouden"][$index];
    }
    
}
