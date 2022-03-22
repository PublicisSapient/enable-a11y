import pauseAnimControl from "../modules/pause-anim-control.js";
import showcode from "../libs/showcode.js";

const marqueeExample = new function () {
    const marqueeEl = document.getElementById('myMarquee');
    let articles = [];
    let currentArticleIndex = -1;

    this.init = () => {
        this.getHeadlines();
    }

    this.getHeadlines = () => {
        var result = fetch('services/getHeadlines.php');
        result.then(function (response) {
           
            
            return response.json();
        }).then(function (json) {
            if (json.articles.length > 0) {
                articles = json.articles;
                rotateMarquee();
            } else {
                showFailMessage();
            }
        }).catch(showFailMessage);
    }

    const showFailMessage = () => {
        marqueeEl.innerHTML += "Failed to load news items.";
    }

    const rotateMarquee = () => {
       
       currentArticleIndex = (currentArticleIndex + 1) % articles.length;
       const currentArticle = articles[currentArticleIndex];
       const { title, url } = currentArticle;

       marqueeEl.innerHTML = `<a href="${url}">${title}</a>`;

       setTimeout(() => {
           pauseAnimControl.requestAnimationFrame(rotateMarquee, { ignoreTime: true })
       }, 10000);

    }

    showcode.addJsObj('rotateMarquee', rotateMarquee); 
}


marqueeExample.init();