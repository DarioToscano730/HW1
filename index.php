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
    <link rel="stylesheet" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="contents.js" defer="true"></script>
    <script src="home.js" defer="true"></script>
    <!--<link rel="stylesheet" href="mhw1.css">-->
    <script src="mhw3.js" defer="true"></script>
    
  </head>
  
  <body>
    <header>
      <nav>
        <div id="logo">
          Catania SSD
        </div>
        <div id="links">
         <!-- <a>HOME</a>-->
          <a href='biglietteria.php'>BIGLIETTERIA</a>
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
      <a class="subtitle">
      "Non invidio a Dio il Paradiso perchè sono ben soddisfatto di vivere in Sicilia" -Federico II di Svevia
      </a>
       
    </header>
    <section>
     
      <form name ='search_content' id='search_content'>
			
        Potrai cercare qui qualsiasi gif dei tuoi calciatori preferiti o della tua squadra del cuore
        
        <label> <input type='text' name = 'content' id ='content'></label>	
          
        <select name = 'tipo' id='tipo'>
          <option value='gif'>GIF</option>
        </select>
        
        <label>&nbsp;<input class="submit" type='submit'></label>
            
      </form>
      <br/>
      <br/>
      <article id="album-view">
			
      </article>
      
    
      <article id="modale" class="hidden"> 
      
      </article>

      <div id="details">

        <div>
        <img src="stadiocibali.png">
        <h1>Stadio Angelo Massimino</h1>
        <p>Lo stadio Angelo Massimino è lo stadio polisportivo che ospita le partite casalinghe del Catania SSD. Dal 2002 è dedicato ad Angelo Massimino, il presidente che guidò i rossoazzurri dal 1969 al 1996. Lo stadio ha una capienza di circa 20mila posti a sedere.</p>
        </div>

        <div>
        <img src="angelo massimino.jpg">
        <h1>Angelo Massimino (Presidentissimo)</h1>
        <p>E' stato un imprenditore e dirigente sportivo italiano, soprannominato "Presidentissimo", avendo ricoperto la carica di massimo dirigente del Catania dal 1969 al 1996 (anno della sua morte). Nella sua terra è stato un vero e proprio idolo, tutt'oggi dopo oltre 25 anni dalla sua morte vi sono striscioni in suo onore durante le partite del Catania.
        </p>
        </div>       

      
      

      <!--<div id="details">-->

        <div>
        <img src="cataniaseriea_10_original.jpg">
        <h1>Storica promozione in Serie A </h1>
        <p>Catania-Albinoleffe (28-05-2006)</p><br/>
        <a href="https://www.youtube.com/watch?v=9waWF13PIHc&t=417s">Clicca qui per rivivere quei momenti</a>

        </div>

        <div>
        <img src="sinisa.jpg">
        <h1>Siniša Mihajlović</h1>
        <p>E' stato un calciatore e allenatore di calcio serbo con cittadinanza italiana, di ruolo centrocampista o difensore.</p>
        </div>

      <!--</div>-->
      

      <!--<div id="details">-->

        <div>
        <img src="fallimento.avif">
        <h1>Il fallimento </h1>
        <p>Nel dicembre 2021 il Calcio Catania SPA viene dichiarato fallito, conlcudendo così ben 77 anni di storia</p><br/>

        </div>

        <div>
        <img src="Ross pelligra.jpg">
        <h1>Ross Pelligra (U Zu Saru)</h1>
        <p>Chairman dell'omonimo gruppo leader nel settore delle costruzioni in Australia e presidente della squadra di calcio del Catania, si presenta con quell'attaccamento alla propria terra tipico degli emigranti siciliani sparsi nel mondo.</p>
        </div>
      <!--</div>-->
    </div>
    
    
    <section id="album-view">
    </section>


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