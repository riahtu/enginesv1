<script type="text/javascript">
// Meload paket API dari Google Chart
google.load('visualization', '1', {'packages':['corechart']});
// Membuat Callback yang meload API visualisasi Google Chart
google.setOnLoadCallback(drawChart);
function drawChart() {
var json = $.ajax({
url: 'include/json.php', // file json hasil query database
dataType: 'json',
async: false
}).responseText;
// Mengambil nilai JSON
var data = new google.visualization.DataTable(json);
var options = {
title: 'Engine Running Hours',
colors: ['#CD7F32'],
width: 500,
height: 200
};
// API Chart yang akan menampilkan ke dalam div id
var chart = new google.visualization.BarChart(document.getElementById('tampil_chart'));
chart.draw(data, options);
}
</script>