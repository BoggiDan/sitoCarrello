<?php
session_start();
// session_destroy();
if (isset($_POST["logout"])) unset($_SESSION["active_login"]); //se attivo il logout (bottone sotto) chiudi la sessione
if (!isset($_SESSION["active_login"])) {
  header("Location: index.php");
  exit();
} // se non è stata attivata la sessione torna alla pagina precedente
if (isset($_POST["procedi"])) {
  header("Location: carrello.php");
  exit();
}
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST["compra"])) {
  if (!isset($_SESSION['carrello']))
    $_SESSION['carrello'] = array();
  $nome = $_POST['compra'];
  $quantita = $_POST['quantita'];
  $_SESSION['carrello'][$nome] = isset($_SESSION['carrello'][$nome]) ? $_SESSION['carrello'][$nome] += $quantita : $quantita;
  // $_SESSION['spesa']+= $_SESSION['carrello'][$nome]['prezzo'];
}
// var_dump($_SESSION);
$user = $_SESSION["active_login"]; //assegna a $user il nome memorizzato
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS-->
  <link rel="stylesheet" href="style.css">

  <!-- Per le icone (menu hamburger e X nel responsive)-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Libri</title>
</head>

<body>
  <nav class="navbar">
    <div class="max">

      <div class="home"><img src="" alt=""><a href="libreria.php"> Libreria Ulisse</a></div>
      <ul class="menu">
        <li>
          <a href="doveSiamo.html"> Dove siamo <br /> </a>
        </li>

        <li>
          <a href="carrello.php"> Carrello <br /> </a>
        </li>
      </ul>
  </nav>

  <div id="titlePrenotazione1">
    PRODOTTI
  </div>

  <?php
  include_once("dati.php");
  // phpinfo();
  $format=function($num){return number_format((float)$num, 2, '.', '');};

  foreach ($libro as $key) {
    $stampa = <<<HTML
        <div class = "container">
            <div class="titolo">$key[titolo]</div>
            <div class="autore">$key[autore]</div>
            <div class="immagine"><img src=$key[foto]></div>
            <div class="genere">$key[genere]</div>
            <div class="descrizione">$key[descrizione]</div>
            <!-- <div class="quantita">$key[quantita]</div> -->
            <div class="prezzo"> <div class = "costo"> Prezzo: {$format($key["prezzo"])}€ </div> <div class = "bottone">

            <form action="" method="post">
                <div id="formAggiungi">
                  <div class="quantita"><input type="number" name="quantita" min="0" max="$key[quantita]" value="0"></div>
                  <label for="compra$key[id]" id="aggiungiProdotto">Aggiungi</label>
                  <input type="submit" id="compra$key[id]" name="compra" value="$key[id]" style="display:none;">
                </div>
            </form>
            
        </div> </div>
        </div>
        HTML;
    echo $stampa;
  }
  ?>

  <!-- <form action="" method="post" id="procedi">
    <input type="submit" id="procedi" name="procedi" value="Procedi">
  </form> -->

  <form action="" method="post" id="UserInfo">
    <input type="submit" id="logout" name="logout" value="Logout">
    <input type="submit" id="procedi" name="procedi" value="Procedi">
  </form>

  <!-- FOOTER -->

  <div class="footer">
    <!-- <p class="scrittaSocial">Social</p> -->
    <div class="social">
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-snapchat"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-facebook-f"></i></a>
    </div>
    <p class="copyright">Copyright by Boggian Daniele</p>
  </div>
</body>

</html>