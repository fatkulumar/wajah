<?php
include 'FaceDetector.php';
$detector = new svay\FaceDetector('detection.dat');
echo $adawajah = ($detector->faceDetect('sample.jpg') > 0 ? 'Ada Wajah' : 'Tidak Ada');
if ($detector->faceDetect('sample.jpg') > 0) {
    $umar = $detector->toJpeg();
    $name = $detector->getName();

    //$detector = new svay\FaceDetector('detection.dat');
    //$detector->faceDetect('agnes.jpg');
    //$umar = $detector->toJpeg();
    //header('Content-type: image/jpeg');
    // echo '<img src="http://192.168.100.120/umar/hadi/wajah/wajah/cache.jpg"></img>';

    $koneksi = mysqli_connect('localhost', 'root', '', 'hadi');
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $foto = $_POST['foto'];
    $link = "https://www.google.co.id/maps/place/7%C2%B056'46.9%22S+112%C2%B036'48.0%22E/@-7.9442466,112.6092563,15z/data=!4m5!3m4!1s0x0:0x0!8m2!3d$latitude,$longitude";
    echo '<center>';
    // echo $foto.'<br>';
    // echo 'Latitude :'.$latitude.'<br>';
    // echo 'Longitude :'.$longitude.'<br>';
    echo '<input style="width:250px" type="text" value="'.$latitude.','.$longitude.'" id="myInput">
        <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            document.execCommand("copy");
            alert("Letakkan Digoogle maps: " + copyText.value);
        }
        </script>
    <button onclick="myFunction()">Copy</button>.<br>';
    // echo '<a href="'.$link.'" target="_blank">Yuk cari</a>';
    echo '</center>';
    if (!empty($latitude) && !empty($longitude)) {
        $gmap = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.$longitude.'&sensor=false';
        // curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $gmap);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        // end curl
        $data = json_decode($response);
        $eks = 'jpg';
        $ekstensi = explode('.', $eks);
        // $file_name = "file-".round(microtime(true)).".".end($ekstensi);
        $file_name = $name;
        // $file_name = 'file-1552285922.jpg';
        $sumber = $foto;
        $target_dir = '../file/';
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);
        // -----------------------------------------------------------------

        // $fields_string = '';
        // $fields = array(
        //                         'api_key' => '65b68866',
        //                         'api_secret' => 'VDmjSVfQchmcdw7H',
        //                         'to' => '+6285872951848',
        //                         'from' => 'Developer',
        //                         'text' => '$link',
        //     );
        // $url = 'https://rest.nexmo.com/sms/json';
        // echo 'sms berhasil';
        // url-ify the data for the POST
        // foreach ($fields as $key => $value) {
        //     $fields_string .= $key.'='.$value.'&';
        // }
        // rtrim($fields_string, '&');

        //open connection
        // $ch = curl_init();

        //set the url, number of POST vars, POST data
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, count($fields));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        // $result = curl_exec($ch);
        //close connection
        // curl_close($ch);

        //echo '<pre>';
        // print_r($result);
        //echo '</pre>';
        //echo '<br>';
        // echo $link;
        $id_terakhir = mysqli_query($koneksi, 'SELECT * FROM data WHERE id IN ( SELECT MAX(id) FROM data)');
        $data = mysqli_fetch_array($id_terakhir);
        // echo $data['id'];

        $id_terakhir = mysqli_query($koneksi, 'SELECT * FROM data WHERE id IN ( SELECT MAX(id-1) FROM data)');
        $data = mysqli_fetch_array($id_terakhir);
        // echo $data['id'];

        // --------------------------------------------------------------------

        // Account details
        $apiKey = urlencode('eXcSPlDKy5E-omUe02AlR1NV61sQc7UZnLxWNKmwfC');

        // Message details
        $numbers = urlencode('6285872951848, 6281931898127');
        $sender = urlencode('Penyusup');
        $message = rawurldecode($link);

        // Prepare data for POST request
        $data = 'apikey='.$apiKey.'&numbers='.$numbers.'&sender='.$sender.'&message='.$message;

        // Send the GET request with cURL
        $ch = curl_init('https://api.txtlocal.com/send/?'.$data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Process your response here
        //echo $response."\n";
        //echo $message;

        // ================================================================
        $sql = "INSERT INTO `data`(`latitude`, `longitude`, `foto`) VALUES('$latitude', '$longitude', '$file_name')";
        $query = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    // echo json_encode($data->results[0]->formatted_address);
    } else {
        echo json_encode(false);
    }
}

 ?>

   <table id="myTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Latitude</th>
                <th>Langitude</th>
                <th>Image</th>
                <th>URL</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // $koneksi = mysqli_connect('localhost', 'root', '', 'hadi');
            $ft = mysqli_query($koneksi, 'SELECT * FROM data WHERE foto = "$tglnow"');
            $sql = mysqli_query($koneksi, 'SELECT * FROM data');
            while ($data = mysqli_fetch_array($sql)):
        ?>
            <tr>
                <td><?= $data['id']; ?></td>
                <td><?= $data['latitude']; ?></td>
                <td><?= $data['longitude']; ?></td>
                <td>
                    <?php echo '<img height=130px src=http://<?php echo $_SERVER["SERVER_NAME"]; ?>/wajah/original/'.$data['foto'].'>'; ?>
                </td>
                <td><a href="https://www.google.co.id/maps/place/7%C2%B056'46.9%22S+112%C2%B036'48.0%22E/@-7.9442466,112.6092563,15z/data=!4m5!3m4!1s0x0:0x0!8m2!3d<?=$data['latitude'],$data['longitude']; ?>" target="_blank">Click Me</a></td>
                <td><?= $data['foto']; ?></td>

            </tr>
        <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Image</th>
                <th>URL</th>
                <th>Waktu</th>
            </tr>
        </tfoot>
    </table>
</div>
    <div style="width:100%;background-color:; padding-top:100px"> </div>


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

