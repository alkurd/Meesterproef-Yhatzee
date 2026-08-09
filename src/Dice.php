<?php
// Een kleine functie die ervoor zorgt dat ik een simpel willekeurig nummer krijg tussen 1 en 6
function gooiD_Steen(){
    return rand(1,6);
}

// Deze functie verwerkt een worp voor 5 dobbelstenen met behoud van vastgehouden waarden.
function gooi_A_D_S($huidige_D_S = [], $vastGehouden = [])
{
    // Bepaalt de nieuwe stand van 5 dobbelstenen.
    $result = [];
    //Loopt door de 5 dobbelstenen (index 0 t/m 4)
    for($i = 0; $i < 5; $i++)
    {
        // Checkt simpelweg of deze dobbelsteen vast staat (is 'true' of 'false')
        $isVastGehouden = !empty($vastGehouden[$i]);
        // Behoudt de oude waarde als de steen is vastgehouden, anders wordt er opnieuw gegooid
        if($isVastGehouden ){
            $result[] = $huidige_D_S[$i];
        }
        else{
            $result[] = gooiD_Steen();
        }
    }
    return $result;
}
