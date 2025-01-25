const search = new (function() {
    // global constants
    const { body } = document;
    let inputTarget = null;

    function removeListItems(listId) {

        if (!list || !list.firstChild) return;
        var list = document.getElementById(listId);
        while (list.firstChild){
            list.firstChild.remove();
        }
    }

    function fetchSearchData() {
        fetch('/templates/data/site-search.json')
            .then(response => response.json())
            .then(data => {
                const inputField = document.querySelector('[role="combobox"]');
                const list = document.getElementById('home-search__list');
    
                inputField.addEventListener('input', () => {
                    const searchTerm = inputField.value.trim().toLowerCase();
    
                    removeListItems('home-search__list');
                    clearComboboxState();
    
                    // Separate title and descriptions to order accordingly
                    const titleMatches = [];
                    const descMatches = [];
    
                    data.forEach(item => {
                        const originalTitle = item.title;
                        const originalDesc = item.desc;
    
                        if (originalTitle.toLowerCase().includes(searchTerm)) {
                            titleMatches.push(item);
                        } else if (originalDesc.toLowerCase().includes(searchTerm)) {
                            descMatches.push(item);
                        }
                    });
    
                    // Helper function to populate list
                    const populateList = (items) => {
                        items.forEach(item => {
                            const listItem = document.createElement('li');
                            listItem.setAttribute('role', 'option');
                            listItem.setAttribute('tabindex', '-1');
    
                            const link = document.createElement('a');
                            link.setAttribute('href', item.link);
                            link.style.display = 'block';
                            link.style.textDecoration = 'none';
    
                            // Highlight title and description
                            const title = document.createElement('strong');
                            title.innerHTML = highlightText(item.title, searchTerm);
    
                            const desc = document.createElement('p');
                            desc.innerHTML = highlightText(item.desc, searchTerm);
                            desc.style.margin = '4px 0';
    
                            link.appendChild(title);
                            link.appendChild(document.createElement('br'));
                            link.appendChild(desc);
    
                            listItem.appendChild(link);
                            list.appendChild(listItem);
                        });
                    };
    
                    populateList(titleMatches);
                    populateList(descMatches);
    
                    enableComboboxes.init();
                });
            })
            .catch(error => {
                console.error('Error fetching the JSON file:', error);
            });
    }

    function highlightText(text, searchTerm) {
        if (!searchTerm) return text;
        const regex = new RegExp(`(${searchTerm})`, "gi");
        return text.replace(regex, '<span class="highlight">$1</span>');
    }

    function clearComboboxState() {
        const listbox = document.querySelector('[role="listbox"]');
        if (listbox) {
            listbox.innerHTML = '';
        }
        enableComboboxes.list = [];
    }

    this.init = () => {
        body.addEventListener('click', this.handleClick);
        fetchSearchData();
    }

    this.handleClick = (e) => {
        if (e.target != inputTarget){
            removeListItems(e.target);
        }
    }
})