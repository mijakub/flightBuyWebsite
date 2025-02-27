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
        <form action="cart.php?buy=false" method="POST">
            <?php
                if(isset($_POST["clear"])){
                    $_SESSION["cart"] = [];
                }
                if($_REQUEST["buy"] == "true"){
                    $_SESSION["cart"][$_REQUEST["ID"]] = $_REQUEST["people"];
                }
                echo "<div class='flight2'><h3>Koszyk</h3>";
                if(!empty($_SESSION["cart"])){
                    echo "<div class='block2'><div id='tickets'>";
                    foreach($_SESSION["cart"] as $index => $people){
                        $sql = "SELECT * FROM Flights WHERE id LIKE $index";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)){
                            $sum = $people * $row["price"];
                            echo "<h5>".$row["origin"]." &#10141; ".$row["destination"]." | bilety: $people | ".$row['start_date']." | $sum"." "."zł</h5>";
                        }
                    }
                    echo "</div><div class='buttons'><button class='but1' name='clear' type='submit'>Wyczyść koszyk</button><button class='but1' name='order' type='submit'>Kup</button></div></div></div>";
                }
                else{
                    echo "<h4></h4>Koszyk jest pusty</div>";
                }
            ?>
        </form>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>