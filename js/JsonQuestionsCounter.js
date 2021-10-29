$(document).ready(function () {
	counter();
});

setInterval(counter, 10000);

function counter(){
    $.ajax({
        method: 'GET',
        url: '../json/Questions.json',
        dataType: 'json',
        cache: false,
        success: function (data) {
            var eposta = $("#frmeposta").val();
            var galderaKop = data.assessmentItems.length;
            var erabiltzaileGalderaKop = 0;
            $.each (data.assessmentItems, function(i,item){
                if (eposta == item.author) {
                    erabiltzaileGalderaKop++; 
                }
            });
            $("#galderaKop").html(erabiltzaileGalderaKop + "/" + galderaKop);
        },
    });
}