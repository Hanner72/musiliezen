// datatables.net

$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "lengthMenu": [
            [25, 50, -1],
            [25, 50, "Alle"]
        ],
        /* "dom": 'lBfrtip', */ //Formatierung
        "dom": "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "buttons": [{
            extend: 'print',
            text: 'drucken',
            customize: function ( win ) {
                $(win.document.body)
                    .css( 'font-size', '14pt' );
                $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' );
                $(win.document.body).find('img').css({
                    'width': 'auto',
                    'height': '100px'
                });
            },
            exportOptions: {
                columns: [1,2,3,4,5],
                stripHtml: false
            },
            className: 'btn btn-primary mt-2'
        }],
        "language": {
            "emptyTable": "Keine Daten in Tabelle vorhanden",
            "zeroRecords": "Keine passenden Einträge gefunden",
            "lengthMenu": "Zeige _MENU_ Einträge pro Seite",
            "info": "Zeige Seite _PAGE_ von _PAGES_ (_TOTAL_ Einträge gesamt)",
            /* "info":           "Zeige _START_ bis _END_ von _TOTAL_ Einträgen", */
            "infoEmpty": "Keine Einträge Verfügbar",
            "search": "Suche:",
            "infoFiltered": "(gefiltert von _MAX_ Einträgen)",
            "paginate": {
                "first": "Erste",
                "last": "Letzte",
                "next": "Nächste",
                "previous": "Vorige"
            },
        },
        "columnDefs": [ // Spalten ausblenden
            { "targets": [0], "visible": false }
        ],
        order: [
            [2, 'asc']
        ],
        select: true,
        stateSave: true,
        stateDuration: -1, // -1 für Session, sonst Zahl für Sekunden inkl Berechnung 60*60*24 = 1
        /* colReorder: true, */ //bei Bearbeitung der Datensätze über Modal nicht gut
    });
});