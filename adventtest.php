<!--<script src="snow/snowstorm-min.js"></script>-->

<?php
require("init.php");
$ca = new WHMCS_ClientArea();
if (!$ca->isLoggedIn()) {
    header('Location: login.php');
    return;
}
$uid = $ca->getUserID();
$day = getdate()["mday"];
function hasOpened()
{
    global $day, $uid;
    try {
        DEFINE('SQL_HOST', '127.0.0.1');
        DEFINE('SQL_USER', 'root');
        DEFINE('SQL_PASS', 'Gumicukor462');
        $sqlServ = mysqli_connect(SQL_HOST, SQL_USER, SQL_PASS);
        $sqlvQry = mysqli_query($sqlServ, 'SELECT * FROM advent.opened WHERE `user`=' . $uid . ' AND `day`=' . $day);
        if ($sqlvQry->num_rows == 0) {
            mysqli_query($sqlServ, 'INSERT INTO advent.opened VALUES (' . $uid . ',' . $day . ')');
            return false;
        }
    } catch (Exception $e) {
        echo "ERROR" . $e->getTraceAsString();
    }
    return true;
}

function addCredit($coins)
{
    global $uid, $day;
    $command = "addcredit";
    $adminuser = "gatesofandaron10@gmail.com";
    $values["clientid"] = $uid;
    $values["description"] = "Adventi naptár - " . $day . ". nap";
    $values["amount"] = $coins;
    $results = localAPI($command, $values, $adminuser);
    if ($results["result"] == "success") {
        echo '<p>Kaptál ' . $coins . 'FT egyenleget<br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
    } else {
        echo '<p class="error">Hiba történt az egyenleg jóváirása során. Kérlek irj egy hibajegyet hogy jóváirhassunk ' . $coins . ' forint egyenleget.<br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
    }
}

function addService($serviceid, $months)
{
    global $uid, $day;
    $command = "addorder";
    $adminuser = "gatesofandaron10@gmail.com";
    $values["clientid"] = $uid;
    $values["billingcycle"] = "monthly";
    $values["regperiod"] = $months;
    $values["description"] = "Adventi naptár - " . $day . ". nap";
    $values["pid"] = $serviceid;
    $values["paymentmethod"] = "gatewaymodule";
    $results = localAPI($command, $values, $adminuser);
    echo "<p class=\"debug\">" . serialize($results) . "</p>";
    if ($results["result"] == "success") {
        $command = "addinvoicepayment";
        $adminuser = "gatesofandaron10@gmail.com";
        $values["invoiceid"] = $results["invoiceid"];
        $values["transid"] = "AdventiNaptar-" . $day;
        $values["gateway"] = "gatewaymodule";
        $results = localAPI($command, $values, $adminuser);
        return $results["result"] == "success";
    }
}

function handleGet()
{
    global $day;
    try {
        $c = $_GET['click'];
        if ($c == "")
            return;
        $c = (int)$c;
        if ($c == $day) {
            /*if (hasOpened()) {
                echo '<p class="error">Csak egyszer nyithatod ki az ajándékodat. <br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                return;
            }*/
            echo '<p>Megnyitottad a ' . $day . '. napi ajándékodat</p>';
            switch ($day) {
                case 3: {
                    if (addService(21, 3)) {
                        echo '<p>Ajándék 3 hónap szén csomagot kaptál.</p>';
                    } else {
                        echo '<p class="error">Nem sikerült jóváírnunk az ajándék 2 hónap szén csomagodat, kérlek írj egy hibajegyet.</p>';
                    }
                    return;
                }
                case 4: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 5: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 6: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 7: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 8: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 9: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 10: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 11: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
                case 12: {
                    echo '<p>Az alábbi kuponkóddal 40% kedvezménnyel vásárolhatsz Minecraft Szervert! <b>9U4VB3DR6K<b><br> <a href="http://billing.voidhost.eu">Kattints ide a folytatáshoz!</a></p>';
                    return;
                }
            }
            return;
        }
    } catch (Throwable $e) {
    }
    echo '<p class="error">Ne próbálkozz a rendszer kikerülésével, mert kitiltáshoz vezethet!</p>';
}

