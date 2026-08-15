<?php
$eindScore = bepaalWinnaar();
if(!$eindScore) return;
$isGelijkSpel = array_keys($eindScore['alleScore'],$eindScore['winnaarScore']);
$aantalspelers = count($_SESSION['game']['spelers']);
?>

<div class="alert-box felicitatie-box">
    <div class="popup-overlay" id="felicitatie-overlay">
        <div class="popup-box felicitatie-card">
            <div class="trophy-icon">🏆</div>
            <h2>Gefeliciteerd!</h2>
            <!-- Solo speler -->
            <?php if($aantalspelers === 1):?>
                <p class="winnar-tekst">
                    <strong><?= $eindScore['winnaarNaam']?> heeft gewonnen</strong>
                    <span> heeft het spel beëindigd met <?= $eindScore['winnaarScore'] ?> punten</span>
                </p>
            <!-- Gelijk spel -->
            <?php elseif(count($isGelijkSpel) > 1):?>
                <p class="winnar-tekst">
                    <strong>Het is gelijk spel tussen <?= implode('',$namenLijst)?>!</strong>
                    Met score van<span><?= $eindScore['winnaarScore']?></span> punten
                </p>
            <?php else: ?>
            <p class="winnar-tekst">
                <strong><?= $eindScore['winnaarNaam']?> heeft gewonnen</strong>
                <span> Met <?= $eindScore['winnaarScore'] ?> punten</span>
            </p>
            <?php endif?>
            <div class="score-overzicht">
                <h4>Eindstand:</h4>
                <ul>
                    <?php foreach ($eindScore['alleScore'] as $naam => $score): ?>
                        <li>
                            <span><?= htmlspecialchars($naam) ?></span>
                            <strong><?= $score ?> pt</strong>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <form action="index.php" method="POST" style="margin-top: 20px;">
                <button type="submit" name="reset" class="btn-nieuw-spel">
                    🎮 Nieuw Spel Starten
                </button>
            </form>

        </div>
    </div>
</div>