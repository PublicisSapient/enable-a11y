const chatContainer = document.querySelector('.chatbot-container');
const chatDialogue = document.querySelector('.chatbot-dialogue');
const chatSrDialog = document.querySelector('.chatbot-sr-dialog');
const chatForm = document.querySelector('.chatbot-input');
const chatInput = document.querySelector('.chatbot-input textarea');
const chatButton = document.querySelector('.chatbot-btn');
const chatCloseButton = document.querySelector('.chatbot-close');

const generateResponse = (incomingChat) => {
  const message = incomingChat.querySelector('p');
  const messageString = "Lorem ipsum dolor, sit amet consectetur adipisicing elit.";
  setTimeout(() => {
    message.textContent = messageString;
    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
    chatSrDialog.innerHTML = 'Chatbot responded: ' + messageString;
  }, 600);  
}

const createChatLi = (message, className) => {
  const chatLi = document.createElement("li");
  chatLi.classList.add("chatbot-dialogue-chat", className);
  let chatContent = className === "chatbot-dialogue-outgoing" ? `<span class="sr-only">You respond:</span><p></p>` : `<img alt="" aria-hidden="true" class="chat-message-icon" src="images/eliza/guy.png"><span class="sr-only">Chatbot says:</span><p></p>`;
  chatLi.innerHTML = chatContent;
  chatLi.querySelector("p").textContent = message;
  return chatLi;
}

const submitChat = (e) => {
  e.preventDefault();
  const message = chatInput.value.trim();
  if (!message) return;  
  chatDialogue.appendChild(createChatLi(message, "chatbot-dialogue-outgoing"));
  chatSrDialog.innerHTML='You respond: ' + message;
  chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
  chatInput.value = '';  

  setTimeout(() => {
    const incomingChat = createChatLi('Thinking...', "chatbot-dialogue-incoming");
    chatDialogue.appendChild(incomingChat);
    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
    generateResponse(incomingChat);
  }, 400)
};

const submitOnEnter = (e) => {
  if (e.key === "Enter" && !e.shiftKey) submitChat(e);
};

const toggleChatbot = () => {
  const chatButtonLabel = document.querySelector('.chatbot-btn-label');
  const { activeElement } = document;
  chatContainer.classList.toggle("show-chatbot");
  chatContainer.classList.contains("show-chatbot") ? chatButtonLabel.innerText = "Close the chat dialogue." : chatButtonLabel.innerText = "Open the chat dialogue.";

  if (activeElement === chatButton) {
    chatCloseButton.focus();
  } else {
    chatButton.focus();
  }
  setTimeout(() => {
    const initialChat = createChatLi("How can I help you today?", "chatbot-dialogue-incoming");
    chatDialogue.appendChild(initialChat);
    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
  }, 400)
}

chatForm.addEventListener("submit", submitChat);
chatForm.addEventListener("keypress", submitOnEnter);
chatButton.addEventListener("click", toggleChatbot);
chatCloseButton.addEventListener("click", toggleChatbot);