function makeButtonStyle()
{
    global $day;
    for ($i = 1; $i < 25; $i++) {
        echo $i != $day ? "button#adv" . $i . "{ cursor: not-allowed;}" : "button#adv" . $i . "{ cursor: crosshair;
        text-shadow: 0 0 3px #0ff, 0 0 3px #0ff, 0 0 3px #0ff, 0 0 10px #0ff, 0 0 10px #0ff;color: #ffffff;}";
        echo $i != $day ? "button#adv" . $i . ":hover{
                    background: rgba(255, 0, 0, 0.4) url(\"adventwindow.png\") no-repeat right;
                    background-size: 80%;
                    color: #ffffff;
                }" :
            "button#adv" . $i . ":hover{
                    background: rgba(0, 255, 0, 0.4) url(\"adventwindow.png\") no-repeat right;
                    background-size: 80%;
                    color: #ffffff;
                }";
    }
}

function makeButtons()
{
    global $day;
    for ($c = 1; $c <= 24; ++$c) {
        echo $c == $day ? "<a href = \"" . $_SERVER['PHP_SELF'] . "?click=" . $c . "\" >
        <button class=\"advwindow\" id = \"adv" . $c . "\" > " . $c . "</button >
        </a>" : "<button class=\"advwindow\" id = \"adv" . $c . "\" >" . $c . "</button>";
    }
}

?>
<html>
<head>
    <title>► Adventi naptár ◄</title>
    <meta charset=UTF8>
    <script>
        var audio = new Audio('advent.mp3');
        audio.play();
    </script>

    <style>
        /* latin-ext */
        @font-face {
            font-family: 'Clicker Script';
            font-style: normal;
            font-weight: 400;
            src: local('Clicker Script'), local('ClickerScript-Regular'), url(https://fonts.gstatic.com/s/clickerscript/v4/Zupmk8XwADjufGxWB9KThO87R-l0-Xx_7cYc0ZX1ifE.woff2) format('woff2');
            unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Clicker Script';
            font-style: normal;
            font-weight: 400;
            src: local('Clicker Script'), local('ClickerScript-Regular'), url(https://fonts.gstatic.com/s/clickerscript/v4/Zupmk8XwADjufGxWB9KThEd0sm1ffa_JvZxsF_BEwQk.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
        }

        body {
            background: url("advent.jpg") no-repeat;
            background-size: cover;
            align-items: center;
        }

        h1 {
            text-shadow: 0 0 3px #808, 0 0 3px #808, 0 0 3px #808, 0 0 10px #808, 0 0 10px #808;
            color: #ffff00;
            font-size: 400%;
            margin-bottom: 0;
            text-align: center;
        }

        p {
            text-shadow: 0 0 3px #000, 0 0 3px #000, 0 0 3px #000, 0 0 10px #000, 0 0 10px #000;
            color: #ffffff;
            font-size: 24pt;
            text-align: center;
        }

        a {
            color: #FFFFFF;
            text-decoration: none;
        }

        .error {
            color: #ffa000;
            font-size: 24pt;
            text-align: center;
        }

        .debug {
            font-family: "Times New Roman";
            font-style: normal;
            font-size: 1vw;
            color: #ffa000;
            text-align: center;
        }

        body {
            font-family: 'Clicker Script', cursive;
        }

        .advwindow {
            text-align: left;
            background: rgba(80, 30, 0, 0.5) url("adventwindow.png") no-repeat right;
            text-shadow: 0 0 3px #000, 0 0 3px #000, 0 0 3px #000, 0 0 10px #000, 0 0 10px #000;
            border-radius: 25% 10%;
            border-width: 5pt;
            background-size: 50%;
            color: #ffff00;
            margin-left: 1.2%;
            margin-bottom: 0.8%;
            font-size: 3.5vw;
            width: 15%;
            height: 18.5%;
        }

        <?php
        makeButtonStyle();
        ?>
    </style>
</head>
<body>

<h1>Adventi naptár</h1>
<?php
handleGet();
makeButtons();
?>
</body>
</html>

