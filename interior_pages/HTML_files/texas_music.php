<?php
if (isset($_POST['submit'])) {
$genre = $_POST['genre'];
$artist = $_POST['artist'];
$song = $_POST['song'];
$year = $_POST['year'];
$wiki = $_POST['wiki'];
$hometown = $_POST['hometown'];
$spotify = $_POST['spotify'];
$genre2 = $_POST['genre2'];

$host = "summer-2021.cs.utexas.edu";
$user = "cs329e_mitra_evan21";
$pwd = "vigil-Sun&rouge";
$dbs = "cs329e_mitra_evan21";
$port = "3306";

$connection = mysqli_connect($host, $user, $pwd, $dbs);
// Check connection
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
    }

if ($genre2 != "") {
  $max = mysqli_query($connection, "SELECT MAX(song_id) FROM songs");
  $row = $max->fetch_row();
  $id = strval(intval($row[0]) + 1);
  $stmt = $connection->prepare("INSERT INTO songs VALUES (?,?,?,?,?,?)"); // inserts song data into database
  $stmt->bind_param("ssssss",$song, $id, $artist, $genre2, $year, $spotify); 
  $stmt->execute();

  // Checks if artist already exists in database and only runs the query if the artist is not already in the database
  $result = mysqli_query($connection, "SELECT * FROM artists WHERE artist_name = \"$artist\"");
  
  if (empty($result)) {
    
    $a_id = mysqli_query($connection, "SELECT MAX(artist_id) FROM artists");
    $row = $a_id->fetch_row();
    $id = strval(intval($row[0]) + 1);
    $stmt = $connection->prepare("INSERT INTO artists VALUES (?,?,?,?,?)"); // inserts artist data into database, if the artist is not already there
    $stmt->bind_param("sssss", $artist, $id, $genre2, $hometown, $wiki);
    $stmt->execute();
  }

  //If genre manually chosen is not in the database, add it to the database table genres
  $result = mysqli_query($connection, "SELECT * FROM genres WHERE genre_name = \"$genre2\"");
  if (empty($result)) {
    $id2 = mysqli_query($connection, "SELECT MAX(genre_id) FROM genres");
    $row = $id2->fetch_row();
    $id = strval(intval($row[0]) + 1);
    $stmt = $connection->prepare("INSERT INTO genres VALUES (?,?,?)");
    $stmt->bind_param("sss", $genre2, $id, "");
    $stmt->execute();
  }

  $city = mysqli_query($connection, "SELECT * FROM cities WHERE city_name = \"$hometown\"");
    if (empty($city)) {
      $c_id = mysqli_query($connection, "SELECT MAX(city_id) FROM cities");
      $row = $c_id->fetch_row();
      $id = strval(intval($row[0]) + 1);
      $stmt = $connection->prepare("INSERT INTO cities VALUES (?,?,?,?)"); 
      $stmt->bind_param("sssss", $hometown, $id, $artist, $genre2);
      $stmt->execute();

    }

    echo "Thank you for making the Music Tank as thorough as possible!";
    echo "<a href='texas_music_form.html'>Back to Texas Music Form</a>";
}

if ($genre2 == "") {
  $max = mysqli_query($connection, "SELECT MAX(song_id) FROM songs");
  $row = $max->fetch_row();
  $id = strval(intval($row[0]) + 1);
  $stmt = $connection->prepare("INSERT INTO songs VALUES (?,?,?,?,?,?)"); // inserts song data into database
  $stmt->bind_param("ssssss",$song, $id, $artist, $genre, $year, $spotify); 
  $stmt->execute();

  // Checks if artist already exists in database and only runs the query if the artist is not already in the database
  $result = mysqli_query($connection, "SELECT * FROM artists WHERE artist_name = \'$artist\'");

  if (empty($result)) {
    
    $a_id = mysqli_query($connection, "SELECT MAX(artist_id) FROM artists");
    $row = $a_id->fetch_row();
    $id = strval(intval($row[0]) + 1);
    $stmt = $connection->prepare("INSERT INTO artists VALUES (?,?,?,?,?)"); // inserts artist data into database, if the artist is not already there
    $stmt->bind_param("sssss", $artist, $id, $genre, $hometown, $wiki);
    $stmt->execute();
  }
  //If city is not in the database, add it and any other relevant information
  $city = mysqli_query($connection, "SELECT * FROM cities WHERE city_name = \'$hometown\'");
    if (empty($city)) {
      $c_id = mysqli_query($connection, "SELECT MAX(city_id) FROM cities");
      $row = $c_id->fetch_row();
      $id = strval(intval($row[0]) + 1);
      $stmt = $connection->prepare("INSERT INTO cities VALUES (?,?,?,?)"); 
      $stmt->bind_param("sssss", $hometown, $id, $artist, $genre);
      $stmt->execute();

    }

  echo "Thank you for making the Music Tank as thorough as possible!";
  echo "<a href='texas_music_form.html'>Back to Texas Music Form</a>";
}

$connection->close();

}
?>