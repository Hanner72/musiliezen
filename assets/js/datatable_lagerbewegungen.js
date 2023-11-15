// datatables.net
var minDate, maxDate;

// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        // var min = minDate.val();
        var min = new Date(minDate.val());
        min.setDate(min.getDate() - 1);
        var max = maxDate.val();
        var date = new Date( data[7] );

        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {

    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MM DD YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MM DD YYYY'
    });

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
                    'height': '80px'
                });
            },
            exportOptions: {
                columns: [1,2,3,4,6,8,9,10,11,12,13,14],
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
            [7, 'desc']
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
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            sumpreis = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            sumausgang = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            sumeingang = api
                .column( 10, { page: 'current'} )
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

            $( "#sumpreis" ).html(
            (sumpreis.toLocaleString('de-AT', {style: 'currency', currency: 'EUR'}))
            );

            $( "#sumeingang" ).html(
            (sumeingang.toLocaleString('de-DE'))
            );

            $( "#sumausgang" ).html(
            (sumausgang.toLocaleString('de-DE'))
            );
        }
    });

    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });

});