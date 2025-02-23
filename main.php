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
                    <option value="KTW">KTW</option>
                    <option value="WAW">WAW</option>
                    <option value="DXB">DXB</option>
                </select>
            </div>
            <div class="field">
                <label id="to">Dokąd:&nbsp;</label>
                <select name="to" id="to">
                    <option value="KTW">KTW</option>
                    <option value="WAW">WAW</option>
                    <option value="DXB">DXB</option>
                </select>
            </div>
            <div class="field">
                <label id="since">Od:&nbsp;</label>
                <input type="text" name="since" id="since" pattern="\d{4}-\d{2}-\d{2}" placeholder="rrrr-mm-dd" required>
            </div>
            <div class="field">
                <label id="until">Do:&nbsp;</label>
                <input type="text" name="until" id="until" pattern="\d{4}-\d{2}-\d{2}" placeholder="rrrr-mm-dd" required>
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
</body>
</html>