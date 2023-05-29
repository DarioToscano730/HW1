<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>

  <?php 
    // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
    $userid = mysqli_real_escape_string($conn, $userid);
    $query = "SELECT * FROM users WHERE id = $userid";
    $res_1 = mysqli_query($conn, $query);
    $userinfo = mysqli_fetch_assoc($res_1);   
  ?>

  <head>
    <title>Musity</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="home.js" defer="true"></script>
  </head>
  
  <body>
    <div id="overlay" class="hidden">
    </div>
    <header>
      <nav>
        <div id="logo">
          Catania SSD
        </div>
        <div id="links">
          <a>HOME</a>
          <a>Biglietteria</a>
          <a>News</a>
          <div id="separator"></div>
          <a href='profile.php'>PROFILO</a>
          <a href='logout.php' class='button'>LOGOUT</a>
        </div>
        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
      <h1>MELIOR DE CINERE SURGO</h1>
      <a class="subtitle">
      "Non invidio a Dio il Paradiso perchè sono ben soddisfatto di vivere in Sicilia" -Federico II di Svevia
      </a>
    </header>
    <section id="search">
      <form autocomplete="off">
        <div class="search">
          <label for='search'>Cerca</label>
          <input type='text' name="search" class="searchBar">
          <input type="submit" value="Cerca">
        </div>
      </form>
      
    </section>
    <section class="container">

            <div id="results">
                
            </div>
    </section>
    <footer>
        <nav>
        <div class="footer-container">
          <div class="footer-col">
            <h1>Catania SSD</h1>
            <p>Dario Toscano</p>
            <p>O46002096</p>
          </div>
          
          <div class="footer-col">
            <strong>DOVE TROVARCI</strong>
            <p>Via Magenta 95030 Mascalucia CT</p>
            <p>Sede principale del Catania SSD</p>
          </div>
          <div class="footer-col">
            <strong>LINK UTILI</strong>
            <a href="https://www.instagram.com/cataniassd/"> Il nostro profilo Instagram</a> </br>
            <a href="https://www.youtube.com/@CataniaSSDofficial"> Il nostro profilo Youtube</a></br>
            <a href="https://www.facebook.com/cataniassdofficial"> Il nostro profilo Facebook</a>
            
          </div>
        </div>
      </nav>
    </footer>
  </body>
  </html>