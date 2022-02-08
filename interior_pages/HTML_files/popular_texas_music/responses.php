<?php
    session_start();
    // use isset($_COOKIE["username"]) to print the form if the user is logged in. use session variables
    if (isset($_POST["view_responses"])) {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $host = "summer-2021.cs.utexas.edu";
        $user = "cs329e_mitra_evan21";
        $pwd = "vigil-Sun&rouge";
        $dbs = "cs329e_mitra_evan21";
        $port = "3306";

// Create connection
        $connection = mysqli_connect($host, $user, $pwd, $dbs, $port);
// Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
    }
        $result = mysqli_query($connection, "SELECT * FROM users_responses");

        while ($row = $result->fetch_row())
        {
            print "Username = " . $row[0] . ", Favorite Song = " . $row[1].
            ", Favorite Artist = " . $row[2] . ", Favorite Genre = " . $row[3] . "<br /><br />\n";
        }
        $result->free();
        echo "<a href='stuff.php'>Back to form</a>";
        $connection->close();
        }

    if (isset($_POST["submit_response"])) {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $host = "summer-2021.cs.utexas.edu";
        $user = "cs329e_mitra_evan21";
        $pwd = "vigil-Sun&rouge";
        $dbs = "cs329e_mitra_evan21";
        $port = "3306";

// Create connection
        $connection = mysqli_connect($host, $user, $pwd, $dbs, $port);
// Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
    }
        function purge ($str)
    {
                $purged_str = preg_replace("/\W/", "", $str);
                return $purged_str;
    }

        $username = purge($_POST["username"]);
        $username = mysqli_real_escape_string($connection, $username);
        $song = purge($_POST["song"]);
        $song = mysqli_real_escape_string($connection, $song);
        $artist = purge($_POST["artist"]);
        $artist = mysqli_real_escape_string($connection, $artist);
        $genre = purge($_POST["genre"]);
        $genre = mysqli_real_escape_string($connection, $genre);

        if ($_SESSION["song"] == "") {
                $stmt = $connection->prepare("INSERT INTO users_responses VALUES (?,?,?,?)"); // This is the code for inserting a row into the table STUDENTS
                $stmt->bind_param("ssss",$username, $song, $artist, $genre); 
                $stmt->execute();
                
                $_SESSION["user"] = $username;
                $_SESSION["song"] = $song;
                $_SESSION["artist"] = $artist;
                $_SESSION["genre"] = $genre;

                echo "Response added.";
        }

        else {
                $result = mysqli_query($connection, "UPDATE users_responses SET Song = '$song' WHERE Username = '$username'");
                $_SESSION["song"] = $_POST["song"];
                
                $result2 = mysqli_query($connection, "UPDATE users_responses SET Artist = '$artist' WHERE Username = '$username'");
                $_SESSION["artist"] = $_POST["artist"];
                
                $result3 = mysqli_query($connection, "UPDATE users_responses SET Genre = '$genre' WHERE Username = '$username'");
                $_SESSION["genre"] = $_POST["genre"];

                echo "Response updated";
        }
        $connection->close();

        print <<<BACK

        <a href="stuff.php">Back to form</a>
BACK;
        }

    
















?>