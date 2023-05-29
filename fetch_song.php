<?php 
    /*******************************************************
        Preleva gli ultimi 10 post o tutti, se ce ne sono 
        meno di 10
    ********************************************************/
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $userid = mysqli_real_escape_string($conn, $userid);
    
    // Se devo mostrare contenuti a partire da un certo numero, creo la stringa della query associata
    $next = isset($_GET['from']) ? 'AND songs.id < '.mysqli_real_escape_string($conn, $_GET['from']).' ' : '';

        // Prendo tutti i post e tutti i like che l'utente loggato ha messo ai post ritornati

        // Seleziono tutti gli attributi che mi interessano
        // (EXISTS) Mi faccio ritornare i like se ce ne sono
        // (FROM) Dall'unione tra i post e gli utenti (tutti gli utenti che hanno pubblicato post)

        $query = "SELECT user AS userid, id AS songid, content AS content from songs where user = $userid ORDER BY songid DESC LIMIT 10";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $songArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        // Scorro i risultati ottenuti e creo l'elenco di post
        $songArray[] = array('userid' => $entry['userid'],
                            'songid' => $entry['songid'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($songArray);
    
    exit;


?>