<?php
    $conn = mysqli_connect("localhost","root","","airport") or die("Błąd połączenia z bazą: ". mysqli_connect_error()); 
    session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="planeIcon.png" type="image/x-icon">
</head>
<body>
    <a href="main.php"><img src="planeIcon.png" alt="back to main page icon" id="back"></a>
    <?php
        include_once("header.php");
    ?>
    <main class="main">
        <form action="login.php" method="POST">
            <div class='flight3'>
                <?php
                    if(!isset($_COOKIE["login"])){
                        echo '<h3>Zaloguj się!</h3><label for="nick">Nazwa użytkownika:</label><br><input type="text" name="username" id="nick" required><br><label for="pass">Hasło:</label><br><input type="password" name="userpass" id="pass" required><br><button type="submit" name="login">Zaloguj się</button><a href="register.php">Nie masz konta? Zarejestruj się!</a>';
                        if(isset($_POST["login"])){
                            $username = $_POST["username"];
                            $password = $_POST["userpass"];
                            $sql = "SELECT * FROM Users WHERE username LIKE '$username' AND pass LIKE '$password'";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                                setcookie("login", $_POST["username"], time() + 3600, "/" );
                                header("Location: main.php");
                            }
                            else{
                                header("Location: login.php");
                            }
                        }
                    }
                    else{
                        echo '<div class="align"><h3>Zalogowano: '.$_COOKIE["login"].'!</h3><button type="submit" name="logout" id="logout">Wyloguj się</button></div>';
                        if(isset($_POST["logout"])){
                            foreach ($_COOKIE as $key => $value) {
                                setcookie($key, "", time() - 3600, "/");
                            }
                            unset($_COOKIE['nazwa_ciasteczka']);
                            header("Location: main.php");
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