<!-- Container voor de waarschuwingsmelding / pop-up -->
<div class="alert-box">
    <!-- Controleert of er daadwerkelijk een melding in de sessie staat -->
    <?php if(!empty($_SESSION["game"]["melding"])): ?>
        <!-- Donkere achtergrond-overlay die het scherm bedekt -->
        <div class="popup-overlay" id="overlay">
            <!-- Het witte waarschuwingsblok met het bericht -->
            <div class="popup-box">
                <h3>Let op!</h3>
                <p><?=$_SESSION["game"]["melding"]; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <!-- Wist de melding direct uit de sessie (Flash Message) zodat hij niet blijft herhalen -->
    <?php $_SESSION["game"]["melding"] = ""; ?>

    <script>
        // Functie die de pop-up verbergt door de CSS-display op 'none' te zetten
        function verbergPopup(){
            const popup = document.getElementById("overlay");
            if(popup){
                popup.style.display = 'none';
            }
        }

        // Luistert éénmalig ({once:true}) naar een muisklik óf toetsaanslag om de pop-up te sluiten
        window.addEventListener("click", verbergPopup, {once:true});
        window.addEventListener("keydown", verbergPopup, {once:true});
    </script>
</div>