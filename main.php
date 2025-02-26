<?php
    $conn = mysqli_connect("localhost","root","","airport") or die("Błąd połączenia z bazą: ". mysqli_connect_error()); 
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
    <a name="top"></a>
    <a href="#top"><img src="planeIcon.png" alt="back to the top icon" id="back"></a>
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
    <main>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $from = $_POST["from"];
                $to = $_POST["to"];
                $start_date = $_POST["since"];
                $people = $_POST["people"];
                if($to == "anywhere"){
                    $query3 = "SELECT id, origin, destination, airline, CONCAT(FLOOR(TIME_TO_SEC(duration) / 3600), ' godzin ', FLOOR((TIME_TO_SEC(duration) % 3600) / 60), ' minut') AS flight_duration, price, DATE_FORMAT(departure, '%H:%i') AS departure_time, DATE_FORMAT(arrival, '%H:%i') AS arrival_time FROM Flights WHERE DATE_FORMAT(start_date, '%Y-%m') LIKE '$start_date' AND tickets_available >= $people AND origin like '$from'";
                }
                else{
                    $query3 = "SELECT id, origin, destination, airline, CONCAT(FLOOR(TIME_TO_SEC(duration) / 3600), ' godzin ', FLOOR((TIME_TO_SEC(duration) % 3600) / 60), ' minut') AS flight_duration, price, DATE_FORMAT(departure, '%H:%i') AS departure_time, DATE_FORMAT(arrival, '%H:%i') AS arrival_time FROM Flights WHERE DATE_FORMAT(start_date, '%Y-%m') LIKE '$start_date' AND tickets_available >= $people AND origin like '$from' AND destination LIKE '$to'";
                }
                $result3 = mysqli_query($conn, $query3);
                if(mysqli_num_rows($result3) > 0){
                    foreach($result3 as $row){
                        echo "<div class='flight'><img src='".$row['airline'].".png' alt='".$row['airline']."'><div class='flex'><div class='center'><h4>".$row['origin']."</h4><h4 class='time'>".$row['departure_time']."</h4></div><div class='center2'><h5>".$row['flight_duration']."</h5><h6>&#10141;</h6></div><div class='center'><h4>".$row['destination']."</h4><h4 class='time'>".$row['arrival_time']."</h4></div></div><div class='price'><a href=''><div class='summarize'><h3>".$row['price']."zł</h3><div>za osobę</div></div></a></div></div>";
                    }
                }
                else{
                    echo "<h2>Nie znaleziono lotów spełniających podane wymagania...</h2>";
                }
            }
            else{
                echo "<h2>Wybierz i zarezerwuj lot!</h2>";
            }
        ?>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>