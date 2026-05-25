document.addEventListener("DOMContentLoaded", () => {
    const sendBtn = document.getElementById("send-btn");
    const userInput = document.getElementById("user-input");
    const chatHistory = document.getElementById("chat-history");
    const chatIcon = document.querySelector(".chatbot-ikona");
    const chatWindow = document.querySelector(".chatbot-window");

    if (chatIcon && chatWindow) {
        chatIcon.addEventListener("click", () => {
            chatWindow.style.display = chatWindow.style.display === "flex" ? "none" : "flex";
        });
    }

    const API_KEY = "";
    const API_URL = "https://openrouter.ai/api/v1/chat/completions";

    let conversation = [
        {
            role: "system",
            content: "Jsi profesionální recepční v hotelu. Odpovídej výhradně na základě těchto informací o hotelu: [Data se načítají...]. Pokud v datech odpověď není, odkaž na recepci."
        }
    ];

    async function loadKnowledgeBase() {
        try {
            const response = await fetch('Znalostni_baze.txt');
            if (response.ok) {
                const knowledgeBaseText = await response.text();
                conversation[0].content = `Jsi profesionální recepční v hotelu. Odpovídej výhradně na základě těchto informací o hotelu:\n\n${knowledgeBaseText}\n\nPokud v datech odpověď není, odkaž na recepci.`;
            } else {
                console.error("Nepodařilo se načíst znalostní bázi.");
            }
        } catch (error) {
            console.error("Chyba při načítání znalostní báze:", error);
        }
    }

    loadKnowledgeBase();

    async function sendMessage() {
        const text = userInput.value.trim();
        if (!text) return;

        addMessageToChat(text, "user-message");
        userInput.value = "";

        conversation.push({ role: "user", content: text });

        try {
            const response = await fetch(API_URL, {
                method: "POST",
                headers: {
                    "Authorization": `Bearer ${API_KEY}`,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    model: "openai/gpt-4o",
                    messages: conversation
                })
            });

            if (!response.ok) {
                throw new Error(`HTTP chyba: ${response.status}`);
            }

            const data = await response.json();
            
            if (data.choices && data.choices.length > 0) {
                const botReply = data.choices[0].message.content;
                addMessageToChat(botReply, "bot-message");
                conversation.push({ role: "assistant", content: botReply });
            } else {
                throw new Error("Neplatná struktura odpovědi z API.");
            }

        } catch (error) {
            console.error("Chyba chatbota:", error);
            addMessageToChat("Omlouváme se, recepce má aktuálně technické potíže. Zkuste to prosím později.", "bot-message");
        }
    }

    function addMessageToChat(text, className) {
    const msgDiv = document.createElement("div");
    msgDiv.classList.add("chat-message", className);
    
    if (className === "bot-message") {
        msgDiv.innerHTML = marked.parse(text);
    } else {
        msgDiv.textContent = text;
    }
    
    chatHistory.appendChild(msgDiv);
    chatHistory.scrollTop = chatHistory.scrollHeight;
}

    if (sendBtn) sendBtn.addEventListener("click", sendMessage);
    if (userInput) {
        userInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                sendMessage();
            }
        });
    }
});