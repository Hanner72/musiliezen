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
            text: 'drucken', footer: true,
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
                columns: [1,2,3,4,5,6],
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
            {
                "targets": [0],
                "visible": false
            }
        ],
        order: [
            [2, 'asc']
        ],

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\€,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            lagerwert = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            /* $( api.column( 23 ).footer() ).html(
                '€ '+sumeingang +' ( € '+ total +' total)'
            ); */

            /* $( "#myTotal" ).html(
            '€ '+(sumeingang.toLocaleString('de-DE')) +' ( € '+ (total.toLocaleString('de-DE')) +' Gesamt)'
            ); */

            $( "#lagerwert" ).html(
            (lagerwert.toLocaleString('de-DE', {style: 'currency', currency: 'EUR'}) +'<br>' + total.toLocaleString('de-DE', {style: 'currency', currency: 'EUR'}))
            );
        }
    });
});

$(document).ready(function() {
    var table = $('.datatable_th').DataTable({
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
            text: 'drucken', footer: true,
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
                columns: [1,2,3,4,5,6],
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
            {
                "targets": [0],
                "visible": false
            }
        ],
        order: [
            [2, 'asc']
        ],
        select: true,
        stateSave: true,
        stateDuration: -1, // -1 für Session, sonst Zahl für Sekunden inkl Berechnung 60*60*24 = 1
        /* colReorder: true, */ //bei Bearbeitung der Datensätze über Modal nicht gut

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\€,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            lagerwert = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            /* $( api.column( 23 ).footer() ).html(
                '€ '+sumeingang +' ( € '+ total +' total)'
            ); */

            /* $( "#myTotal" ).html(
            '€ '+(sumeingang.toLocaleString('de-DE')) +' ( € '+ (total.toLocaleString('de-DE')) +' Gesamt)'
            ); */

            $( "#lagerwert_th" ).html(
            (lagerwert.toLocaleString('de-DE', {style: 'currency', currency: 'EUR'}) +'<br>' + total.toLocaleString('de-DE', {style: 'currency', currency: 'EUR'}))
            );
        }
    });
});