# Hotel Nord – Web s integrovaným ChatGPT asistentem

Tento projekt představuje webovou aplikaci fiktivního ubytovacího zařízení **Hotel Nord**. Hlavním prvkem projektu je integrace inteligentního digitálního asistenta (**NordBot**), který komunikuje v reálném čase pomocí asynchronního volání API rozhraní a poskytuje hostům informace na základě znalostní báze.

## Hlavní vlastnosti
* **Moderní design**
* **Integrovaný AI recepční (NordBot)** Využívá model **OpenAI GPT-4o** (zprostředkovaný přes OpenRouter) s načtenou lokální znalostní bází v textovém formátu
* **Rezervační systém**

## Živá ukázka (Live Demo)
👉 [http://perun.nti.tul.cz/~alessandro.gozzi/hotel/](http://perun.nti.tul.cz/~alessandro.gozzi/hotel/)

## Ukázky z rozhraní

### Úvodní stránka s otevřeným asistentem NordBot
<img width="1861" height="901" alt="uvod_otevreny_chatbot" src="https://github.com/user-attachments/assets/7907b4e1-e538-44be-9b1f-8734d05201bf" />

### Klientské rozhraní rezervačního systému
<img width="1846" height="904" alt="rezervace" src="https://github.com/user-attachments/assets/d256622e-b27a-4c57-8b20-efe45f94c10c" />

## Technologický stack
* **Frontend:** HTML, CSS, JavaScript
* **Backend:** PHP (správa uživatelských relací pomocí `session`), JavaScript (asynchronní Fetch API)
* **Databáze:** MySQL/MariaDB (úložiště typu InnoDB pro uživatele a rezervace)
* **AI a zpracování textu:** OpenAI GPT-4o API, `marked.js` library
