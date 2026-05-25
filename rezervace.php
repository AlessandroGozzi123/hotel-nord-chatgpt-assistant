<?php
session_start();

if (isset($_SESSION['uzivatel_id'])) {
    require 'db.php';
    
    $stmt = mysqli_prepare($DB, "SELECT * FROM rezervace WHERE uzivatel_id = ? ORDER BY datum_prijezdu ASC");
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['uzivatel_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $moje_rezervace = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <h1>Rezervace</h1>
                
                <?php if (!isset($_SESSION['uzivatel_id'])): ?>
                    <p style="color: red; font-weight: bold; font-size: 20px;">Musíte se nejdříve přihlásit!</p>
                <?php else: ?>
                    <form action="zpracuj_rezervaci.php" method="POST" class="rezervace-form">
                        <label for="typ_pokoje">Typ pokoje:</label>
                        <select name="typ_pokoje" id="typ_pokoje" required>
                            <option value="Standard Double">Standard Double</option>
                            <option value="Superior Room">Superior Room</option>
                            <option value="Family Suite">Family Suite</option>
                            <option value="Nordic Executive">Nordic Executive</option>
                        </select>
                        
                        <label for="datum_prijezdu">Datum příjezdu:</label>
                        <input type="date" name="datum_prijezdu" id="datum_prijezdu" required>
                        
                        <label for="datum_odjezdu">Datum odjezdu:</label>
                        <input type="date" name="datum_odjezdu" id="datum_odjezdu" required>
                        
                        <label for="pocet_osob">Počet osob:</label>
                        <input type="number" name="pocet_osob" id="pocet_osob" min="1" max="10" required>
                        
                        <h3 style="margin-top: 15px;">Příplatkové služby:</h3>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <label><input type="checkbox" name="vecere" value="1"> Večeře (Polopenze)</label>
                            <label><input type="checkbox" name="parkovani" value="1"> Hlídané parkování</label>
                            <label><input type="checkbox" name="mazlicek" value="1"> Domácí mazlíček</label>
                            <label><input type="checkbox" name="wellness" value="1"> Wellness</label>
                        </div>
                        
                        <button type="submit" class="btn-outline" style="width: max-content; margin-top: 20px;">Odeslat rezervaci</button>
                    </form>

                    <hr style="margin: 40px 0; border: 1px solid #ccc;">
                    
                    <h2>Moje stávající rezervace</h2>
                    <table class="rezervace-tabulka">
                        <tr>
                            <th>Pokoj</th>
                            <th>Příjezd</th>
                            <th>Odjezd</th>
                            <th>Osob</th>
                        </tr>
                        
                        <?php if (empty($moje_rezervace)): ?>
                            <tr><td colspan="4" style="text-align: center;">Zatím nemáte žádné rezervace.</td></tr>
                        <?php else: ?>
                            <?php foreach ($moje_rezervace as $rez): ?>
                                <tr>
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