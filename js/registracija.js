$(document).ready(function () {

    $("#dugmeRegistracija").click(function () {

        var formareg00 = document.getElementsByClassName("formareg")[0].value
        var formareg11 = document.getElementsByClassName("formareg")[1].value
        var formareg22 = document.getElementsByClassName("formareg")[2].value
        var formareg33 = document.getElementsByClassName("formareg")[3].value
        var formareg0 = document.getElementsByClassName("formareg")[0]
        var formareg1 = document.getElementsByClassName("formareg")[1]
        var formareg2 = document.getElementsByClassName("formareg")[2]
        var formareg3 = document.getElementsByClassName("formareg")[3]
        var reformareg0 = /^[A-ZČĆŠĐŽ][a-zčćšđž]{2,9}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,14})+$/;
        var reformareg1 = /^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
        var reformareg2 = /[A-z]+[0-9]+/;
        var greske = new Array();
        var dobro = new Array();


        if (formareg0.value == "") {
            greske.push("Ime i prezime je obavezno!");
            formareg0.style.borderColor = "red"
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
        var rr = document.getElementsByClassName("radio")
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
        if (greske.length == 1) {
            document.getElementById("dugmeRegistracija").style.marginTop = "26px"
        }
        if (greske.length == 2) {
            document.getElementById("dugmeRegistracija").style.marginTop = "40px"
        }
        if (greske.length == 3) {
            document.getElementById("dugmeRegistracija").style.marginTop = "54px"
        }
        if (greske.length == 4) {
            document.getElementById("dugmeRegistracija").style.marginTop = "70px"
        }
        if (greske.length == 5) {
            document.getElementById("dugmeRegistracija").style.marginTop = "84px"
        }
        if (greske.length == 0) {
            $.ajax({
                url: "./obrada.php",
                method: "post",
                data: {
                    ime: formareg00,
                    posta: formareg11,
                    lozinka: formareg22,
                    lozinkap: formareg33,
                    rad: radiob
                },
                success: function (data) {
                    console.log(1)
                    console.log(data)
                    poruka = "Uspesno ste se registrovali!";
                    document.getElementById("ispis").innerHTML = poruka;
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
                    document.getElementById("ispis").innerHTML = poruka;
                }
            })
        }
        else {
            var ispis = "<ul>";
            for (var i = 0; i < greske.length; i++) {
                ispis += "<li>" + greske[i] + "</li>";
            }
            ispis += "</ul>";
        }
        document.getElementById("ispis").style.display = "block";
        document.getElementById("ispis").innerHTML = ispis;
    })
})
$(document).ready(function () {
    slideShow();
});
function slideShow() {
    var trenutni = $('#slajder .aktivna');
    var next = trenutni.next().length ? trenutni.next()
        : trenutni.parent().children(':first');
    trenutni.hide().removeClass('aktivna');
    next.fadeIn().addClass('aktivna');
    setTimeout(slideShow, 4000);
}

