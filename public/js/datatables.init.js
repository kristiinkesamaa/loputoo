/*
 Template Name: Upcube - Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Datatable js
 */

$(document).ready(function() {
    $('table.display').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        ordering: false,
        paging: false,
        search: "Otsi...",
        "dom": '<"pull-left"f><"pull-right"l>tip',
        "oLanguage": {
            "sSearch": "Otsi mängijaid:"

        }

    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-12:eq(0)');


} );

