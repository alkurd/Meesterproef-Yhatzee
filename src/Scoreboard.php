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
function berekenBovensteTotaal($spelerIndex){

}
function berekenBonus($spelerIndex){

}
function berekenEindScore($spelerIndex){
    
}