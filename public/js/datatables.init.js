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
        buttons: ['print', 'excel', 'pdf']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');


} );

$(document).ready(function() {
    $('table.display').DataTable();

//Buttons examples
    var table = $('#datatable-buttons-results').DataTable({
        lengthChange: false,
        ordering: false,
        buttons: ['print', 'excel', 'pdf']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons-results_wrapper .col-md-6:eq(0)');




} );
