<?php
    include("config.php");

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    } else {
        /*$maxtime = 1800; // Reset every 5 min, or logout
        if (isset($_SESSION['timestamp']) and (time() - $_SESSION['timestamp']) > $maxtime){
            $ezdb->logout();
        }
        $_SESSION['timestamp'] = time();*/
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
<script type="text/javascript" src="../javascript/transactions.js"></script>
</head>
<body>
    <header>
        <div id="headerBox"></div>
        <div id="navPortfolioLabel">Transactions</div>
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
                    onmouseout="mouseOutLink(this);" onclick="goToLink('transactions.php');">
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
        <div id='labelBox' style='width: 1145px; padding-left: 55px;'>
            <div style='width: 170px;'>Name</div>
            <div style='width: 450px;'>Amount</div>
            <div style='width: 500px;'>Date</div>
        </div>
        <?php
            $result = $ezdb->getTransactions();
            $total = 0.0;
            for ($i = 0; $i < count($result); $i++) {
        ?>
            <div id='infoBox' style='width: 1200px;'>
                <div id='infoArrow'>&#9660</div>
                <?php
                    if ($result[$i]['transname'] == '$' and $result[$i]['transcount'] < 0) {
                ?>
                    <div style='width: 170px;'>Deposit</div>
                <?php }
                    elseif ($result[$i]['transname'] == '$' and $result[$i]['transcount'] > 0) {
                ?>
                    <div style='width: 170px;'>Withdraw</div>
                <?php }
                    else {
                ?>
                    <div style='width: 170px;'><?= strtoupper($result[$i]['transname']); ?></div>
                <?php } 
                ?>
                <?php
                    if ($result[$i]['transcount'] < 0) {
                    $amount = number_format($result[$i]['transamount'] * -$result[$i]['transcount'], 2, '.', ',');
                ?>
                    <div style='width: 450px; text-align: right;'>$<?= $amount ?></div>
                <?php }
                    else {
                    $amount = number_format($result[$i]['transamount'] * $result[$i]['transcount'], 2, '.', ',');
                ?>
                    <div style='width: 450px; text-align: right;'>($<?= $amount ?>)</div>
                <?php } ?>
                <div style='width: 500px; text-align: right;'><?= $result[$i]['timstamp']; ?></div>
            </div>
        <?php } ?>
    </main>
    <footer><i>Copyright &copy; 2019 Michael Borden</i></footer>
</body>
</html>
<?php
    }
?>