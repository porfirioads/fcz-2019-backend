// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#dataTable').DataTable({
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
            "zeroRecords": "No hay datos",
            "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrados de un total de _MAX_ registros)",
            "search": "Buscar",
            "paginate": {
                "first": "Primera",
                "last": "&Uacute;ltima",
                "next": "Siguiente",
                "previous": "Anterior"
            },

        }
    });
});
