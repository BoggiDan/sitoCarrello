<?php
session_start();
include_once("dati.php");

if (!isset($_SESSION["active_login"])) {
  header("Location: index.php");
  exit();
}

if (isset($_SESSION["carrello"])) {
  $carrello = $_SESSION["carrello"];
}

function getInfoById($id, $data)
{
  foreach ($data as $item) {
      if ($item['id'] === $id) return $item;
  }
  return false;
}

$costoTotaleCarrello=0;

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
  <title>Fattura</title>
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
    FATTURA <br>
    RIEPILOGO ORDINE
  </div>

  <?php
  // var_dump($_SESSION);
  echo <<<HTML
  <div id="storia">
    Salve $_SESSION[fname] $_SESSION[lname], di seguito il riepilogo dell'ordine. <br>
    Le abbiamo mandato inoltre una mail di riepilogo all'indirizzo $_SESSION[email]. <br>
  </div>
HTML;

  $format = function ($num) {
    return number_format((float)$num, 2, '.', '');
  }; //Arrow function, serve per avere due decimali alla fine del prezzo
  if (isset($_SESSION["carrello"])) {
    foreach ($carrello as $key => $nProdotti) {
      $libri = getInfoById($key, $libro);
      if ($libri && $nProdotti > 0) {
        echo <<<HTML
        
                    <div class="divCarrello">
                        <div class="immaginiCarrello">
                            <img src="$libri[foto]" alt="">
                        </div>
                        <div class="titoloCarrello">
                            $libri[titolo] <br> $libri[autore] 
                        </div>
                        <div class="quantitaCarrello">
                            Quantità: <br> <p class="spazio">$nProdotti</p>
                        </div>
                        <div class="prezzoCarrello">
                            Prezzo: <br> <p class="spazio">{$format($libri["prezzo"])}€</p>
                        </div>
                    </div>
                HTML;
      }
      $costoTotaleCarrello += $libri["prezzo"] * $nProdotti;
    }
  } else {
    echo <<<HTML
        <div id="carrelloVuoto">
            Vuoto
        </div>
        HTML;
  }
  ?>

  <p id="prezzoTot">
    Prezzo totale: <?= $format($costoTotaleCarrello) ?>€
  </p>

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