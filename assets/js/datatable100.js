// datatables.net

$(document).ready(function() {
  var table = $('.datatable').DataTable({
      "lengthMenu": [[100,200,-1], [100,200,"Alle"]],
      /* "dom": 'lBfrtip', */ //Formatierung
      "dom": "<'row'<'col-sm-12 col-md-6'lB><'col-sm-12 col-md-6'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      "buttons": [
        {
        extend: 'print',
        text: 'drucken',
        className: 'btn btn-primary'
        }
      ],
      "language": {
        "emptyTable":     "Keine Daten in Tabelle vorhanden",
        "zeroRecords":    "Keine passenden Einträge gefunden",
        "lengthMenu": "Zeige _MENU_ Einträge pro Seite",
        "info": "Zeige Seite _PAGE_ von _PAGES_ (_TOTAL_ Einträge gesamt)",
        /* "info":           "Zeige _START_ bis _END_ von _TOTAL_ Einträgen", */
        "infoEmpty": "Keine Einträge Verfügbar",
        "search":         "Suche:",
        "infoFiltered": "(gefiltert von _MAX_ Einträgen)",
        "paginate": {
            "first":      "Erste",
            "last":       "Letzte",
            "next":       "Nächste",
            "previous":   "Vorige"
        },
      }, 
      "columnDefs": [  // Spalten ausblenden
        {
            "targets": [0],
            "visible": false
        }
      ]
    });
  } );
