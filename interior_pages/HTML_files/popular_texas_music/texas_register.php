<?php

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

    $name =mysqli_real_escape_string ($connect, $_POST["username"]);

    $table = "users";

    $result = mysqli_query ($connect, "SELECT * from $table WHERE username = '$name'");
    $numRows = mysqli_num_rows($result);
    echo $numRows;


    // Close connection to the database
    mysqli_close($connect);




?>

