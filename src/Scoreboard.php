<?php

// helper functie
function sort_string($cijfers){
    sort($cijfers); // Cijvers sorteren 
    return implode('',$cijfers); // Cijvers omzetten naar een string.
}

// Berekent hoeveel punten jouw 5 dobbelstenen waard zijn voor de categorie die je kiest
function berekenScore($categorie, $dobbelStenen)
{
    // Telt hoe vaak elk gegooid getal voorkomt
    $aantallen = array_count_values($dobbelStenen);
    // Telt de waardes van alle 5 de dobbelstenen bij elkaar op
    $som = array_sum($dobbelStenen);
    switch($categorie){
        case 'ones':   return ($aantallen[1] ?? 0) * 1;
        case 'twos':   return ($aantallen[2] ?? 0) * 2;
        case 'threes': return ($aantallen[3] ?? 0) * 3;
        case 'fours':  return ($aantallen[4] ?? 0) * 4;
        case 'fives':  return ($aantallen[5] ?? 0) * 5;
        case 'sixes':  return ($aantallen[6] ?? 0) * 6;

        case 'three_kind':
            return Max($aantallen) >= 3 ? $som :0;
        case 'four_kind':
            return Max($aantallen) >= 4 ? $som :0;

        case 'full_house':
            $heeftDrie = in_array(3,$aantallen);
            $heeftTwee = in_array(2,$aantallen);
            $heeftVijf = in_array(5,$aantallen);
            return (($heeftDrie && $heeftTwee) || $heeftVijf) ? 25 : 0;
            
        case 'small_straight':
            $str = sort_string(array_unique($dobbelStenen));// Haalt dubbele getallen weg
            
            if(str_contains($str,'1234')||
            str_contains($str,'2345') ||
            str_contains($str,'3456')) // Controleert of een specifiek stukje tekst (zoals '1234') in de reeks voorkomt
            {
                return 30;
            }return 0;

        case 'large_straight':
            $str = sort_string($dobbelStenen);
            if($str === '12345'|| $str === '23456')
            {
                return 40;
            }return 0;
        case 'yahtzee':
            return max($aantallen) === 5 ?50 :0;

        case 'chance':
            return $som;
        default: return 0;
    }
}

/**
 * Controleert of de speler alle 6 categorieën van het bovenste deel heeft ingevuld.
 */
function isBovenKlaar(int $spelerIndex): bool 
{
    $scores = $_SESSION['game']['scores'][$spelerIndex] ?? [];
    $bovenCat = ['ones', 'twos', 'threes', 'fours', 'fives', 'sixes'];

    foreach ($bovenCat as $key) {
        // Als een van de categorieën nog ontbreekt of null is, is de bovenkant nog niet klaar
        if (!array_key_exists($key, $scores) || $scores[$key] === null) {
            return false;
        }
    }

    return true;
}

/**
 * Berekent de som van het bovenste deel (1 t/m 6).
 * Geef '-' terug als het bovenste deel nog niet volledig is ingevuld.
 */
function berekenBoven(int $spelerIndex) 
{
    if (!isBovenKlaar($spelerIndex)) {
        return '-';
    }

    $scores = $_SESSION['game']['scores'][$spelerIndex] ?? [];
    $bovenCat = ['ones', 'twos', 'threes', 'fours', 'fives', 'sixes'];
    $subtotal = 0;

    foreach ($bovenCat as $key) {
        if (isset($scores[$key]) && $scores[$key] !== null) {
            $subtotal += $scores[$key];
        }
    }

    return $subtotal;
}

/**
 * Berekent de bonus van 35 punten als het subtotaal van de bovenkant >= 63 is.
 */
function berekenBonus(int $spelerIndex) 
{
    $subtotaal = berekenBoven($spelerIndex);

    if ($subtotaal === '-') {
        return '-';
    }

    // AANGEPAST: Yahtzee bonus is 35 punten bij 63 punten of meer (niet 65!)
    return ($subtotaal >= 63) ? 35 : 0;
}

/**
 * Berekent de totale eindscore (Bovenste deel + Bonus + Onderste deel).
 */
function berekenEindScore(int $spelerIndex): int 
{
    $scores = $_SESSION['game']['scores'][$spelerIndex] ?? [];

    // 1. Bovenste deel ophalen (als het nog '-' is, telt het als 0 punten)
    $bovenVal = berekenBoven($spelerIndex);
    $bovenScore = ($bovenVal === '-') ? 0 : (int)$bovenVal;

    // 2. Bonus ophalen (als het nog '-' is, telt het als 0 punten)
    $bonusVal = berekenBonus($spelerIndex);
    $bonusScore = ($bonusVal === '-') ? 0 : (int)$bonusVal;

    // 3. Onderste deel optellen
    $ondersteCat = [
        'three_kind', 'four_kind', 'full_house', 
        'small_straight', 'large_straight', 'chance', 'yahtzee'
    ];

    $totalOnder = 0;
    foreach ($ondersteCat as $key) {
        if (isset($scores[$key]) && $scores[$key] !== null) {
            $totalOnder += $scores[$key];
        }
    }

    // 4. Eindtotaal berekenen
    return $bovenScore + $bonusScore + $totalOnder;
}

function bepaalWinnaar(){
    // Als de spel nog niet klaar doe niks
    if(($_SESSION['game']['instel_stap'] ?? '') !== 'eind'){
        return false;
    }

    // Een lege lijst om alle einde score in te stopen 
    $alleScore = [];
    // hier stop je de score in de lijst
    foreach($_SESSION['game']['spelers'] as $index => $naam){
        $alleScore[$naam] = berekenEindScore($index);
    }
    
    // Geef de hoogste score
    $winnaarScore = max($alleScore);
    // Zoek de naam die bij de hoogste score hoort
    $winnaarNaam = array_search($winnaarScore,$alleScore);
    

    return
    [
        'winnaarNaam'  => $winnaarNaam,
        'winnaarScore' => $winnaarScore,
        'alleScore'    => $alleScore
    ];
}