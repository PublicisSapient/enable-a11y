const search = new (function() {
    // global constants
    const { body } = document;
    let curSearch = null;
    let inputTarget = null;

    function removeListItems(listId) {

        if (!list.firstChild) return;
        var list = document.getElementById(listId);
        while (list.firstChild){
            list.firstChild.remove();
        }
    }

    function fetchSearchData(){

        fetch('/templates/data/site-search.json')
            .then(response => response.json())
            .then(data => {

                    //Add all options to the list
                    const list = document.getElementById('home-search__list');

                    for (let i = 0; i < data.length; i++){
                        const listItem = document.createElement('li');
                        const link = document.createElement('a');
                        link.textContent = data[i].title;
                        listItem.setAttribute('role', 'option');
                        listItem.setAttribute('tabindex', '-1');
                        link.setAttribute('href', data[i].link);
                        listItem.appendChild(link)
                        list.append(listItem);
                    }

                    enableComboboxes.init();
            })
            .catch(error => {
                console.error('Error fetching the JSON file:', error);
        });
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