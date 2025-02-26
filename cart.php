<?php
    $conn = mysqli_connect("localhost","root","","airport") or die("Błąd połączenia z bazą: ". mysqli_connect_error()); 
    session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk!</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="planeIcon.png" type="image/x-icon">
</head>
<body>
    <a href="main.php"><img src="planeIcon.png" alt="back to main page icon" id="back"></a>
    <?php
        include_once("header.php");
    ?>
    <main>
       <?php
            echo "<div class='flight2'><h3>Koszyk!</h3>";
            if(!empty($_SESSION["cart"])){
                echo "Dodano do ksozyka!";
            }
            else{
                echo "<h4></h4>Koszyk jest pusty";
            }
            echo "</div>";
       ?>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>