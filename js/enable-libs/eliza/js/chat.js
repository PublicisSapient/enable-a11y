const chatContainer = document.querySelector('.chatbot-container');
const chatDialogue = document.querySelector('.chatbot-dialogue');
const chatSrDialog = document.querySelector('.chatbot-sr-dialog');
const chatForm = document.querySelector('.chatbot-input');
const chatInput = document.querySelector('.chatbot-input textarea');
const chatButton = document.querySelector('.chatbot-btn');
const chatCloseButton = document.querySelector('.chatbot-close');



const initialButtonClick = (e) =>  {
  const { target } = e;

  console.log('click', target.classList.contains('chatbot-initial-btn'), target.dataset.value, target.outerHTML);

  if (target.classList.contains('chatbot-initial-btn') && target.dataset.value) {
    e.preventDefault();
    insertQueryOptions(target.dataset.value)
  }
}

const insertIntroMessage = () => {
  const intro = createChatLi(
    "Choose one of the items you want information on or ask any accessibility related question in the form below.",
    "chatbot-dialogue-incoming"
  );
  chatDialogue.appendChild(intro);
};

const insertInitialButtons = () => {
  const wrapper = document.createElement("div");
  wrapper.classList.add("chatbot-initial-options");

  /* const p = document.createElement("p");
  p.textContent = "Choose one of the following options:"; */

  const list = document.createElement("ul");
  list.classList.add("chatbot-options-list");

  const options = [
    {
      'label': "Website Accessibility",
      'value': 'web'
    },
    {
      'label': "Mobile App Accessibility",
      'value': 'mobile'
    }
  ];

  options.forEach((option) => {
    const li = document.createElement("li");
    const btn = document.createElement("button");
    btn.type = "button";
    btn.classList.add("chatbot-initial-btn");
    btn.textContent = option.label;
    btn.dataset.value = option.value;

    /* btn.addEventListener("click", () => {
      // Put the label into the input field as if the user chose it
      chatInput.value = label;
      chatInput.focus();
    }); */

    li.appendChild(btn);
    list.appendChild(li);
  });

  
  wrapper.appendChild(list);

  const li = document.createElement("li");
  li.classList.add("chatbot-dialogue-chat", "chatbot-dialogue-incoming");
  li.appendChild(wrapper);
  chatDialogue.appendChild(li);
};

// ------------------------------
// NEW — Create special lipstick options
// ------------------------------

const sayLastMessage = () => {
  chatSrDialog.innerHTML = "";
  setTimeout(() => { 
    chatSrDialog.innerHTML = document.getElementById('chatbot-instructions').textContent;
  }, 250);
  
}

const insertQueryOptions = (query) => {
  const wrapper = document.createElement("div");
  wrapper.classList.add("chatbot-quick-options");

  // Instruction text
  const instructionId = "lipstick-options-instruction-" + Date.now();
  const instruction = document.createElement("p");
  instruction.id = instructionId;
  instruction.textContent =
    `Use the following links about ${query}, or refine your query by typing more below.`;

  // UL container with aria-labelledby
  const list = document.createElement("ul");
  list.classList.add("chatbot-options-list");
  list.setAttribute("aria-labelledby", instructionId);

  const options = {
    'web': [
      {
        label: 'Enable Website',
        href: 'https://www.useragentman.com/enable'
      },
      {
        label: 'W3Cs Introduction to Web Accessibility',
        href: 'https://www.w3.org/WAI/fundamentals/accessibility-intro/'
      },
      {
        label: 'MDN Documentation on Web Accessibility',
        href: 'https://developer.mozilla.org/en-US/docs/Web/Accessibility'
      }
    ],
    'mobile': [
      {
        label: 'Mobile Accessibility at W3C',
        href: 'https://www.w3.org/WAI/standards-guidelines/mobile/'
      },
      {
        label: 'Mobile Accessibility Checklist',
        href: 'https://www.accessibilitychecker.org/guides/mobile-apps-accessibility/'
      },
      {
        label: 'Insights on Mobile Accessibility',
        href: 'https://makeitfable.com/article/insights-mobile-accessibility/'
      }
    ]
  };

  const selectedOptions = options[query];
  console.log(options);

  selectedOptions.forEach((optData) => {
    const li = document.createElement("li");
    const link = document.createElement("a");

    link.href = optData.href;

    link.classList.add("chatbot-option-link");
    link.textContent = optData.label;
    link.tabIndex = 0;

    link.addEventListener("click", (e) => {
      e.preventDefault();
      chatInput.value = optText;
      chatInput.focus();
    });

    li.appendChild(link);
    list.appendChild(li);
  });

  wrapper.appendChild(instruction);
  wrapper.appendChild(list);

  // Insert into the chat as an incoming message
  const li = document.createElement("li");
  li.classList.add("chatbot-dialogue-chat", "chatbot-dialogue-incoming");
  li.appendChild(wrapper);
  chatDialogue.appendChild(li);


  setTimeout(() => {
    list.querySelector("a").focus();

    // Scroll and move focus to the first link
    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
  }, 100);
};

