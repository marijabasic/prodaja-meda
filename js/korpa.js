$(document).ready(function () {
    let products = proizvodUKorpi();
    displayCartData();
});
function displayCartData() {
    let products = proizvodUKorpi();
    $.ajax({
        url: "./proizvodi.php",
        dataType: "json",
        success: function (data) {
            let productsForDisplay = [];
            data = data.filter(p => {
                for (let prod of products) {
                    if (p.idProizvod == prod.id) {
                        p.quantity = prod.quantity;
                        return true;
                    }
                }
                return false;
            });
            generateTable(data)
        }
    })
}
function generateTable(data) {
    var ispis = `<table id='korpatab' border="1px solid black">
        <thead><tr>
        <th>Redni broj</th>
        <th>Slika</th>
        <th>Vrsta</th>
        <th>Cena</th>
        <th>Kolicina</th>
        <th>Odustani</th>
        <th>Kupi</th>
        </tr><thead>`
    var br = 1
    for (let i of data) {
        ispis += `<tr><td>${br}</td><td><img
            src='${i.path}'class='slikakorpa'/></td>
            <td>${i.naziv}</td>

            <td>${i.cena * i.quantity}</td>
            <td class='kolicina' data-id=${i.idProizvod}>${i.quantity}</td>
            <td><a href="#" onclick='removeFromCart(${i.idProizvod})'id='kbrisi'>Obrisi</a></td>
            <td><a href="korpaprikaz.php" id='kkupi' class="a" data-id=${i.idProizvod}>Kupi</a></td>`;
        br++
    }
    ispis += "</tr></table>"
    document.getElementById("sadrzajjj").innerHTML = ispis;
}
$("#sadrzajjj").on("click", ".a", function () {
    var x = document.getElementsByClassName("kolicina")
    var ccc = JSON.parse(localStorage.getItem("products"))
    for (var ff of ccc) {
        var id = $(this).data("id")
        if (ff.id == id) {
            var z = ff.id
            kol = ff.quantity
        }
    }

    $.ajax({
        url: "./korpaprikaz.php",
        method: "post",
        data: {
            id: id,
            kolicina: kol
        },
        dataType: "json",
        success: function (sve) {
            console.log(sve)
        },
        error: function(xhr, status, error) {
            console.log(error)
        }
    })
})
function proizvodUKorpi() {
    return JSON.parse(localStorage.getItem("products"));
}
function removeFromCart(id) {
    let products = proizvodUKorpi();
    let filtered = products.filter(p => p.id != id);
    localStorage.setItem("products", JSON.stringify(filtered));
    displayCartData();
}
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
