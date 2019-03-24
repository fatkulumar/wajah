<!DOCTYPE html>
<html>
<head>
    <title>Anti Maling</title>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"> -->
    <!-- <script
			  src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous">
    </script> -->
    <!-- <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
        
    <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,800,700,600,300);
    body{
        background-color:#f9f9f9;
        font-size:16px
        color:#444;
        font-family: sans-serif;
    }

    .content{
        width: 80%;
        margin: 10px auto;
    }

    /*header*/
    header{
        background-color: white;
        padding: 20px 10px;
        border-radius: 5px;
        border: 1px solid #f0f0f0;
        margin-bottom: 10px;
    }

    header h1.judul,
    header h3.deskripsi{
        text-align: center;	
    }

    /*menu navigasi*/
    .menu1{
        border: 1px solid #f0f0f0;
        border-radius: 8px;	
    }

    .footer{
        background-color: #87CEFA;
        border: 1px solid #f0f0f0;
        border-radius: 8px;	
        margin-top: 10px;
        text-align:center;
        padding: 20px;
        font-weight: 900;
    }

    .menu{
        background-color: #87CEFA;
        border: 1px solid #f0f0f0;
        border-radius: 8px;	
        margin-bottom: 10px;
        padding-top: 20px;
    }

    div.menu ul {
        list-style:none;
        overflow: hidden;
    }


    div.menu ul li {
        float:left;		
        text-transform:uppercase;
    }

    div.menu ul li a {
        display:block;	
        padding:0 20px;
        text-decoration:none;
        color:#2c2c2c;
        font-family: sans-serif;
        font-size:13px;
        font-weight:400;
        transition:all 0.3s ease-in-out;
    }

    div.menu ul li a:hover,
    div.menu ul li a.hoverover {	
        cursor: pointer;	
        color:#fff;
    }


    div.badan{
        background-color: white;
        border-radius: 5px;
        border: 1px solid #f0f0f0;
        margin-bottom: 10px;
    }

    div.halaman{
        text-align: center;
        padding: 30px 20px;	
    }

    .d{
        margin-right: 90px;

    }
  </style>
</head>
<body>
    
<div style="padding:100px">
	<header>
		<h1 class="judul">WWW.CV-GLOBALSOLUSINDO.COM</h1>
		<h3 class="deskripsi">HADI</h3>
	</header>

	<div class="menu">
		<ul>
			<!-- <li><a href="template.php?page=index">HOME</a></li> -->
			<li><a href="template.php?page=index">HOME</a></li>
			<li><a href="template.php?page=coba_motor">DATA</a></li>
		</ul>
	</div>

	<div class="menu1">
        <?php 
            if(isset($_GET['page'])){
                $page = $_GET['page'];

                switch ($page) {
                    case 'coba_motor':
                    echo '<div class="d">';
                        include $page.".php";
                        break;
                    echo "</div>";

                    case 'index':
                        include $page.".php";
                        break;
                }
            }else{
                include "index.php";
            }
        ?>
	</div>
    <footer class="footer">
        CopyRight@2019 Fatkhul Umar
    </footer>
</div>

</body>
</html>