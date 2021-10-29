var xhro = new XMLHttpRequest();

xhro.onload = function(){
	document.getElementById("erakutsi").innerHTML = xhro.responseText; 
}
 
function ShowQuestionsAjax(){
	//var eposta = document.getElementById('eposta').value;
	xhro.open("GET","../php/ShowJsonQuestionsTable.php?q="+ new Date().getTime(),true);
	//xhro.open("GET","../ajax_info.txt",true);
	xhro.send();
}