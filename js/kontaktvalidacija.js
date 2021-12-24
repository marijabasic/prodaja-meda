$(document).ready(function () {
    document.getElementById("sub").addEventListener("click", function () {

        var email = document.getElementById("emailkk").value;
        var naslov = document.getElementById("naslov").value;
        var pitanja = document.getElementById("pitanja").value;
        var remejl = /^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/;
        var renaslov = /^[A-z]+(\s[A-z]*)*$/;
        var repitanje = /^[A-z]+(\s[A-z]*)*$/;
        var greska = new Array();

        if (!renaslov.test(naslov)) {
            greska.push("Naslov je obavezan")
            $("#naslov").css("border-color", "red")
        }
        else { $("#naslov").css("border-color", "") }
        if (!remejl.test(email)) {
            greska.push("Email je obavezan")
            $("#emailkk").css("border-color", "red")
        }
        else { $("#emailkk").css("border-color", "") }
        if (!repitanje.test(pitanja)) {
            $("#pitanja").css("border-color", "red")
            greska.push("Pitanje je obavezno")
        }
        else { $("#pitanja").css("border-color", "") }
        if (greska.length == 0) {
            $.ajax({
                url: "./kontaktobrada.php",
                method: "post",
                data: { email: email, naslov: naslov, pitanja: pitanja, send: true },
                success: function (sve) {
                    alert("Poruka poslata administratoru!");
                }, error: function (xhr, error, status) {
                    $('#greskee').html(status)
                    console.log(xhr, error, status)
                }
            })
        }
    })
})
$("#btnMeni").click(function () {
    $("#nav ul").slideToggle()
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
