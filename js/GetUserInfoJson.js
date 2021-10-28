$(document).ready(function() {
    var zerrenda;
    $.getJSON('../json/Users.json', function(datuak){
        zerrenda =  datuak.erabiltzaileak
    });
    $("#bilatu").click(function() {
        for (var i = 0; i < zerrenda.length; i++){
            if (zerrenda[i].eposta === $('#eposta').val()) {
                $('#izena').val(zerrenda[i].izena);
                $('#abizenak').val(zerrenda[i].abizena1 + " " + zerrenda[i].abizena2);
                $('#telefonoa').val(zerrenda[i].telefonoa);
                return;
            }
        }

        // Eposta ez da aurkitu
        alert("Eposta hau ez dago UPV/EHU-n erregistratuta, berriro saiatu")
        $('#izena').val("");
        $('#abizenak').val("");
        $('#telefonoa').val("");
    });
});