<?php
setlocale(LC_ALL, "lithuanian");

const DB_HOST = "localhost";
const DB_LOGIN = "root";
const DB_PASSWORD = "";
const DB_NAME = "knygos";

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
mysqli_set_charset($link, "utf8");  

function selectAllItems1(){
    global $link;
    $sql = "SELECT pavadinimas, metai, autorius, zanras FROM knygos WHERE pavadinimas !=''" ;
    if(!$result = mysqli_query($link, $sql))
        return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.min.js"></script>
        <title>Knygos</title>
        <!--<meta charset="utf-8" />-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="inc/style.css" />
    </head>
    <body> 
        <div class="row header">
            <div class="container">
                <div class="col-md-12">
                    <div class="page-header">
                        <!--   Virsutine dalis -->
                        <h1>Knygos</h1>
                        <span class="slogan">Knygų sąrašas</span>
                        <!-- Virsutine dalis -->
                    </div>
                </div>
            </div>     
        </div>
        <div class="container">
            <div class="row">
                <div id="nav" class="col-md-12">
                    <!-- Navigacija -->
                    <nav class="navbar navbar-inverse meniu">
						<div class="container-fluid">
							<ul class="nav navbar-nav">
								<li class="active"><a href="index.php">Knygų sąrašas</a></li>
								<li class="active"><a href="aprasas.php">Knygos aprašas</a></li>
							</ul>
						</div>
					</nav>
                    <!-- Navigacija -->
                </div>
            </div>
        </div>   
        <div class="container">
            <div class="row">
                
                <div id="content" class="col-md-12">
                    <!--  Contentas  -->
                    <div class="table-responsive">
						<table border="1" cellpadding="5" cellspacing="0" width="100%" class="table table-bordered">
							<tr class="success">
								<th>Pavadinimas</th>
								<th>Leidimo metai</th>
								<th>Autorius (-iai)</th>
								<th>Žanras</th>
							</tr>
						<?php
							$goods = selectAllItems1();
							if(!is_array($goods)){
								echo 'Klaida: negalima isvest knygų sąrašaso';
								exit;
							}
							if(!$goods){
								echo 'Nėra knygų';
								exit;
							}
							foreach($goods as $item){
						?>
							<tr class="active">
								<td><a href="aprasas.php?pav=<?=$item['pavadinimas']?>"><?=$item['pavadinimas']?></a></td>
								<td><?=$item['metai']?></td> 
								<td><?=$item['autorius']?></td>
								<td><?=$item['zanras']?></td>
							</tr>
						<?php
							}
						?>
						</table>
					</div>
                    <!-- Contentas -->
                </div>
            </div>
        </div>    
        <!--  Footeris-->
        <div class="container">
            <div id="footer">
                <div class="row">
                </div>
            </div>
        </div>    
        <!--  Footeris-->
    </body>
</html>
