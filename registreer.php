<?php
include("cnnfietsgraveer.php");
include("algemeen.php");

$maanden = array("januari","februari","maart","april","mei","juni","juli","augustus","september","oktober","november","december");

$weekdagen = array("maandag","dinsdag","woensdag","donderdag","vrijdag","zaterdag","zondag");

$show = "formulier";

/*REGISTRATIE FIETSGRAVEER*/
if(isset($_POST['btnRegistreer']))
{
  $show = "feedback";
  $letters= array ('a','b','c','d','e','f','g','h','i','j','k','m','n','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');  

  $fnaam = $_POST['txtFamilienaam'];
  $voornaam = $_POST['txtVoornaam'];
  $tel = $_POST['txtTelefoon'];
  $mail = $_POST['txtEmail'];
  $plaats = $_POST['optPlaats'];
  $ipadres = $_SERVER['REMOTE_ADDR'];
  $regdat = date("Y-m-d");
  $aantal = count($letters)-1;

  /*genereren regcode*/
  $regcode = "";
  $regcode = $letters[rand(0, $aantal)]; 
  $regcode .= $letters[rand(0, $aantal)]; 
  $regcode .= rand(1000000, 9999999);
  $regcode .= $letters[rand(0, $aantal)]; 
  $regcode .= $letters[rand(0, $aantal)]; 

  $sqlreg = "insert into tblregistratie (fnaam, voornaam, telefoon, email, plaats, IPadres, tijdreg, regcode) value ('$fnaam', '$voornaam', '$tel', '$mail', $plaats, '$ipadres', '$regdat', '$regcode')";

  $db -> query($sqlreg) or die(mysql_error()); 

  /*feedback naar gebruiker */
  $bevestiging =  "Bedankt voor uw registratie, $voornaam<br>";
  $dagnl = $weekdagen[date("N",strtotime($regdat))-1];
  $bevestiging .= "Je bent geregistreed op $dagnl";
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
            <h1>Registreer je fietsgravure</h1>


            <?php
            if($show=="formulier"){

            
            ?>

            <form id="form1" name="form1" method="post" action="">
              <fieldset><legend>Persoonlijke gegevens</legend>
                <table width="800" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Familienaam</td>
                    <td><input name="txtFamilienaam" type="text" required /></td>
                    <td>Voornaam</td>
                    <td><input name="txtVoornaam" type="text" required  /></td>
                  </tr>
                  <tr>
                    <td>Telefoon</td>
                    <td><input name="txtTelefoon" type="text"  required /></td>
                    <td>E-mailadres</td>
                    <td><input name="txtEmail" type="text" required  /></td>
                  </tr>
                </table>
              </fieldset><br />
              <fieldset><legend>Kies je graveerplaats</legend>
                <table width="800" border="0" cellspacing="0" cellpadding="0"> 
                  <tr>
                    <?php 
                    
                      $sqlplaats = "select graveerID, gemeente from tblplaatsen order by gemeente";
                      $resultplaats = $db->query($sqlplaats);

                      $teller = 0;
                      while($rowplaats = $resultplaats->fetch_assoc())      
                      {
                        $graveerid = $rowplaats['graveerID'];
                        $gemeente = $rowplaats['gemeente'];
                        
                        $teller++;
                        echo "<td><input type='radio' name='optPlaats' value='$graveerid'required> $gemeente</td>\n";
                        
                        if($teller % 5 == 0){
                          echo"</tr><tr>";
                        }
                      }        
                    ?>
                  </tr>
                </table>
              </fieldset>
              <p class="bericht"></p>
              <input name="btnRegistreer"  type="submit" id="btnRegistreer" value="Registreer je fietsgravure" />
            </form>

            <?php 
            
            }
            else if($show=="feedback")
            {
              echo $bevestiging;
            }
            
            
            ?>

            <p>&nbsp;</p>
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
