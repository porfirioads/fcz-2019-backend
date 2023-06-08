$(document).ready(function () {
    $('.btn-delete-event').click(function () {
        var formRoute = $(this).data('form-route');
        $('#confirmEventDeleteModal').find('form').attr('action', formRoute);
    });
});
