<?php include("cnnFietsgraveer.php");
include("algemeen.php");

$sql = "select * from tblplaatsen order by gemeente";
$result = $db->query($sql);

$teller = 1;
while($row = $result->fetch_assoc())
{
    $gemeente = $row['gemeente'];
    $locatie = $row['locatie'];
    $adres = $row['adres'];
    $datum = date("j F Y", strtotime($row['datum']));
    $uur = $row['uur'];

    $output .= "<tr ";
    if($teller % 2 == 0)
    {
        $output .= "class='onpaar'>";
    }
    else
    {
        $output .= "class='paar'>";
    }
    $output .= "<td>$gemeente</td><td>$locatie</td><td>$adres</td><td>$datum</td><td>$uur</td></tr>\n";

    $teller++;
}







?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Brugge - Fietsstad</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/ddv.css" rel="stylesheet">    
<style type="text/css">
		
</style>
</head>
<body>
    <?php include("inc_nav.php");?>
        <div class="container ddvnopad">
            <?php include("inc_banner.php");?>
        </div>
        <div class="container">
            <div class="row">
   	            <div class="col-md-9">
   	                <h1>Overzicht fietsgraveeractie voorjaar 2023</h1>
                    <p>U kunt op &eacute;&eacute;n van volgende locaties terecht voor het graveren van je fiets. Vergeet je niet op voorhand in te schrijven. Kies daarvoor het menu <strong>Registreer</strong>.</p> 
                    <table id ="prodlijst" class="table">	
                        <tr class='onpaar'><td><strong>Gemeente</strong></td><td><strong>Locatie</strong></td><td><strong>Adres</strong></td><td><strong>Datum</strong></td><td><strong>Uur</strong></td></tr>
                        
                        <?php echo $output;?>
                    </table>
                </div>
                <div class="col-md-3">
                    <h2>Brugge - fietsende stad</h2>
                    <?php include("inc_aside.php");?>
                </div>
            </div>
            <div class="row footerback">
	            <?php include("inc_footer.php");?>
            </div>  

	    </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
        <script src="js/jquery-1.11.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed --> 
        <script src="js/bootstrap.js"></script>
</body>
</html>
