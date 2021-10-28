function allVal() {
    var valErrors = ""

    email = document.getElementById("frmeposta").value
    if (!emailVal(email)) {valErrors += "Emaila ez da egokia.\n"}

    galderaTxt = document.getElementById("frmgalderatxt").value
    if (!ezHutsaVal(galderaTxt) || !luzeraVal(galderaTxt)) valErrors += "Galdera ez da egokia.\n"

    erantzunZuzena = document.getElementById("frmerantzunzuzena").value
    if (!ezHutsaVal(erantzunZuzena)) valErrors += "Erantzun zuzena ez da egokia.\n"

    erantzunOker1 = document.getElementById("frmerantzunokerra1").value
    if (!ezHutsaVal(erantzunOker1)) valErrors += "Erantzun okerra (1) ez da egokia.\n"

    erantzunOker2 = document.getElementById("frmerantzunokerra2").value
    if (!ezHutsaVal(erantzunOker2)) valErrors += "Erantzun okerra (2) ez da egokia.\n"

    erantzunOker3 = document.getElementById("frmerantzunokerra3").value
    if (!ezHutsaVal(erantzunOker3)) valErrors += "Erantzun okerra (3) ez da egokia.\n"

    errez = document.getElementById("frmrdbtxikia").checked
    ertain = document.getElementById("frmrdbertaina").checked
    zaila = document.getElementById("frmrdbhandia").checked
    if (!(errez || ertain || zaila)) {valErrors += "Zailtasuna erabaki.\n"}

    gai_arloa = document.getElementById("frmgaiarloa").value
    if (!ezHutsaVal(gai_arloa)) valErrors += "Gai arloa ez da egokia.\n"

    if(valErrors!=="") alert(valErrors)

    return valErrors===""
}

function emailVal(email) {
    var ikaslePattern = new RegExp(/^[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/i)
    var irakasPattern = new RegExp(/^([a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)|[a-zA-Z]+@ehu\.(eus|es))$/i) //TODO sinplifikatu
    return ikaslePattern.test(email) || irakasPattern.test(email)
}

function luzeraVal(text){
    return text.length>=10
}
function ezHutsaVal(text){
    pattern = new RegExp(/\S+/i)
    return text.length>0 && pattern.test(text).valueOf()
}