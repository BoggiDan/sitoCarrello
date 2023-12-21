<?php
session_start();
if (isset($_POST["logout"])) unset($_SESSION["active_login"]); //se attivo il logout (bottone sotto) chiudi la sessione
if (!isset($_SESSION["active_login"])) header("Location: index.php"); // se non è stata attivata la sessione torna alla pagina precedente
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
    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <div class="max">

            <div class="home"><img src="" alt=""><a href="index.php"> Libreria </a></div>
            <ul class="menu">
                <li>
                    <a href="doveSiamo.html"> Dove siamo <br /> </a>
                </li>

                <li>
                    <a href="index.php"> Carrello <br /> </a>
                </li>
            </ul>
    </nav>
    
    <form action="" method="post" id="UserInfo">
        <input type="submit" id="logout" name="logout" value="Logout">
    </form>
</body>

</html>