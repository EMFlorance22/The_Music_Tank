<?php

print <<<PAGE
<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title>Galveston- Interactive Texas Map</title>

    <body>
        <a href="../texas_music_map.html">Back to Music Map</a><br />
PAGE;

// Connect to the MySQL database
$host = "summer-2021.cs.utexas.edu";
$user = "cs329e_mitra_evan21";
$pwd = "vigil-Sun&rouge";
$dbs = "cs329e_mitra_evan21";
$port = "3306";

$connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$result = mysqli_query($connect, "SELECT artist_from_there, popular_genres FROM cities WHERE city_name = 'Galveston'");

while ($row = $result->fetch_row())
    {
        print "Well Known Artist: " . $row[0] . "<br /><br />\n" . " Popular Genres: " . $row[1] . "<br /><br />\n";
    }
$result->free();

$result = mysqli_query($connect, "SELECT artist_name FROM artists WHERE artist_city LIKE '%Galveston%'");

print "All artists from Galveston: ";
while ($row = $result->fetch_row())
    {
        print $row[0] . ", ";
    }
$result->free();
$connection->close();




?>