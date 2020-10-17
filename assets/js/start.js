let loop = setInterval(function(){
  if(document.readyState === 'complete'){
    clearInterval(loop);
    loop = setInterval(function(){
      if(window.shouldStart){
        clearInterval(loop);
        document.getElementById("loadingScreen").style.display = "none";
        document.getElementById("username").style.display = "block";
      }
    }, 10);
  }
}, 10);