<?php
// Verwerkt alle acties uit het spel (POST) en herlaadt de pagina
function verwerkActie()
{
    // De 'poortwachter' die controleert of er een knop is ingedrukt (en de pagina niet zomaar los geopend is).
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {    
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
        if (isset($_POST['kies_categorie'])) {
            // 1. Haal de categorie op uit het verborgen veld
            $categorie = $_POST['categorie']; 
            $activeSpeler = $_SESSION['game']['actieveSpeler'];
            $dobbelstenen = $_SESSION['game']['dobbelstenen'];
            
            // 2. Bereken en sla de score op
            $score = berekenScore($categorie, $dobbelstenen);
            $_SESSION['game']['scores'][$activeSpeler][$categorie] = $score;

            // 3. Reset beurt en dobbelstenen
            $_SESSION['game']['beurt'] = 0;
            $_SESSION['game']['vasthouden'] = [false, false, false, false, false];
            
            // 4. Ga naar de volgende speler
            $activeSpeler++;
            
            // 5. Controleer of iedereen in deze ronde is geweest
            $totalSpeler = count($_SESSION['game']['spelers']);
            if ($activeSpeler >= $totalSpeler) {
                $_SESSION['game']['ronde']++;
                $activeSpeler = 0;
            }

            // 6. Sla de bijgewerkte actieve speler op in de sessie!
            $_SESSION['game']['actieveSpeler'] = $activeSpeler;
            $_SESSION['game']['melding'] = "";
        }
        if(isset($_POST['multi-player'])){
            $_SESSION['game']['instel_stap'] = 'aantal_kiezen';
        }
        if(isset($_POST['update_speler'])){
            $aantalSpelers = (int)($_POST['aantalSpelers'] ??2);
            $tijdelijkNaam = [];
            for($i = 1; $i <= $aantalSpelers; $i++){
                $tijdelijkNaam[]= 'speler'.$i;
            }
            $_SESSION['game'] = newGame($tijdelijkNaam);
            $_SESSION['game']['instel_stap'] = 'namen_geven';
        }


        if(isset($_POST['start-met-namen']))
        {
            
            $nieuweSpelers = $_POST['speler-naam'] ?? ['Speler 1', 'Speler 2'];
            
            $_SESSION['game'] = newGame($nieuweSpelers);
            $_SESSION['game']['instel_stap'] = 'spel_bezig';

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