<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Hotel Nord - Přihlášení</title>

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
                <h1>Přihlášení</h1>
                <div class="auth-forms">
                    <div class="form-block">
                        <h2>Mám účet (Přihlášení)</h2>
                        <form action="zpracuj_prihlaseni.php" method="POST">
                            <input type="text" name="jmeno" placeholder="Vaše jméno" required>
                            <input type="password" name="heslo" placeholder="Heslo" required>
                            <button type="submit" name="login" class="btn-outline" style="width: max-content; margin-top: 10px;">Přihlásit se</button>
                        </form>
                    </div>
                    <hr>
                    <div class="form-block">
                        <h2>Nemám účet (Registrace)</h2>
                        <form action="zpracuj_registraci.php" method="POST">
                            <input type="text" name="jmeno" placeholder="Zvolte si jméno" required>
                            <input type="password" name="heslo" placeholder="Zvolte si heslo" required>
                            <button type="submit" name="register" class="btn-outline" style="width: max-content; margin-top: 10px;">Zaregistrovat</button>
                        </form>
                    </div>
                </div>
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