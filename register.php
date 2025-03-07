<?php
    $conn = mysqli_connect("localhost","root","","airport") or die("Błąd połączenia z bazą: ". mysqli_connect_error()); 
    session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="planeIcon.png" type="image/x-icon">
</head>
<body>
    <a href="main.php"><img src="planeIcon.png" alt="back to main page icon" id="back"></a>
    <?php
        include_once("header.php");
    ?>
    <main class="main">
        <form action="register.php" method="POST">
            <div class='flight3'>
                <h3>Zarejestruj się!</h3><br>
                <label for="nick">Nazwa użytkownika:</label><br>
                <input type="text" name="username" id="nick" required><br>
                <label for="pass">Hasło:</label><br>
                <input type="password" name="userpass" id="pass" required><br>
                <button type="submit" name="register">Zarejestruj się</button>
                <?php
                    if(isset($_POST["register"])){
                        $username = $_POST["username"];
                        $password = $_POST["userpass"];
                        $sql = "INSERT INTO Users (username, pass) VALUES ('$username', '$password')";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            echo "<p>Utworzono konto, zaloguj się na nie!</p>";
                            header("Location: login.php");
                        }
                        else{
                            echo "<p>Coś poszło nie tak. Spróbuj utworzyć konto ponownie...</p>";
                            header("Location: register.php");
                        }
                    }
                ?>
            </div>
        </form>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>