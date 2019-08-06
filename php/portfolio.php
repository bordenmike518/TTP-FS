<?php
    include("config.php");

    if(isset($_SESSION['id']) and $ezdb->checkLogin()) {
        /*$maxtime = 1800; // Reset every 5 min, or logout
        if (isset($_SESSION['timestamp']) and (time() - $_SESSION['timestamp']) > $maxtime){
            $ezdb->logout();
        }
        $_SESSION['timestamp'] = time();*/
        if (isset($_POST['stockForm'])) {
            if ($_POST['stockForm'] == 'Buy') {
                $ezdb->makeTransaction($_SESSION['id'], $_SESSION['ticker'], $_SESSION['price'], -intval($_SESSION['count']));
            }
            else {
                $ezdb->makeTransaction($_SESSION['id'], $_SESSION['ticker'], $_SESSION['price'], intval($_SESSION['count']));
            }
        }
        $portfolio = $ezdb->getPortfolio();
        $funds = $ezdb->getFunds();
        $total = 0.0;
        foreach($portfolio as $symbol => $data) {
            $count = $data['count'];
            $price = $data['price'];
            $portfolio[$symbol]['value'] = $count * $price;
            $total += $portfolio[$symbol]['value'];
        }
        if(isset($_SESSION['liveTicker']) and strlen(trim($_SESSION['liveTicker'])) > 0) {
            $price = $_SESSION['liveTickerValue'];
            unset($_SESSION['liveTickerValue']);
        } else {
            $price = 0.0;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Portfolio</title>
<meta charset="utf-8">
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/portfolio.css">
<script type="text/javascript" src="../javascript/main.js"></script>
<script type="text/javascript" src="../javascript/portfolio.js"></script>
</head>
<body>
    <header>
        <?php
        ?>
        <div id="headerBox"></div>
        <div id="navPortfolioLabel">Portfolio $</div>
        <div id="navPortfolioValue"><?= number_format($total, 2, '.', ',') ?></div>
        <div id="dimmer" onclick="popoutMenu();"></div>
        <div id="hamburgerMenu">
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" onmouseout="mouseOutLink(this);" onclick="goToLink('portfolio.php');">
                <div id="childLink">Portfolio</div></div>
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" onmouseout="mouseOutLink(this);" onclick="goToLink('transactions.php');">
                <div id="childLink">Transactions</div></div>
            <a href="logout.php?logout=true;">
                <div class='hamburgerLink' onmouseover='mouseOverLink(this);' onmouseout='mouseOutLink(this);'>
                    <div id='childLink'>Sign Out</div>
                </div> 
            </a>
            <canvas id="canvas"></canvas>
        </div>
        <input type='image' src='../images/hamburger_button.png' id='hamburger_button' onclick='popoutMenu();'>
    </header>
    <nav></nav>
    <br><br>
    <br><br>
    <main>
        <form name='liveTicker' action='' method='POST'></form>
        <form id='stockForm' name='stockForm' method='POST'>
            <div class='sfLabel'>Funds </div><div>: $</div><div style='width: 200px; text-align: right;'><?= number_format(-$funds, 2, '.', ',') ?></div>
            <div class='sfLabel'>Ticker</div><div>:</div><div id='liveContainer'>
            <div id='liveTicker' name='liveTicker' style='margin: 20px;'></div>
            <input type='text' id='liveInput' name='liveInput' style='width: 100%; height: 40px; text-align: left;' minlength='1' maxlength='16' autocomplete='off' spellcheck='false' onkeydown='clearText()' onkeyup='getTickerData();' required></div><br>
            <div id='liveName' name='liveName' style=''></div>
            <div class='sfLabel'>Price </div><div>: $</div><div id='livePrice' name='price' style='width: 200px; text-align: right;'><?= number_format($price, 2, '.', ',') ?></div><br>
            <div class='sfLabel'>Count </div><div>:</div><input type='text' name='count' min='1' max='65536' autocomplete='off' required><br>
            <input type='submit' id='buy' name='buy' value='Buy'><input type='submit' id='sell' name='sell' value='Sell'><br>
        </form>
        <div id='labelBox' style='width: 945px; padding-left: 55px;'>
            <div style='width: 160px;'>Name</div>
            <div style='width: 250px;'>Count</div>
            <div style='width: 210px;'>Price</div>
            <div style='width: 300px;'>Value</div>
        </div>
        <?php
            $index = 0;
            foreach($portfolio as $symbol => $data) {
        ?>
            <div id='infoBox' style='width: 1000px;'>
                <div id='infoArrow'>&#9660</div>
                <div style='width: 160px;'><?= $symbol ?></div>
                <div style='width: 250px; text-align: center;'><?= $data['count'] ?></div>
                <div style='width: 210px; text-align: right;'>$<?= number_format($data['price'], 2, '.', ',') ?></div>
                <div style='width: 300px; text-align: right;'>$<?= number_format($data['value'], 2, '.', ',') ?></div>
            </div>
        <?php $index += 1; } ?>
    </main>
    <footer><i>Copyright &copy; 2019 Michael Borden</i></footer>
</body>
</html>
<?php
    }
    else {
        $ezdb->logout();
        exit();
    }
?>