$(document).ready(function () {
    $("#kprikaz").click(function () {
        $("#ispiss").toggle()
    })
    $(".izbrisi").click(function () {
        var id = $(this).data('id')
        console.log(id);
        $.ajax({
            method: "POST",
            url: "./admin.php",
            dataType: "json",
            data: {
                id: id
            },
            success: function (podaci) {
                $(".izbrisi").click(function () {
                    console.log("dobro")
                })
            },
            error: function (xhr, srror, status) {
                console.log(xhr.status)
            }
        })
    })
})