// ------------------------------
const generateResponse = (incomingChat, userMessage) => {
  const message = incomingChat.querySelector('p');
  const messageString =
    "Lorem ipsum dolor, sit amet consectetur adipisicing elit.";

  setTimeout(() => {
    const userInput = (userMessage || "").toLowerCase();
    
    console.log('user input:', userMessage);

    // If user mentions lipstick → replace generic response
    if (userInput.includes("web") || userInput.includes("mobile")) {
      incomingChat.remove(); // remove “Thinking...” message
      insertQueryOptions(userInput);
      //chatSrDialog.innerHTML = "Chatbot provided lipstick information options.";
    } else {

      // Default response
      message.textContent = messageString;
      chatSrDialog.innerHTML = "Chatbot responded: " + messageString;
    }

    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
     
    
  }, 600);
};

// ------------------------------
const createChatLi = (message, className) => {
  const chatLi = document.createElement("li");
  chatLi.classList.add("chatbot-dialogue-chat", className);
  let chatContent = className === "chatbot-dialogue-outgoing"
    ? `<span class="sr-only">You respond:</span><p></p>`
    : `<img alt="" aria-hidden="true" class="chat-message-icon" src="images/eliza/guy.png"><span class="sr-only">Chatbot says:</span><p></p>`;
  chatLi.innerHTML = chatContent;
  chatLi.querySelector("p").textContent = message;
  return chatLi;
};

// ------------------------------
const submitChat = (e) => {
  e.preventDefault();
  const message = chatInput.value.trim();
  if (!message) return;  

  chatDialogue.appendChild(
    createChatLi(message, "chatbot-dialogue-outgoing")
  );
  chatSrDialog.innerHTML = 'You respond: ' + message;
  chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
  chatInput.value = '';

  setTimeout(() => {
    const incomingChat = createChatLi('Thinking...', "chatbot-dialogue-incoming");
    chatDialogue.appendChild(incomingChat);
    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
    generateResponse(incomingChat, message); // ← pass original user message
  }, 400);
};

// ------------------------------
const submitOnEnter = (e) => {
  if (e.key === "Enter" && !e.shiftKey) submitChat(e);
};

// ------------------------------
const toggleChatbot = () => {
  const chatButtonLabel = document.querySelector('.chatbot-btn-label');
  const { activeElement } = document;
  chatContainer.classList.toggle("show-chatbot");

  chatContainer.classList.contains("show-chatbot")
    ? chatButtonLabel.innerText = "Close the chat dialogue."
    : chatButtonLabel.innerText = "Open the chat dialogue.";

  setTimeout(() => {
    // ✔ focus stays on close button
    chatCloseButton.focus();

    // Clear old content
    // chatDialogue.innerHTML = "";

    // Insert intro text
    //insertIntroMessage();

    // Insert the two-option button menu
    insertInitialButtons();

    chatDialogue.scrollTo(0, chatDialogue.scrollHeight);
    sayLastMessage();
  }, 400);
};

// ------------------------------
chatForm.addEventListener("submit", submitChat);
chatForm.addEventListener("keypress", submitOnEnter);
chatButton.addEventListener("click", toggleChatbot);
chatCloseButton.addEventListener("click", toggleChatbot);
chatContainer.addEventListener("click", initialButtonClick, true);
