<?php

if (isset($_POST["submit"])) {
    $username = $_POST['username'];
    
    // Connect to the MySQL database
    $host = "summer-2021.cs.utexas.edu";
    $user = "cs329e_mitra_evan21";
    $pwd = "vigil-Sun&rouge";
    $dbs = "cs329e_mitra_evan21";
    $port = "3306";

    $connect = mysqli_connect ($host, $user, $pwd, $dbs, $port);

    if(empty($connect))
{
        die("mysqli_connect failed: " . mysqli_connect_error());
}
    $table = "users";
    $name = mysqli_real_escape_string ($connect, $username);
    $password = mysqli_real_escape_string($connect, crypt($_POST["password"]));

    $result = mysqli_query ($connect, "SELECT * from users WHERE username = '$name'");
    $numRows = mysqli_num_rows($result);

    if ( $numRows == 0)
{
        $response = 1;
        echo $response;

        $stmt = mysqli_prepare ($connect, "INSERT INTO users VALUES (?, ?)");
        mysqli_stmt_bind_param ($stmt, 'ss', $name, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

}
    else
{
        $response = 0;
        echo $response;

}

    mysqli_close($connect);
    setCookie("username", $name, time() + 1200);
    setCookie("password", $password, time() + 1200);
    header("Location: stuff.php");
}

?>