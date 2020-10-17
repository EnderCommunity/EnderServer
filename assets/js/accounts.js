const check = function(){
  if(window.shouldSkipOnSignedIn && window.userData.isSignedIn == 1){
    window.location.href = "[Service_Website]";
    try{
      window.close();
    }catch(error){ /**/ }
  }
};
window.shouldStart = false;
window.userData = {
  isSignedIn: 0
};
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function(){
  if(xmlhttp.readyState === XMLHttpRequest.DONE){
    var status = xmlhttp.status;
    if(status === 0 || (status >= 200 && status < 400)){
      window.userData = JSON.parse(xmlhttp.responseText);
      check();
      window.shouldStart = true;
    }else{
      check();
      window.shouldStart = true;
    }
  }
};
try{
  xmlhttp.open("GET", "./../system/currentUser.json.php?date=" + new Date(), false);
  xmlhttp.send();
}catch(error){
  check();
  window.shouldStart = true;
}
const getParams = function(){
	var params = {};
	var parser = document.createElement('a');
	parser.href = window.location.href;
	var query = parser.search.substring(1);
	var vars = query.split('&');
	for(var i = 0; i < vars.length; i++){
		var pair = vars[i].split('=');
		params[pair[0]] = decodeURIComponent(pair[1]);
	}
	return params;
};