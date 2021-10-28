$(document).ready(function() {
    var zerrenda;
    $.get('../xml/Users.xml', function(datuak){
        zerrenda = $(datuak).find("erabiltzailea");
    });
    $("#bilatu").click(function() {
        for (var i = 0; i < zerrenda.length; i++){
            if (zerrenda[i].getElementsByTagName('eposta')[0].firstChild.nodeValue === $('#eposta').val()) {
                $('#izena').val(zerrenda[i].getElementsByTagName('izena')[0].firstChild.nodeValue);
                $('#abizenak').val(zerrenda[i].getElementsByTagName('abizena1')[0].firstChild.nodeValue + " " +
                    zerrenda[i].getElementsByTagName('abizena2')[0].firstChild.nodeValue);
                $('#telefonoa').val(zerrenda[i].getElementsByTagName('telefonoa')[0].firstChild.nodeValue);
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