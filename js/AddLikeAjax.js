function AddLikeAjax(id) {
    alert("proba");
    $.ajax({
        url: '../php/AddLike.php',
        data: {galdera_id: id},
        type: GET,
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            $("#bozkatu").html("Ongi bozkatu duzu!");
        },
        error: function (err) {
            $("#bozkatu").html("Errore bat gertatu da bozkatzean!");
        }
    });
}