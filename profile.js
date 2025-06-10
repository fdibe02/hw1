
loadLikedArticles();

function loadLikedArticles(){
    fetch("fetch_liked.php").then(onResponse).then(onJson);
}

function onResponse(response){
    if (!response.ok){
        return null;
    }
    return response.json();
}

function onJson(json){

    const container = document.querySelector("#liked-articles");
    container.innerHTML = "";
    
    for(article in json){

        const cardID = json[article].id;

        const card_space = document.createElement('a');
        card_space.classList.add('card-space');
        card_space.href="article.php?q="+cardID;

        const card = document.createElement('div');
        card.classList.add('card');
        const card_title = document.createElement('h5');
        card_title.innerHTML = json[article].title;
        const card_subtitle = document.createElement('a');
        card_subtitle.innerHTML = json[article].subtitle;
        const card_image = document.createElement('img');
        card_image.src = json[article].img;
        console.log(card_image.src);

        container.appendChild(card_space);
        card_space.appendChild(card);
        card.appendChild(card_title);
        if(card_image.src !== "") card.appendChild(card_image);
        card.appendChild(card_subtitle);
        
    }

}