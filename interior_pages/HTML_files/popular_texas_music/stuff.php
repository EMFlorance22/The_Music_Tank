<?php
    if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
        session_start();
        $username = $_SESSION["username"];
        $song = $_SESSION["song"];
        $artist = $_SESSION["artist"];
        $genre = $_SESSION["genre"];
        
        print <<<FORM
        <html lang="en">
            <meta charset="UTF-8">
            <body>
            <p>Edit/Enter your favorite music and view what others' favorites are!</p> 
            <form action="./responses.php" method="POST">
                <table>
                    <caption>Texas Favorites Form</caption>
                    <tr>
                        <td><label for="user">Enter your username:</label>
                            <input type="text" name="username" id="user" value="$username" required></td>
                    </tr>
                    <tr>
                        <td><label for="song">Enter your favorite texas song: </label>
                            <input type="text" name="song" id="song" placeholder = "$song" maxlength = "20" required></td>
                    </tr>
                    <tr>
                        <td><label for="artist">Enter your favorite texas artist: </label>
                            <input type="text" name="artist" id="artist" placeholder = "$artist" maxlength = "30" required></td>
                    </tr>
                    <tr>
                        <td><label for="genre">Enter your favorite genre: </label>
                            <input type="text" name="genre" id="genre" placeholder="$genre" maxlength = "20" required></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="view_responses" value="View Other Responses"></td>
                        <td><input type="submit" name="submit_response" value="Submit Response"></td>
                    </tr>
                    </table>
            </form>
            <a href="popular_texas_music.html">Back to Popular Texas Music Page</a>
            </body>
            </html>
FORM;
    }
    else {
        print <<<LOGIN
        <html lang="en">
        <meta charset="UTF-8">

        <body>
            <p>To be able to submit a response, you must be logged on. Follow the link to do so!</p>
            <a href="texas_register.html">Log In</a>
        </body>
        </html>
LOGIN;
    }
    


?>






