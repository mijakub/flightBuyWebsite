<header>
    <h1><span class="icon">&#9992;</span> Zarezerwuj lot!</h1>
    <div class="rightPanel">
        <?php
            if(isset($_COOKIE["login"])){
                echo '<h3><a href="login.php">'.$_COOKIE["login"].' <span class="icon">&#128100;</span></a></h3>';
            }
            else{
                echo '<h3><a href="login.php">Zaloguj się <span class="icon">&#128100;</span></a></h3>';
            }
        ?>
        <h3><a href="cart.php?buy=false">Koszyk <span class="icon">&#128722;</span></a></h3>
    </div>
</header>