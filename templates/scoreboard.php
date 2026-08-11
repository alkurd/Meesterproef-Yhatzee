<!-- Container voor de scorekaart -->
<div class="score-kaart">
    <table class="score-table">
        <!-- Tabelkop met de kolomnamen -->
        <thead>
            <tr>
                <th>Categorie</th>
                <th>Score</th>
                <th>Actie</th>
            </tr>
        </thead>
        
        <tbody>
            <!-- Loopt door alle categorieën: $sleutel is de PHP-code (bijv. 'ones') en $naam is de nette tekst (bijv. 'Enen') -->
            <?php foreach($categorieen as $sleutel => $naam): 
                $activeSpelers = $_SESSION['game']['activesplere'] ?? 0?>
            <tr>
                <!-- Toont de nette categorienaam -->
                <td><?=$naam?></td>

                <!-- Toont de behaalde score uit de sessie, of een '-' als deze nog leeg is -->
                <td> <?= $_SESSION['game']['scores'][$sleutel] ?? '-' ?> </td>

                <td>
                    <!-- Toont de knop ALLEEN als deze categorie nog niet is ingevuld (waarde is null) -->
                    <?php if(($_SESSION['game']['scores'][$activeSpelers][$sleutel]?? null) === null):?>
                        <form action="index.php" method="POST" >
                            <!-- Stuurt de sleutel van de gekozen categorie mee naar de server -->
                            <button name="kies_categorie" type="submit" value="<?=$sleutel?>">Kies</button>
                        </form>
                    <?php endif?>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
</div>