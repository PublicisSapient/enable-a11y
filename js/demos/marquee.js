import pauseAnimControl from "../modules/pause-anim-control.js";

const marqueeExample = new function () {
    const marqueeEl = document.getElementById('myMarquee');
    let articles = [];
    let currentArticleIndex = -1;

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
                rotateMarquee();
            } else {
                showFailMessage();
            }
        }).catch(showFailMessage);
    }

    const showFailMessage = (ex) => {
        marqueeEl.innerHTML += "Failed to news items.";
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
}

marqueeExample.init();