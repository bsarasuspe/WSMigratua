function AddLikeAjax(id) {
    $.ajax({
        url: '../php/AddLike.php?',
        data: {galdera_id: id},
        type: POST,
        success: function (res) {
            $("#bozkatu").html("Ongi bozkatu duzu!");
        },
        error: function (err) {
            $("#bozkatu").html("Errore bat gertatu da bozkatzean!");
        }
    });
}