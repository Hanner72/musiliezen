// datatables.net
var groupColumn = 5;

$(document).ready(function() {
    var table = $('.datatable').DataTable({
        "lengthMenu": [
            [100, 250, -1],
            [100, 250, "Alle"]
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
                columns: [1,2,3,4,5,6,7,8],
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
        
        // Zeilengruppierung Anfang
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var last = null;
    
            api.column(groupColumn, { page: 'current' })
                .data()
                .each(function (group, i) {
                    if (last !== group) {
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td colspan="10">' +
                                    group +
                                    '.</td></tr>'
                            );
    
                        last = group;
                    }
                });
        }
        // Zeilengruppierung Ende
    });

    // Zeilengruppierung Anfang
    $('#example tbody').on('click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([groupColumn, 'desc']).draw();
        }
        else {
            table.order([groupColumn, 'asc']).draw();
        }
    });
    // Zeilengruppierung Ende
});