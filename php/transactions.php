<?php
    include("config.php");

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    } else {
        $maxtime = 1800; // Reset every 5 min, or logout

        if (isset($_SESSION['timestamp']) and (time() - $_SESSION['timestamp']) > $maxtime){
            $ezdb->logout();
            session_unset();
            session_destroy();
        }
        $_SESSION['timestamp'] = time();
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
        <div id='transLabels'>
            <div style='width: 23px;'>ID</div>
            <div style='width: 150px;'>Name</div>
            <div style='width: 300px;'>Amount</div>
            <div style='width: 90px;'>Credit/Debit</div>
            <div style='width: 400px;'>Date</div>
        </div>
        <?php
            $result = $ezdb->getTransactions();
            $total = 0.0;
            for ($i = 0; $i < count($result); $i++) {
        ?>
            <div class='infoBox' style='width: 1060px;'>
                <div id='moreInfoArrow'>&#9660</div>
                <p class='stockInfo' style='margin-right: 25px;'><?= strtoupper($result[$i]['transid']); ?></p>
                <?php
                    if ($result[$i]['transname'] == '$' and $result[$i]['transtype'] == 'D') {
                ?>
                    <p class='stockInfo' style='width: 150px;'>Deposit</p>
                <?php }
                    elseif ($result[$i]['transname'] == '$' and $result[$i]['transtype'] == 'C') {
                ?>
                    <p class='stockInfo' style='width: 150px;'>Withdraw</p>
                <?php }
                    else {
                ?>
                    <p class='stockInfo' style='width: 150px;'><?= strtoupper($result[$i]['transname']); ?></p>
                <?php } 
                    $amount = number_format(strval(doubleval($result[$i]['transamount'])*doubleval($result[$i]['transcount'])), 2, '.', ',');
                ?>
                <?php
                    if ($result[$i]['transtype'] == 'D') {
                ?>
                    <p class='stockInfo' style='width: 300px; text-align: right;'>$<?= $amount ?></p>
                <?php }
                    else {
                ?>
                    <p class='stockInfo' style='width: 300px; text-align: right;'>($<?= $amount ?>)</p>
                <?php } ?>
                <p class='stockInfo' style='width: 90px; text-align: center;'><?= $result[$i]['transtype']; ?></p>
                <p class='stockInfo' style='width: 400px;'><?= $result[$i]['timstamp']; ?></p>
            </div>
        <?php } ?>
    </main>
    <footer><i>Copyright &copy; 2019 Michael Borden</i></footer>
</body>
</html>
<?php
    }
?>