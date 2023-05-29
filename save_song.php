<?php
    /*******************************************************
        Inserisce nel database il post da pubblicare 
    ********************************************************/
    require_once 'auth.php';
    if (!$userid = checkAuth()) exit;

    spotify();

    function spotify() {
        global $dbconfig, $userid;

        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        # Costruisco la query
        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $artist = mysqli_real_escape_string($conn, $_POST['artist']);
        $duration = mysqli_real_escape_string($conn, $_POST['duration']);
        $popularity = mysqli_real_escape_string($conn, $_POST['popularity']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        # check if song is already present for user
        $query = "SELECT * FROM songs WHERE user = '$userid' AND song_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        # if song is already present, do nothing
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            exit;
        }

        # Eseguo
        $query = "INSERT INTO songs(user, song_id, content) VALUES('$userid','$id', JSON_OBJECT('id', '$id', 'title', '$title', 'artist', '$artist', 'duration', '$duration', 'popularity', '$popularity', 'image', '$image'))";
        error_log($query);
        # Se corretta, ritorna un JSON con {ok: true}
        if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));
    }