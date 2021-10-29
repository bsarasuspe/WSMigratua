$(document).ready(function () {
	counter();
});

setInterval(counter, 10000);

function counter(){
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