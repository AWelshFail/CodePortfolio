
<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

try{
    $pdo = new PDO("mysql:host=homepages.shu.ac.uk;dbname=c1032071_db2", "c1032071", "Cymraeg1");

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Print host information
    //echo "Connect Successfully. Host info: " .
$pdo->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>
