var page = document.getElementsByClassName("page")[0];
function doWhenDoneLoading(){
  setTimeout(function(){
    page.removeAttribute("style");
    page.classList.remove("loading");
  }, 800);
};
var xmlhttp2 = new XMLHttpRequest(), xmlhttp3 = new XMLHttpRequest(), processResponse = function(isUsername, repsonse){
  if(isUsername){
    if(repsonse == "true"){
      //The account does exist, move to the next step.
      document.getElementById("username").style.display = "none";
      document.getElementById("password").style.display = "block";
    }else{
      //This account doesn't exist!
      usernameInputError(true, "There is no such username!");
    }
  }else{
    if(repsonse != "false"){
      //The user is signed in!
      var p = getParams();
      if(p.RURL != undefined){
        window.location.href = p.RURL;
      }else{
        window.location.href = "[Your_Default_URL]";
      }
      //
      //Check if the user has the two-steps-sign-in option turned on.
    }else{
      //This account doesn't exist!
      passwordInputError(true, "The password is incorrect!");
    }
  }
};
xmlhttp2.onreadystatechange = function(){
  if(xmlhttp2.readyState === XMLHttpRequest.DONE){
    var status = xmlhttp2.status;
    if(status === 0 || (status >= 200 && status < 400)){
      processResponse(true, xmlhttp2.responseText);
      doWhenDoneLoading();
    }else{
      //Show an error
      doWhenDoneLoading();
    }
  }
};
xmlhttp3.onreadystatechange = function(){
  if(xmlhttp3.readyState === XMLHttpRequest.DONE){
    var status = xmlhttp3.status;
    if(status === 0 || (status >= 200 && status < 400)){
      processResponse(false, xmlhttp3.responseText);
      doWhenDoneLoading();
    }else{
      //Show an error
      doWhenDoneLoading();
    }
  }
};
//
const messageBox = document.getElementsByClassName("message")[0], textC = messageBox.getElementsByTagName("h4")[0], showMessage = function(text){
  textC.innerHTML = text;
  messageBox.setAttribute("style", "opacity: 1;");
  textC.setAttribute("style", "opacity: 1;");
}, passwordInput = document.getElementsByName("passwordInput")[0], usernameInput = document.getElementsByName("usernameInput")[0], usernameInputErrorText = document.getElementsByClassName("usernameInput")[0], alt = document.getElementById("alt"), usernameInputError = function(isError, text = "[Error_Message]"){
  if(isError){
    usernameInputErrorText.innerHTML = text;
    usernameInputErrorText.style.display = "block";
    usernameInput.classList.add("error");
    alt.classList.add("error");
  }else{
    usernameInputErrorText.style.display = "none";
    usernameInput.classList.remove("error");
    alt.classList.remove("error");
  }
}, passwordInputErrorText = document.getElementsByClassName("passwordInput")[0], passwordInputError = function(isError, text = "[Error_Message]"){
  if(isError){
    passwordInputErrorText.innerHTML = text;
    passwordInputErrorText.style.display = "block";
    passwordInput.classList.add("error");
  }else{
    passwordInputErrorText.style.display = "none";
    passwordInput.classList.remove("error");
  }
};
function doWhenLoading(){
  messageBox.setAttribute("style", "opacity: 0;");
  usernameInputError(false);
  passwordInputError(false);
  page.setAttribute("style", "transition-duration: 0s;");
  page.classList.add("loading");
};
document.getElementById("_next").addEventListener("click", function(){
  doWhenLoading();
  if(!usernameInput.value.match(/^[0-9a-zA-Z_]+$/) && usernameInput.value != ""){
    usernameInputError(true, "This username contains illegal characters!");
    doWhenDoneLoading();
  }else if(usernameInput.value == ""){
    usernameInputError(true, "Please enter your username!");
    doWhenDoneLoading();
  }else{
    try{
      xmlhttp2.open("GET", "./../system/SignIn.php?EE=" + encodeURI(usernameInput.value) + "&date=" + new Date(), false);
      xmlhttp2.send();
    }catch(error){
      showMessage("The server is unreachable at the moment!");
      doWhenDoneLoading();
    }
    //
  }
});
document.getElementById("_goBack").addEventListener("click", function(){
  document.getElementById("password").style.display = "none";
  document.getElementById("username").style.display = "block";
});
document.getElementById("_signIn").addEventListener("click", function(){
  doWhenLoading();
  if(passwordInput.value == ""){
    passwordInputError(true, "Please enter your username!");
    doWhenDoneLoading();
  }else{
    try{
      xmlhttp3.open("GET", "./../system/SignIn.php?EP=" + encodeURI(passwordInput.value) + "&date=" + new Date(), false);
      xmlhttp3.send();
    }catch(error){
      showMessage("The server is unreachable at the moment!");
      doWhenDoneLoading();
    }
  }
});
document.getElementById("_createAccount").addEventListener("click", function(){
  window.location.href = "../signup/";
});