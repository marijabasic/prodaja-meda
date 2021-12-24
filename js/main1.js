$(document).ready(function () {
    function proizvodUKorpi() {
        return JSON.parse(localStorage.getItem("products"));
    }
    $("#sredina2").on("click", ".kupi", function () {
        var id = $(this).data("id")
        console.log(id)
        var products = proizvodUKorpi();
        if (products) {
            if (productIsAlreadyInCart()) {
                updateQuantity();
            } else {
                addToLocalStorage()
            }
        } else {
            addFirstItemToLocalStorage();
        }
        alert("Proizvod ste dodali u korpu!");
        function productIsAlreadyInCart() {
            return products.filter(p => p.id == id).length;
        }
        function addToLocalStorage() {
            let products = proizvodUKorpi();
            products.push({
                id: id,
                quantity: 1
            });
            localStorage.setItem("products", JSON.stringify(products));
        }
        function updateQuantity() {
            let products = proizvodUKorpi();
            for (let i in products) {
                if (products[i].id == id) {
                    products[i].quantity++;
                    break;
                }
            }
            localStorage.setItem("products", JSON.stringify(products));
        }
        function addFirstItemToLocalStorage() {
            let products = [];
            products[0] = {
                id: id,
                quantity: 1
            }
            localStorage.setItem("products", JSON.stringify(products));
        }
    })
    $("#iks").click(function () {
        $("#proizvod").css({ "display": "none" })
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