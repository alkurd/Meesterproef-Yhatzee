<tfoot>
    <!-- 1. Subtotaal voor de bovenste helft (Enen t/m Zessen) -->
    <tr class="totaal-rij" style="background-color: #f1f5f9;">
        <td><strong>Subtotaal (1 t/m 6)</strong></td>
        <!-- Loopt door alle spelers en toont voor iedereen zijn eigen subtotaal -->
        <?php foreach ($_SESSION['game']['spelers'] as $spelerIndex => $spelerNaam): ?>
            <td><strong><?= berekenBoven($spelerIndex) ?></strong></td>
        <?php endforeach; ?>
        <td>-</td>
    </tr>

    <!-- 2. Bonusberekening (35 extra punten bij 63pt of meer in het subtotaal) -->
    <tr class="totaal-rij">
        <td><strong>Bonus (>= 63 = 35pt)</strong></td>
        <!-- Toont voor elke speler of de bonus is behaald -->
        <?php foreach ($_SESSION['game']['spelers'] as $spelerIndex => $spelerNaam): ?>
            <td><?= berekenBonus($spelerIndex) ?></td>
        <?php endforeach; ?>
        <td>-</td>
    </tr>

    <!-- 3. Eindtotaal van de complete scorekaart -->
    <tr class="eindtotaal-rij">
        <td><strong>EINDTOTAAL</strong></td>
        <?php foreach ($_SESSION['game']['spelers'] as $spelerIndex => $spelerNaam): ?>
            <td>
                <!-- Toont de eindscore pas wanneer de spelstatus op 'eind' staat -->
                <?php if ($_SESSION['game']['instel_stap'] === 'eind'): ?>
                    <strong><?= berekenEindscore($spelerIndex) ?></strong>
                <?php endif; ?>
            </td>
        <?php endforeach; ?>
        <td>-</td>
    </tr>
</tfoot>