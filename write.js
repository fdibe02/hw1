function onSubmitClick(event){
    const title = document.getElementById('article-title');
    const content = document.getElementById('content');

    if(!(title.value.length > 0) || !(content.value.length > 0)){
        event.preventDefault();
    }  
}

let imageSelected = null;

function onResponse(response){
    if (!response){
        return null;
    }

    return response.json();
}

function onJson(json){
    const container = document.getElementById('container');
    const image = document.createElement('img');
    image.src = json.urls.small;
    image.addEventListener("click", onImageClick);
    container.appendChild(image);
}

function loadImages(){
    const title = document.getElementById('article-title');
    const container = document.getElementById('container');
    container.innerHTML = "";
    console.log(title.value);

    for(let i = 0; i<4; i++){
        fetch('UnsplashAPI.php?q='+title.value).then(onResponse).then(onJson);
    }
}

function onImageClick(event){
    imageSelected = event.currentTarget;
    imageSelected.classList.add('.selected')
    const form = document.getElementById("write-article");

    const imageInput = document.createElement('input');
    imageInput.name = 'img';
    imageInput.type = 'hidden';
    imageInput.value = imageSelected.src;

    form.appendChild(imageInput);
}

const submit = document.getElementById('submit');
submit.addEventListener('click', onSubmitClick);

const content = document.getElementById('content');
content.addEventListener('blur', loadImages);




