$(document).ready(function() {
    $("#submit").click(function(){
        // Eposta
        if ($("#frmeposta").val().length == 0) {
            alert("Eposta hutsik dago")
            return false;
        } else {
            // Eposta konprobatu
            if (!emailKonprobatu()) {
                //Txarto
                alert("Eposta okerra da")
                return false;
            }
        }

        // Galdera testua
        if ($("#frmgalderatxt").val().length == 0) {
            alert("Galdera testua hutsik dago");
            return false;
        } else if ($("#frmgalderatxt").val().length < 10) {
            alert("Galdera testua gutxienez 10 karaktere izan behar ditu");
            return false;
        }

        // Erantzun zuzena
        if ($("#frmerantzunzuzena").val().length == 0) {
            alert("Erantzun zuzena hutsik dago");
            return false;
        }

        // 1. Erantzun okerra
        if ($("#frmerantzunokerra1").val().length == 0) {
            alert("1. erantzun okerra hutsik dago");
            return false;
        }

        // 2. Erantzun okerra
        if ($("#frmerantzunokerra2").val().length == 0) {
            alert("2. erantzun okerra hutsik dago");
            return false;
        }

        // 3. Erantzun okerra
        if ($("#frmerantzunokerra3").val().length == 0) {
            alert("3. erantzun okerra hutsik dago");
            return false;
        }

        // Zailtasuna
        if (!$("#frmrdbtxikia").prop("checked") && !$("#frmrdbertaina").prop("checked") && !$("#frmrdbhandia").prop("checked")) {
            alert("Zailtasuna hutsik dago");
            return false;
        }

        // Gaia
        if ($("#frmgaiarloa").val().length == 0) {
            alert("Gaia hutsik dago");
            return false;
        }

        // Dena ondo
        return true;
    })
})

function emailKonprobatu() {
    var pattern = new RegExp(/^(([a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es))|([a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)|[a-zA-Z]+@ehu\.(eus|es)))$/i)
    return pattern.test($("#frmeposta").val());
}