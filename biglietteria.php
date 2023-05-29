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
    <title>Catania SSD</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="biglietteria.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="contents.js" defer="true"></script>
    <script src="home.js" defer="true"></script>
  </head>
  
  <body>
    <header>
      <nav>
        <div id="logo">
          Catania SSD
        </div>
        <div id="links">
         <!-- <a>HOME</a>-->
          <a href='index.php'>HOME</a>
          <a href='https://www.tuttocalciocatania.com/'>NEWS</a>
          <a href='index.html'>ROSA</a>
          <div id="separator"></div>
          <!--<a href='signup.php'>PROFILO</a>-->
          <a href='index2.php' class='button'>LOGOUT</a>
          
        </div>
        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
      <h1>MELIOR DE CINERE SURGO</h1>
      <strong>Per l'erogazione dei biglietti il Catania SSd si affida alla piattaforma "TicketOne" raggiungibile premendo il seguente link:</strong>
      <a href='https://www.ticketone.it/artist/catania-ssd/'>TicketOne </a>
        
      
    </header>
  
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