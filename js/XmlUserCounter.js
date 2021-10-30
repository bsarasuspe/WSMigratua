$(document).ready(function () {
	userCounter();
});

setInterval(userCounter, 10000);

function userCounter(){
    $.ajax({
        method: 'GET',
        url: '../xml/UserCounter.xml',
        dataType: 'xml',
        cache: false,
        success: function (data) {
            console.log(data);
            $("#userKop").html(data.getElementsByTagName('n')[0].childNodes[0].nodeValue);
        },
    });
}