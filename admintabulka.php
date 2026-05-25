<?php
session_start();

if (isset($_SESSION['uzivatel_id'])) {
    require 'db.php';
    
    $stmt = mysqli_prepare($DB, "SELECT * FROM `rezervace`,`uzivatel` WHERE rezervace.`uzivatel_id`=uzivatel.id");
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $vsechny_rezervace = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Hotel Nord - Rezervace</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&family=Montserrat:wght@500;600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/typography.css">
</head>
<body>
    <main class="main">
        <nav class="menu-wrapper">
            <div class="menu-container">
                <div class="logo">
                    <img src="img/logo/logo_transparent.png" alt="">
                </div>
                <ul class="odkazy">
                <li><a href="index.html">Úvod</a></li>
                <li><a href="o-nas.html">O nás</a></li>
                <li><a href="pokoje.html">Pokoje</a></li>
                <li><a href="kontakt.html">Kontakt</a></li>
            </ul>
            <div class="menu-right-buttons">
                <a href="rezervace.php" class="btn-outline">Rezervace</a>
                <a href="prihlaseni.php" class="btn-outline">Přihlášení</a>
            </div>
            </div>
            
        </nav>
        <div class="content-background">
            <div class="content">
                
                <?php if (!isset($_SESSION['uzivatel_id'])): ?>
                    <p style="color: red; font-weight: bold; font-size: 20px;">Musíte se nejdříve přihlásit!</p>
                <?php else: ?>
                    
                    <h2>Všechny rezervace</h2>
                    <table class="rezervace-tabulka">
                        <tr>
                            <th>Zákazník</th>
                            <th>Pokoj</th>
                            <th>Příjezd</th>
                            <th>Odjezd</th>
                            <th>Osob</th>
                        </tr>
                        
                        <?php if (empty($vsechny_rezervace)): ?>
                            <tr><td colspan="5" style="text-align: center;">V systému nejsou zatím žádné rezervace.</td></tr>
                        <?php else: ?>
                            <?php foreach ($vsechny_rezervace as $rez): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($rez['jmeno']); ?></td>
                                    <td><?php echo htmlspecialchars($rez['typ_pokoje']); ?></td>
                                    <td><?php echo date('d.m.Y', strtotime($rez['datum_prijezdu'])); ?></td>
                                    <td><?php echo date('d.m.Y', strtotime($rez['datum_odjezdu'])); ?></td>
                                    <td><?php echo htmlspecialchars($rez['pocet_osob']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>
            </div>
            
        </div>
        
    <div class="chatbot-window">
        <div class="chatbot-header">NordBot</div>
        <div class="chatbot-body" id="chat-history">
        </div>
        <div class="chatbot-input">
            <input type="text" id="user-input" placeholder="Napište zprávu...">
            <button id="send-btn">Odeslat</button>
        </div>
    </div>
    
    <div class="chatbot-ikona">
    <img src="img/icons/speech-bubble.png" alt="NordBot">
    </div>
    </main>

    <script src="script.js"></script>
</body>
</html>