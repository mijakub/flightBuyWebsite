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
        <form action="login.php?log=true" method="POST">
            <div class='flight2'>
                <?php
                    if(!isset($_COOKIE["login"])){
                        echo '<h3>Zaloguj się!</h3><input type="text" name="username"><br><input type="password" name="userpass"><br><input type="submit" name="login">';
                        if(isset($_POST["login"])){
                            setcookie("login", $_POST["username"], time() + 3600);
                            header("Location: main.php");
                        }
                    }
                    else{
                        echo "<h3>Zalogowano: ".$_COOKIE["login"]."!</h3>";
                    }
                ?>
                
                <?php
                    
                ?>
            </div>
        </form>
    </main>
</body>
</html>
<?php
    mysqli_close($conn);
?>