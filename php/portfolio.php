<?php
    include("config.php");

    if(isset($_SESSION['id']) and $ezdb->checkLogin()) {

        $maxtime = 1800; // Reset every 5 min, or logout
        if (isset($_SESSION['timestamp']) and (time() - $_SESSION['timestamp']) > $maxtime){
            $ezdb->logout();
        }
        $_SESSION['timestamp'] = time();
        $portfolio = $ezdb->getPortfolio();
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
<!--script type="text/javascript" src="../javascript/portfolio.js"></script-->
</head>
<body>
    <header>
        <?php
            $total = 0.0;
            foreach($portfolio as $symbol => $data) {
                $count = intval($data['count']);
                $price = intval($data['lastSalePrice']);
                $portfolio[$symbol]['value'] = $count * $price;
                $total += $portfolio[$symbol]['value'];
            }
        ?>
        <div id="headerBox"></div>
        <div id="navPortfolioLabel">Portfolio $</div>
        <div id="navPortfolioValue"><?= number_format($total, 2, '.', ',') ?></div>
        <div id="dimmer" onclick="popoutMenu();"></div>
        <div id="hamburgerMenu">
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" 
            
                onmouseout="mouseOutLink(this);" onclick="goToLink('portfolio.php');">
                <div id="childLink">Portfolio</div></div>
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" 
                onmouseout="mouseOutLink(this);" onclick="goToLink('transactions.php');">
                <div id="childLink">Transactions</div></div>
            <a href="logout.php?logout=true;">
                <div class="hamburgerLink" onmouseover="mouseOverLink(this);" 
                    onmouseout="mouseOutLink(this);">
                    <div id="childLink">Sign Out</div>
                </div> 
            </a>
            <canvas id="canvas"></canvas>
        </div>
        <input type="image" src="../images/hamburger_button.png" id="hamburger_button" onclick="popoutMenu();">
    </header>
    <nav></nav>
    <br><br>
    <br><br>
    <main>
        <?php
            $index = 0;
            foreach($portfolio as $symbol => $data) {
        ?>
            <div class='infoBox'>
                <div id='moreInfoArrow'>&#9660</div>
                <div class='stockInfo' style='width: 150px;'><?= $symbol ?></div>
                <div class='stockInfo' style='width: 80px; text-align: center;'><?= $data['count'] ?></div>
                <div class='stockInfo' style='width: 300px; text-align: right;'>$<?= number_format($data['lastSalePrice'], 2, '.', ',') ?></div>
                <div class='stockInfo' style='width: 300px; text-align: right;'>$<?= number_format($data['value'], 2, '.', ',') ?></div>
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