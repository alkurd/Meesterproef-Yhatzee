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

    // Verwerkt de gekozen categorie en zet het spel klaar voor de volgende speler/ronde
    if (isset($_POST['kies_categorie'])) {

        // 1. Haal de gekozen categorie op uit het POST-formulier.
        // Met $_POST vangen we de tijdelijke actie van dit specifieke moment op.
        // Zodra we straks de pagina herladen met header("Location: ..."), wordt deze POST-data
        // automatisch gewist. Dit voorkomt dubbele tellingen als de speler de pagina ververst (F5).
        $categorie = $_POST['categorie'];
        $activeSpeler = $_SESSION['game']['actieveSpeler'];
        $dobbelstenen = $_SESSION['game']['dobbelstenen'];

        // 2. Bereken de score en sla deze permanent op in de $_SESSION onder de actieve speler.
        // De sessie blijft wél bewaard na het herladen van de pagina.
        $score = berekenScore($categorie, $dobbelstenen);
        $_SESSION['game']['scores'][$activeSpeler][$categorie] = $score;

        // 3. Reset de dobbelstenen en worpteller (0 worpen) voor de volgende beurt.
        $_SESSION['game']['vasthouden'] = [false, false, false, false, false];  
        $_SESSION['game']['beurt'] = 0;

        // 4. Verhoog de index om door te schakelen naar de volgende speler.
        $activeSpeler++;

        // 5. Controleer of iedereen in deze ronde is geweest.
        $totalSpelers = count($_SESSION['game']['spelers']);
        if ($activeSpeler >= $totalSpelers) {
            $_SESSION['game']['ronde']++; // Start de volgende ronde
            $activeSpeler = 0;             // Reset naar de eerste speler (index 0)

            // CHECK OP SPEL-EINDE: Er zijn 13 categorieën, dus max 13 rondes
            if ($_SESSION['game']['ronde'] > 13) {
                $_SESSION['game']['instel_stap'] = 'eind';
                $_SESSION['game']['melding'] = "Het spel is afgelopen!";
            }
        }

        // 6. Sla de nieuwe actieve speler op in de sessie.
        // Na de header("Location: index.php") weet het script nu precies dat Speler 2 aan de beurt is!
        $_SESSION['game']['actieveSpeler'] = $activeSpeler;
        $_SESSION['game']['melding'] = "";

    // ---------------------------------------------------------------------
    // Na verwerking van de 'if' wordt de pagina herladen:
    // header("Location: index.php");
    // exit;
    // -> Dit 'schudt' alle $_POST data leeg en laadt de schone status uit $_SESSION!
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