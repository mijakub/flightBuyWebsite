<?php
    $conn = mysqli_connect("localhost","root","","airport") or die("Błąd połączenia z bazą: ". mysqli_connect_error());
    session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarezerwuj lot!</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="planeIcon.png" type="image/x-icon">
</head>
<body>
    <a href="main.php"><img src="planeIcon.png" alt="back to main page icon" id="back"></a>
    <?php
        include_once("header.php");
    ?>
    <nav>
        <form action="main.php" method="POST" id="flightForm">
            <div class="field">
                <label id="from">Skąd:&nbsp;</label>
                <select name="from" id="from">
                    <?php
                        $query1 = "SELECT DISTINCT origin FROM Flights";
                        $result1 = mysqli_query($conn, $query1);
                        foreach($result1 as $row){
                            echo "<option value='".$row["origin"]."'>".$row["origin"]."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="field">
                <label id="to">Dokąd:&nbsp;</label>
                <select name="to" id="to">
                    <?php
                        $query2 = "SELECT DISTINCT destination FROM Flights";
                        $result2 = mysqli_query($conn, $query2);
                        foreach($result2 as $row){
                            echo "<option value='".$row["destination"]."'>".$row["destination"]."</option>";
                        }
                        echo "<option value='anywhere'>Cały świat!</option>";
                    ?>
                </select>
            </div>
            <div class="field">
                <label id="since">Wylot:&nbsp;</label>
                <input type="text" name="since" id="since" pattern="\d{4}-\d{2}" placeholder="rrrr-mm" required>
            </div>
            <div class="field">
                <label id="people">Ilość pasażerów:&nbsp;</label>
                <input type="number" name="people" id="people" required min="1">
            </div>
            <div class="field">
                <input type="submit" name="find" value="Znajdź lot!" id="find">
            </div>
        </form>
    </nav>
    <main class="main">
       <?php
            $id = $_REQUEST["ID"];
            $people = $_REQUEST["people"];
            $query = "SELECT * FROM Flights WHERE id LIKE $id";
            $result = mysqli_query($conn, $query);
            foreach($result as $row){
                $sum = $people * $row["price"];
                echo "<div class='flight2'><img src='".$row['airline'].".png' alt='".$row['airline']."'><h3>Zarezerwuj lot!</h3><div class='block'><h4>".$row["origin"]." &#10141; ".$row["destination"]."</h4><h4>".$row['start_date']."</h4><h5>Cena za pasażera: ".$row['price']."zł</h5><h5>Cena za wszystkich pasażerów: $sum"."zł</h5><a href='cart.php?ID=".$row['id']."&people=$people&buy=true'><button class='but' name='buy'>Dokonaj rezerwacji!</button></a></div></div>";
            }
       ?>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>