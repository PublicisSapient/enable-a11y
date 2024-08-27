//import FlexSearch from '../../node_modules/flexsearch/dist/flexsearch.bundle.module.min';

//const FlexSearch = require("flexsearch");

//import data from "./search.json";

const search = new function () {
    //const FlexSearch = require('flexsearch');

    let curSearch;
    let inputTarget = null;

    this.init = () => {

        // Step 1: Example data this needs to be extracted from website in this form final result is shown here
        const documents = [
            { id: '1', title: 'Sample Title 1', description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' },
            { id: '2', title: 'Sample Title 2', description: 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.' },
            // Add more documents as needed
        ];

        // Step 2: Adding index/document to the library
        var index = new FlexSearch.Document({
            tokenize: "forward",
            cache: 100,
            document: {
                id: 'id',
                store: [
                    "title", "description"
                ],
                index: ["title", "description"]
            }
        });
    
        documents.forEach(item => {
            index.add({
                id: item.id,
                title: item.title,
                description: item.description
            });
        });
    
        
        // Step 3: Searching
        const query = 'sample'; // Example search query
        const results = index.search(query);

        console.log('Results here!!!!')
    
        // Step 4: Display search results
        console.log(results);


    
        
    
    }


    this.init2 = () => {
        const documents = [
            { id: 1, title: 'Moby Dick', author: { name: 'Herman Melville' }, pubDate: new Date(1851, 9, 18) },
            { id: 2, title: 'Zen and the Art of Motorcycle Maintenance', author: { name: 'Robert Pirsig' }, pubDate: new Date(1974, 3, 1) },
            { id: 3, title: 'Neuromancer', author: { name: 'William Gibson' }, pubDate: new Date(1984, 6, 1) },
            { id: 4, title: 'Zen in the Art of Archery', author: { name: 'Eugen Herrigel' }, pubDate: new Date(1948, 0, 1), link: "" },
            // ...and more
          ]
          

          const miniSearch = new MiniSearch({
            fields: ['title', 'keywords'], // fields to index for full-text search
            storeFields: ['title', 'link'] // fields to return with search results
          })
          //miniSearch.addAll(documents)
          fetch('/json/search.json')
                .then(response => response.json())
                .then(data => {
                      console.log(data)
                      
                      // Index all documents

                      return miniSearch.addAll(data)
                      
                })
                .catch(error => {
                    console.error('Error fetching the JSON file:', error);
                });
        

            
        

          
          
          // Search with default options
          
         // console.log('search results', results)

          ///Add event listener
        // Handling the input event for the search bar
        document.getElementById('search-input').addEventListener('input', function(e) {

            inputTarget = e.target;
           // console.log(e.target)
            closeAllLists();
            const searchTerm = this.value;
            const list = document.getElementById('search-results');
            list.style.display = 'block';
           // list.innerHTML = '';
            let filteredItems = miniSearch.search(searchTerm, { prefix: false, fuzzy: 1 })
            let auto = miniSearch.autoSuggest(searchTerm);
            console.log('auto', auto)

            const a = document.getElementById('autocomplete-items');

            if (searchTerm && searchTerm !== curSearch) {
                

               // const filteredItems = results[0].result;
                filteredItems.forEach(item => {
                    const listItem = document.createElement('li');
                    //console.log('map', item)
                    listItem.textContent = item.title;
                    listItem.classList.add('search-result-item');
                    //list.appendChild(listItem);

                    var link = document.createElement('a');
                    link.href = item.link;
                     

                    // const listItem = document.createElement('DIV');
                    // listItem.textContent =  `<p>${item.title}</p>`;

                    link.append(listItem) 
                    list.append(link)             



                    // a.appendChild(link);
                    
                    
                });
            }

            curSearch = searchTerm;
        });

        function closeAllLists() {
            
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var list = document.getElementById("search-results");
            while (list.firstChild){
                list.firstChild.remove();
            }
            //list.style.display = 'none'
        }
        


        document.addEventListener("click", function (e) {

            if (e.target != inputTarget){
                closeAllLists(e.target);
            }
            
        });

         //console.log("results2", results)

    }
    function execute() {
        
    }

    

}




export default search;