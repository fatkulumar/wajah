<?php 
    $koneksi = mysqli_connect('localhost', 'root', '', 'hadi');
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $foto = $_POST['foto'];
    $link = "https://www.google.co.id/maps/place/7%C2%B056'46.9%22S+112%C2%B036'48.0%22E/@-7.9442466,112.6092563,15z/data=!4m5!3m4!1s0x0:0x0!8m2!3d$latitude,$longitude";
    echo '<center>';
    echo $foto.'<br>';
    echo 'Latitude :'.$latitude.'<br>';
    echo 'Longitude :'.$longitude.'<br>';
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
    echo '<a href="'.$link.'" target="_blank">Yuk cari</a>';
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
        $file_name = 'file-1552285922.jpg';
        $sumber = $foto;
        $target_dir = '../file/';
        $target_file = $target_dir.$file_name;
        $upload = move_uploaded_file($sumber, $target_file);
        // -----------------------------------------------------------------

        $fields_string = '';
        $fields = array(
                                'api_key' => '65b68866',
                                'api_secret' => 'VDmjSVfQchmcdw7H',
                                'to' => '+6285872951848',
                                'from' => 'Developer',
                                'text' => "$link",
            );
        $url = 'https://rest.nexmo.com/sms/json';

        // url-ify the data for the POST
        foreach ($fields as $key => $value) {
            $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
        echo '<br>';
        echo $link;
        $id_terakhir = mysqli_query($koneksi, 'SELECT * FROM data WHERE id IN ( SELECT MAX(id) FROM data)');
        $data = mysqli_fetch_array($id_terakhir);
        echo $data['id'];

        $id_terakhir = mysqli_query($koneksi, 'SELECT * FROM data WHERE id IN ( SELECT MAX(id-1) FROM data)');
        $data = mysqli_fetch_array($id_terakhir);
        echo $data['id'];

        // --------------------------------------------------------------------

        $sql = "INSERT INTO `data`(`latitude`, `longitude`, `foto`) VALUES('$latitude', '$longitude', '$file_name')";
    // $query = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
            // echo json_encode($data->results[0]->formatted_address);
    } else {
        echo json_encode(false);
    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    $koneksi = mysqli_connect('localhost', 'root', '', 'hadi');
    $id_terakhir = mysqli_query($koneksi, 'SELECT * FROM data WHERE id IN ( SELECT MAX(id) FROM data)');

    $data = mysqli_fetch_array($id_terakhir);
    $ft = $data['foto'];
?>

<center><br>
    Foto Asli
    <div>
        <img src="file/<?= $ft; ?>" alt="Foto Kehilangan Tidak Ada" srcset="Foto Kehilangan Tidak Ada">
    </div><br>
    Perbesar
    <div>
      <img class="tengah1" src="file/<?= $ft; ?>" alt="Foto Kehilangan Tidak ada" srcset="Foto Kehilangan Tidak Ada">
    </div>
</center>



    

</body>
</html>

<?php
//     $fields_string  =   "";
//     $fields     =   array(
//                         'api_key'       =>  '65b68866',
//                         'api_secret'    =>  'VDmjSVfQchmcdw7H',
//                         'to'            =>  '+6285872951848',
//                         'from'          =>  "Developer",
//                         'text'          =>  "Testing SMS Dari Nexmo"
//     );
//     $url        =   "https://rest.nexmo.com/sms/json";

//     //url-ify the data for the POST
// foreach($fields as $key=>$value) {
//         $fields_string .= $key.'='.$value.'&';
//         }
// rtrim($fields_string, '&');

//     //open connection
// $ch = curl_init();

// //set the url, number of POST vars, POST data
// curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch,CURLOPT_POST, count($fields));
// curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

// //execute post
// $result = curl_exec($ch);
// //close connection
// curl_close($ch);

//     echo "<pre>";
//     print_r($result);
//     echo "</pre>";
?>

