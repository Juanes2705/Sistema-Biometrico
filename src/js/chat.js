// Selecciona los elementos necesarios del DOM
const sendButton = document.getElementById('send-btn');
const messageInput = document.getElementById('message');
const chatMessages = document.getElementById('chat-messages');

// Función que envía el mensaje del usuario al servidor
function sendMessage() {
    const message = messageInput.value;

    if (message.trim() !== '') {
        fetch('/admin/huella/chat/index', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            // Mostrar el mensaje del usuario en el chat
            chatMessages.innerHTML += `<div class="user-message">Usuario: ${message}</div>`;
            // Mostrar la respuesta del chatbot
            chatMessages.innerHTML += `<div class="bot-message">Chatbot: ${data.response}</div>`;
            // Limpiar el campo de entrada
            messageInput.value = '';
            // Desplazar hacia abajo para ver los nuevos mensajes
            chatMessages.scrollTop = chatMessages.scrollHeight;
        })
        .catch(error => console.error('Error:', error));
    }
}

// Agregar el evento de click al botón de enviar
sendButton.addEventListener('click', sendMessage);

// También puedes enviar el mensaje presionando la tecla Enter
messageInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
});
