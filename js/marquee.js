const marqueeExample = new function () {
    const marqueeEl = document.getElementById('myMarquee');
    let articles = [];
    let currentArticle = -1;

    this.init = () => {
        this.getHeadlines();
    }

    this.getHeadlines = () => {
        var result = fetch('bin/getHeadlines.php');
        result.then(function (response) {
           
            
            return response.json();
        }).then(function (json) {
            console.log('response', json.articles.length);
            if (json.articles.length > 0) {
                articles = json.articles;
                requestAnimationFrame(rotateMarquee);
            } else {
                requestAnimationFrame(showFailMessage);
            }
        }).catch(showFailMessage);
    }

    const showFailMessage = (ex) => {
        marqueeEl.innerHTML += "<div>Failed to news items.</div>"
    }

    const rotateMarquee = () => {
       currentArticle = (currentArticle + 1) % articles.length;

       marqueeEl.innerHTML = "<div>" + articles[currentArticle].title + "</div>";

       setTimeout(rotateMarquee, 10000);

    }
}

marqueeExample.init();