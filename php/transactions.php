<?php
    require_once "config.php";

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
<body onLoad="listTransactions();">
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
        <!-- Dynamic Section -->
    </main>
    <footer><i>Copyright &copy; 2019 Michael Borden</i></footer>
</body>
</html>
<?php
    }
?>