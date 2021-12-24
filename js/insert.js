$(document).ready(function () {
    $("#btnMeni").click(function () {
        $("#nav ul").slideToggle()
    })
    $("#insert").click(function () {
        var formareg00 = document.getElementsByClassName("finsert")[0].value
        var formareg11 = document.getElementsByClassName("finsert")[1].value
        var formareg22 = document.getElementsByClassName("finsert")[2].value
        var formareg33 = document.getElementsByClassName("finsert")[3].value
        var formareg0 = document.getElementsByClassName("finsert")[0]
        var formareg1 = document.getElementsByClassName("finsert")[1]
        var formareg2 = document.getElementsByClassName("finsert")[2]
        var formareg3 = document.getElementsByClassName("finsert")[3]
        var reformareg0 = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,9}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,14})+$/;
    var reformareg1 = /^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
    var reformareg2 = /[A-z]+[0-9]+/;
    var lista = document.getElementById("lista");
    var greske = new Array();
    var dobro = new Array();
    if (formareg0.value == "") {
        greske.push("Ime i prezime je obavezno!"); formareg0.style.borderColor = "red"
    }
    else if (!reformareg0.test(formareg0.value)) {
        greske.push("Greska - ime i prezime!");
        formareg0.style.borderColor = "red"
    }
    else {
        formareg0.style.borderColor = ""
    }
    if (formareg1.value == "") {
        greske.push("E-mail je obavezan!"); formareg1.style.borderColor = "red"
    }
    else if (!reformareg1.test(formareg1.value)) {
        greske.push("Greska - E-mail!");
        formareg1.style.borderColor = "red"
    }
    else {
        formareg1.style.borderColor = ""
    }
    if (formareg2.value == "") {
        greske.push("Lozinka je obavezna!"); formareg2.style.borderColor = "red"
    }
    else if (!reformareg2.test(formareg2.value)) {
        greske.push("Greska - Lozinka");
        formareg2.style.borderColor = "red"
    }
    else {
        formareg2.style.borderColor = ""
    }
    if (formareg3.value != formareg2.value) {
        greske.push("Greska - Lozinka Ponovo");
        formareg3.style.borderColor = "red"
    }
    else {
        formareg3.style.borderColor = ""
    }
    if (lista.selectedIndex == 0) {
        greske.push("izaberite ulogu");
    }
    else {
        var x = lista.options[lista.selectedIndex].value
    }
    var rr = document.getElementsByClassName("radioi")
    var marker = false
    for (var i = 0; i < rr.length
        ; i++) {
        if (rr[i].checked) {
            marker = true
            var radiob = rr[i].value;
            break;
        }
    }
    if (marker == false) {
        greske.push("Greska - Niste izabrali pol");
    }
    if (greske.length == 0) {
        $.ajax({
            url: "./admin.php",
            type: "post",
            data: {
                imei: formareg00,
                postai: formareg11,
                lozinkai: formareg22,
                lozinkapi: formareg33,
                radi: radiob,
                uloge: x
            },
            success: function (data, xhr) {
                alert("Uspesno ste dodali nalog!");
            },
            error: function (xhr, error, status) {
                var poruka = "Doslo je do greske";
                switch (xhr.status) {
                    case 404:
                        poruka = "Stranica ne postoji!";
                        break;
                    case 409:
                        poruka = "Email vec postoji!";
                        break;
                }
            }
        }
        )
    }
})})