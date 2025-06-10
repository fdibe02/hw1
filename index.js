loadCards();

onLoadAPI2();


function loadCards(){
    fetch("load_cards.php").then(onResponse).then(onJsonCards);
}

function onResponse(response){
    if (!response.ok) 
      return null;

    return response.json();
}

function onJsonCheck(json){

  if(!json.ok) console.log("Errore");
  
}

function onJsonCards(json){

    for(article in json){
        const card = document.createElement('a');
        card.classList.add('card');
        const cardID = card.dataset.id = json[article].id;

        const main = document.querySelector('#main');
        main.appendChild(card);

        const content = document.createElement('a');
        content.classList.add('content');

        card.appendChild(content);
    
        const author = document.createElement('div');
        author.classList.add('author');
        content.appendChild(author);

        const credits = document.createElement('div');
        credits.classList.add('credits');
        credits.innerHTML= "by "+json[article].author_name+" "+json[article].author_surname;
        author.appendChild(credits);

        const text = document.createElement('a');
        text.classList.add('text');
        text.href = "article.php?q="+cardID;
        content.appendChild(text);

        const cardTitle = document.createElement('h2');
        cardTitle.innerHTML = json[article].title;
        text.appendChild(cardTitle);

        const subtitle = document.createElement('p');
        subtitle.innerHTML = json[article].subtitle;
        text.appendChild(subtitle);

        const footer = document.createElement('div');
        footer.classList.add('card-footer');
        content.appendChild(footer);

        const interaction = document.createElement('div');
        interaction.classList.add('interaction');
        footer.appendChild(interaction);

        const comments = document.createElement('div');
        interaction.appendChild(comments);

        const likes = document.createElement('div');
        likes.classList.add('likes');
        interaction.appendChild(likes);

        const n_likes = document.createElement('div');
        n_likes.classList.add('n');
        n_likes.innerHTML = json[article].likes;
        likes.appendChild(n_likes);

        const likeButton = document.createElement('div');
        likeButton.classList.add('add-rl');
        likeButton.addEventListener('click', onAddRLClick);
        likes.appendChild(likeButton);
        checkIfLiked(card);

        const dislike = document.createElement('div');
        dislike.classList.add('dislike');
        dislike.innerHTML = "&#128078;";
        dislike.addEventListener('click', onDislikeClick);
        interaction.appendChild(dislike);

        const image_space = document.createElement('div');
        image_space.classList.add('image-space');
        card.appendChild(image_space);
        
        const img = document.createElement('img');
        if(json[article].img !== "") {
           img.src = json[article].img;
          image_space.appendChild(img);
        }
    } 

}

function checkIfLiked(card){
  const cardID = card.dataset.id;

  fetch("check_liked.php?q="+cardID).then(onResponse).then(onCheckedLikedJson);
}

function onCheckedLikedJson(json){
  const checkedCard = document.querySelector('.card[data-id="' + json.id + '"]');
  const likeButton = checkedCard.querySelector(".add-rl");
  
  if(json.is_saved){
    likeButton.innerHTML = '&#11088';
    likeButton.dataset.added = 'true';
  }
  else{
    likeButton.innerHTML = '&#10133;';
    likeButton.dataset.added = 'false';
  }
}


function onDislikeClick(event) {
  dislikedCard = event.currentTarget.parentNode.parentNode.parentNode.parentNode;
    const dislikeModal = document.querySelector("#dislike-modal");
    dislikeModal.classList.remove("hidden");
    document.body.classList.add("no-scroll");
    dislikeModal.style.top = window.pageYOffset + "px";
  }
  
  function onUndoClick() {
    const dislikeModal = document.querySelector("#dislike-modal");
    dislikeModal.classList.add("hidden");
    document.body.classList.remove("no-scroll");
  }

  let dislikedCard = null;

  function onDoneClick() {
    removeFromLiked(dislikedCard);
    addToDislikedArticles(dislikedCard);
    dislikedCard.remove();
    onUndoClick();
  }

  function addToDislikedArticles(card){
    const cardID = card.dataset.id;

    const formData = new FormData();
    formData.append('id', cardID);

    fetch("add_to_disliked.php", {method: 'post', body: formData}).then(onResponse).then(onJsonCheck);
    
  }
  
  const dislikeList = document.querySelectorAll(".dislike");
  
  const undo = document.querySelector("#undo");
  undo.addEventListener("click", onUndoClick);
  
  const done = document.querySelector("#done");
  done.addEventListener("click", onDoneClick);




function onLoadAPI2(){
  fetch("NYTimesAPI.php").then(onResponse).then(onJsonAPI2);
  }
  
  function onJsonAPI2(json){
    console.log(json);
  
  const news_section = document.getElementById('news-section')
  const section_title = document.createElement('h2');
  news_section.appendChild(section_title);
  section_title.textContent = "News by NY Times";
  
  for(let i = 0; i < 10; i++){
      const side_card = document.createElement('div');
      side_card.classList.add('side-card');
      news_section.appendChild(side_card);
  
  
      const side_author_section = document.createElement('div');
      side_author_section.classList.add('side-author');
      side_card.appendChild(side_author_section);
  
      
      const ny_times_logo = document.createElement('img');
       ny_times_logo.src = "https://1000logos.net/wp-content/uploads/2017/04/Symbol-New-York-Times.png";
       side_author_section.appendChild(ny_times_logo);
   
  
     const by_line = document.createElement('div');
      by_line.textContent = json.results[i].byline;
     side_author_section.appendChild(by_line);
      
  
      const news_headline = document.createElement('h3');
      news_headline.textContent = json.results[i].title;
      side_card.appendChild(news_headline);
    
  
      const news_date = document.createElement('div');
      news_date.classList.add('date');
      const unformatted_date = json.results[i].published_date;
      const formatted_date = writeDate(unformatted_date);
      news_date.textContent = formatted_date;
      side_card.appendChild(news_date);
  
    }
  
  }

  function writeDate(date){
      const month_number = date.substring(5, 7);
      const months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
      
      const month = months[month_number-1];
      const day = date.substring(8);
      const news_date = 'published on ' + month + ', ' + day; 
      
      return news_date;
    }
  
  
  function onAddRLClick(event){
   const addButton = event.currentTarget;
   const card = event.currentTarget.parentNode.parentNode.parentNode.parentNode.parentNode;
   const isAdded = addButton.dataset.added;
   const n_likes = card.querySelector('.likes .n');

   if(isAdded === 'true'){
      addButton.innerHTML="&#10133;";
      n_likes.innerHTML = parseInt(n_likes.innerHTML) - 1;
      addButton.dataset.added = "false";
      removeFromLiked(card);
   }else{
    addButton.innerHTML="&#11088;";
    n_likes.innerHTML = parseInt(n_likes.innerHTML) + 1;
    addButton.dataset.added = "true";
    addToLiked(card);
   }
  }

  function addToLiked(card){
    const cardID = card.dataset.id;

    const formData = new FormData();
    formData.append('id', cardID);

    fetch("add_to_liked_articles.php", {method: 'post', body: formData}).then(onResponse).then(onJsonCheck);
  }

  function removeFromLiked(card){
    const cardID = card.dataset.id;
    
    const formData = new FormData();
    formData.append('id', cardID);

    fetch("remove_from_liked.php", {method: 'post', body: formData}).then(onResponse).then(onJsonCheck);

  }

  
  


  
  