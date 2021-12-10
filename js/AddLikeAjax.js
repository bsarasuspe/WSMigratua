function AddLikeAjax(id) {
    $.ajax({
        url: '../php/AddLike.php?galdera_id='+id,
        metod: 'GET',
        processData: false,
        contentType: false,
        cache: false,
        success: function (res) {
            $("#bozkatu").html("<p style='color:green;'>Ongi bozkatu duzu!</p>");
        },
        error: function (err) {
            $("#bozkatu").html("<p style='color:red;'>Errore bat gertatu da bozkatzean!</p>");
        }
    });
}