// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});


$(document).ready(function() {
  $('#dataTable2').DataTable();
});


if ($.fn.DataTable.isDataTable('#dataTableServicos')) {
    $('#dataTableServicos').DataTable().destroy();
}
