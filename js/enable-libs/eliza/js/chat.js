const chatContainer = document.querySelector('.chatbot-container');
const chatForm = document.querySelector('.chatbot-input');
const chatInput = document.querySelector('.chatbot-input textarea');
const chatButton = document.querySelector('.chatbot-btn');

const submitChat = (e) => {
  e.preventDefault();
  chatInput.value = '';
};

const submitOnEnter = (e) => {
  if (e.key === "Enter" && !e.shiftKey) submitChat(e);
};

const toggleChatbot = () => {
  chatContainer.classList.toggle('show-chatbot');
  chatInput.focus();
}

chatForm.addEventListener("submit", submitChat);
chatForm.addEventListener("keypress", submitOnEnter);
chatButton.addEventListener("click", toggleChatbot);