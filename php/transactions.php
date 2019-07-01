<?php
    require_once "config.php";

    if(!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Portfolio</title>
<meta charset="utf-8">
<link rel="icon" href="../images/favicon.ico">
<link rel="stylesheet" type="text/css" href="../css/main_style.css">
<link rel="stylesheet" type="text/css" href="../css/portfolio.css">
<script type="text/javascript" src="../javascript/transactions.js"></script>
</head>
<body onLoad="listTransactions();">
    <header>
        <div id="headerBox"></div>
        <div id="navPortfolioLabel">Transactions</div>
        <div id="dimmer" onclick="popoutMenu();"></div>
        <div id="hamburgerMenu">
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" onmouseout="mouseOutLink(this);" onclick="goToLink('portfolio.php');">
                <div id="childLink">Portfolio</div></div>
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" onmouseout="mouseOutLink(this);" onclick="goToLink('transactions.php');">
                <div id="childLink">Transactions</div></div>
            <div class="hamburgerLink" onmouseover="mouseOverLink(this);" onmouseout="mouseOutLink(this);" onclick="goToLink('login.php');">
                <div id="childLink">Sign Out</div></div> <!-- Temp function. Will be changed when backend is built -->
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