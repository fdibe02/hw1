
function onSignupClick(){
    const modal_signup = document.querySelector("#modal-signup");
    const modal_signin = document.querySelector("#modal-signin");
    modal_signup.classList.remove("hidden");
    modal_signin.classList.add("hidden");
    document.body.classList.add("no-scroll");
}

function onSigninClick(){
    const modal_signin = document.querySelector("#modal-signin");
    const modal_signup = document.querySelector("#modal-signup");
    modal_signup.classList.add("hidden");
    modal_signin.classList.remove("hidden");
    document.body.classList.add("no-scroll");
}

function onExitSignupClick(){
    const modal_signup = document.querySelector("#modal-signup");
    modal_signup.classList.add("hidden");
}

function onExitSigninClick(){
    const modal_signin = document.querySelector("#modal-signin");
    modal_signin.classList.add("hidden");
}


function onJsonEmail(json){
    formSignUpStatus["email"] = !json.exists;
    const message = document.querySelector('.email span');

    if(formSignUpStatus["email"]){
        message.classList.add('hidden');
    }else{
        message.innerHTML = "Email già utilizzata";
        message.classList.remove('hidden');
    }
}

function onResponse(response){
    if(!response.ok) return null;
    
    return response.json();
}

function checkSignUpName(event){
    const input = event.currentTarget;
    const message = document.querySelector('.nome span');

    formSignUpStatus[input.name] = input.value.length;

    if(formSignUpStatus[input.name] > 0 ){
        message.classList.add("hidden");
    }else
        message.classList.remove("hidden");
}

function checkSignUpSurname(event){
    const input = event.currentTarget;
    const message = document.querySelector('.cognome span');

    formSignUpStatus[input.name] = input.value.length;

    if(formSignUpStatus[input.name] > 0){
        message.classList.add("hidden");
    }else
        message.classList.remove("hidden");

}

function checkSignUpEmail(event){
    const input = event.currentTarget;
    const message = document.querySelector('.email span');

    if (input.value.length > 0 && !/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
        message.textContent = "E-mail non valida";
        message.classList.add('error');
        message.classList.remove("hidden");
        formSignUpStatus[input.email] = false;

    } else if(input.value.length > 0){
        message.classList.add("hidden");
        fetch("check_email.php?q="+encodeURIComponent(String(input.value).toLowerCase())).then(onResponse).then(onJsonEmail);
    } else{
        message.classList.remove("hidden");
    }

}  
  
function checkSignUpassword(event){
    const input = event.currentTarget;
    const message = document.querySelector('.password span');

    formSignUpStatus[input.name] = input.value.length;

    if(formSignUpStatus[input.name] >= 8){
        message.classList.add('hidden');
    } else if (formSignUpStatus[input.name] == 0){
        message.classList.remove('hidden');
        formSignUpStatus[input.name] = false;
    } else {
        message.textContent = "inserire min. 8 caratteri";
        message.classList.add('error');
        message.classList.remove("hidden");
        formSignUpStatus[input.name] = false;
    }
}

const signup_buttons = document.querySelectorAll(".signup");
for (let signup_button of signup_buttons){
    signup_button.addEventListener("click", onSignupClick);
}

const signin_buttons = document.querySelectorAll(".signin");
for (let signin_button of signin_buttons){
    signin_button.addEventListener("click", onSigninClick);
}

function checkSingUpForm(event){
    if (Object.keys(formSignUpStatus).length !== 5 || Object.values(formSignUpStatus).includes(false)) {
        event.preventDefault();
    }
}


function checkSignInForm(event){
    if(signin_form.email.value.length == 0 || signin_form.password.value.length == 0){
        event.preventDefault();
    }
}

const formSignUpStatus = {'upload': true};

const signup_form = document.forms['signup'];
signup_form.addEventListener('submit', checkSingUpForm);

const exit_signup = document.querySelector("#modal-signup .exit");
exit_signup.addEventListener("click", onExitSignupClick);

const input_name = document.querySelector(".nome input");
input_name.addEventListener('blur', checkSignUpName);


const input_surname = document.querySelector(".cognome input");
input_surname.addEventListener('blur', checkSignUpSurname);

const input_email = document.querySelector("#form-signup .email input");
input_email.addEventListener('blur', checkSignUpEmail);


const input_password = document.querySelector("#form-signup .password input");
input_password.addEventListener('blur', checkSignUpassword);


const signin_form = document.forms['signin'];
signin_form.addEventListener('submit', checkSignInForm);

const exit_signin = document.querySelector("#modal-signin .exit");
exit_signin.addEventListener("click", onExitSigninClick);














