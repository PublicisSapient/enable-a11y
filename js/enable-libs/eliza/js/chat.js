const chatContainer = document.querySelector('.chatbot-container');
const chatDialogue = document.querySelector('.chatbot-dialogue');
const chatForm = document.querySelector('.chatbot-input');
const chatInput = document.querySelector('.chatbot-input textarea');
const chatButton = document.querySelector('.chatbot-btn');

const generateResponse = (incomingChat) => {
  const message = incomingChat.querySelector('p');
  setTimeout(() => {
    message.textContent = "Lorem ipsum dolor, sit amet consectetur adipisicing elit.";
    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
  }, 600);  
}

const createChatLi = (message, className) => {
  const chatLi = document.createElement("li");
  chatLi.classList.add("chatbot-dialogue-chat", className);
  let chatContent = className === "chatbot-dialogue-outgoing" ? `<p></p>` : `<img src="images/eliza/guy.png" class="chat-message-icon"><p></p>`;
  chatLi.innerHTML = chatContent;
  chatLi.querySelector("p").textContent = message;
  return chatLi;
}

const submitChat = (e) => {
  e.preventDefault();
  const message = chatInput.value.trim();
  if (!message) return;  
  chatDialogue.appendChild(createChatLi(message, "chatbot-dialogue-outgoing"));
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
  chatContainer.classList.toggle("show-chatbot");
  chatContainer.classList.contains("show-chatbot") ? chatButtonLabel.innerText = "Close the chat dialogue." : chatButtonLabel.innerText = "Open the chat dialogue.";
  chatInput.focus();
}

chatForm.addEventListener("submit", submitChat);
chatForm.addEventListener("keypress", submitOnEnter);
chatButton.addEventListener("click", toggleChatbot);