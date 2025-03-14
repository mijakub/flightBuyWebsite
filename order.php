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
    <main class="main">
        <form action="cart.php?buy=false" method="POST">
            <?php
                echo "<div class='flight2'><h3>Zamówienie</h3>";
                if(isset($_POST["clear"])){
                    $_SESSION["cart"] = [];
                    header("Location: cart.php?buy=false");
                }
                if(isset($_POST["order"]) && isset($_COOKIE["login"])){
                    $sql = "SELECT * FROM Orders";
                    $result = mysqli_query($conn, $sql);
                    $totalPrice = 0;
                    $sqlID = "SELECT id from Orders ORDER BY id DESC LIMIT 1";
                    $resultID = mysqli_query($conn, $sqlID);
                    if(mysqli_num_rows($resultID) > 0){
                        foreach($result as $row){
                            $id = $row["id"] + 1;
                        }
                    }else{
                        $id = 0;
                    }
                    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 0;");
                    foreach($_SESSION["cart"] as $index => $people){
                        $sql2 = "SELECT * FROM Flights WHERE id LIKE $index";
                        $result2 = mysqli_query($conn, $sql2);
                        while($row = mysqli_fetch_array($result2)){
                            $sum = $people * $row["price"];
                            $totalPrice += $sum;
                            $sql3 = "INSERT INTO Order_Items (order_id, flight_id, tickets_count, price_per_ticket, total_price) VALUES ($id, ".$row["id"].", $people, ".$row["price"].", $sum)";
                            $result3 = mysqli_query($conn, $sql3);
                        }
                    }
                    $name = $_COOKIE["login"];
                    $user_id = 0;
                    $sql4 = "SELECT id FROM Users WHERE username LIKE '$name'";
                    $result4 = mysqli_query($conn, $sql4);
                    foreach($result4 as $row){
                        $user_id = $row["id"];
                    }
                    $sql5 = "INSERT INTO Orders (id, user_id, total_price) VALUES ($id, $user_id, $totalPrice)";
                    $result5 = mysqli_query($conn, $sql5);
                    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS = 1;");
                    $_SESSION["cart"] = [];
                    echo "Dokonano zamówienia!<br>Wróć na stronę główną...";
                }
                else{
                    header("Location: login.php");
                }
                echo "</div>";
            ?>
        </form>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>