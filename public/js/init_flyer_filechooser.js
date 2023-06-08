$(document).ready(function () {
    $('#tarjeta_frontal').on('change', function () {
        var fileName = $(this).val();
        if (fileName) {
            $(this).next('.custom-file-label').html(fileName);
        } else {
            $(this).next('.custom-file-label').html('Seleccionar archivo');
        }
    })

    $('#tarjeta_trasera').on('change', function () {
        var fileName = $(this).val();
        if (fileName) {
            $(this).next('.custom-file-label').html(fileName);
        } else {
            $(this).next('.custom-file-label').html('Seleccionar archivo');
        }
    })
});
