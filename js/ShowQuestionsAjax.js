var xhro = new XMLHttpRequest();

xhro.onload = function(){
	document.getElementById("erakutsi").innerHTML = xhro.responseText; 
}
 
function ShowQuestionsAjax(){
	xhro.open("GET","../php/ShowJsonQuestionsTable.php?q="+ new Date().getTime(),true);
	xhro.send();
}