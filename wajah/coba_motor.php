<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <title>Document</title>
</head>
<body>

<div style="padding:100px">
    <table id="myTable" class="table table-striped table-bordered">
        <thead>
            <?php
                $koneksi = mysqli_connect('localhost', 'root', '', 'hadi');
                $sql_k = mysqli_query($koneksi, 'SELECT * FROM kendaraan k JOIN pemilik p ON k.no_plat = p.plat_p');
                while ($data_k = mysqli_fetch_array($sql_k)) :
                    if ($data_k['no_plat'] == $data_k['plat_p']):
            ?>
            <tr>
                <th>No. Plat</th>
                <th>Merek</th>
                <th>Type</th>
                <th>Jenis</th>
                <th>Model</th>
                <th>Tahun</th>
                <th>CC</th>
                <th>No. Rangka/NIK</th>
                <th>No. Mesin</th>
                <th>Tgl FAK</th>
                <th>Bahan Bakar</th>
                <th>Warna TNKB</th>
                <th>No. Pol. Lama</th>
                <th>Kepemilikan</th>
                <th>No. DOK</th>
                <th>Masa STNK</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $data_k['no_plat']; ?></td>
                <td><?= $data_k['merek']; ?></td>
                <td><?= $data_k['type']; ?></td>
                <td><?= $data_k['jenis']; ?></td>
                <td><?= $data_k['model']; ?></td>
                <td><?= $data_k['tahun']; ?></td>
                <td><?= $data_k['cc']; ?></td>
                <td><?= $data_k['no_rangka_nik']; ?></td>
                <td><?= $data_k['no_mesin']; ?></td>
                <td><?= $data_k['tgl_fak']; ?></td>
                <td><?= $data_k['bahan_bakar']; ?></td>
                <td><?= $data_k['warna_tnkb']; ?></td>
                <td><?= $data_k['no.pol_lama']; ?></td>
                <td><?= $data_k['kepemilikan']; ?></td>
                <td><?= $data_k['no_dok']; ?></td>
                <td><?= $data_k['masa_stnk']; ?></td>           
            </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
        </tbody>
    </table>

<script>
        $(document).ready( function () {
        $('#myTable').DataTable(
            {
             "aLengthMenu": [[5, 10], [5,10]],
             "iDisplayLength": 5,
             "aoColumnDefs": [{ "bSortable": false, "aTargets": [  3,4 ] }, 
                { "bSearchable": false, "aTargets": [ 3,4 ] }]
            });
        } );
    </script>

</body>
</html>