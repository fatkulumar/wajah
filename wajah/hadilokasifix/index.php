<!DOCTYPE html>
<html>
<head>
	<title>Lokasi</title>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- <script
			  src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous">
    </script> -->
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>

<script>
//  setTimeout('location.href="index.php"' ,4000);
</script>

<p><span id="lokasi"></span></p>

<script type="text/javascript">
	$(document).ready(function() {
		if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (position) {
				tampilLokasi(position);
		}, function (e) {
		    alert('Geolocation Tidak Mendukung Pada Browser Anda');
		}, {
		    enableHighAccuracy: true
		});
		}
	});
	function tampilLokasi(posisi) {
        //console.log(posisi);
        var foto = 'foto';
		var latitude 	= posisi.coords.latitude; //bisa diisi sesuai kemauan
		var longitude 	= posisi.coords.longitude; //bisa diisi sesuai kemauan
		$.ajax({
			type 	: 'POST',
			url		: '../index.php',
			data 	: 'latitude='+latitude+'&longitude='+longitude+'&foto='+foto,
			success	: function (e) {
				if (e) {
					$('#lokasi').html(e);
				}else{
					$('#lokasi').html('Tidak Tersedia');
				}
			}
		})
	}
</script>
</body>
</html>