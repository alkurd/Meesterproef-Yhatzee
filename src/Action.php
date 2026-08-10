<?php
// Verwerkt alle acties uit het spel (POST) en herlaadt de pagina
function verwerkActie()
{
    // De 'poortwachter' die controleert of er een knop is ingedrukt (en de pagina niet zomaar los geopend is).
    if($_SERVER['REQUEST_METHOD'] === "POST")
    {
        // Regelt het opnieuw rollen van de dobbelstenen. 
        if(isset($_POST['gooi'])){
            verWerkGooi();
        }

        // Beheert welke dobbelstenen bewaard moeten blijven bij een volgende worp.
        if(isset($_POST['wissel_vast'])){
            $index = (int)$_POST['wissel_vast'];
            wisselVasthouden($index);
        }

        // Verwerkt het invullen van een score en bereidt het spel voor op de volgende ronde. 
        if(isset($_POST['kies_categorie'])){
            $categorie = $_POST['kies_categorie'];
            $score = berekenScore($categorie, $_SESSION['game']['dobbelstenen']);
            $_SESSION['game']['scores'][$categorie] = $score;

            $_SESSION['game']['beurt'] = 0;
            $_SESSION['game']['ronde']++;
            $_SESSION['game']['vasthouden'] = [false, false, false, false, false];

        }
        // Wist de sessie en start een gloednieuw spel.
        if(isset($_POST['reset'])){
            resetSpel();
        }
        // Zorgt dat F5/verversen op de pagina geen foutmeldingen of dubbele acties geeft.
        header("Location: index.php");
        exit;
    }
    
}