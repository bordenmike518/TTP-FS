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
<link rel="stylesheet" type="text/css" href="../css/portfolio.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../javascript/portfolio.js"></script>
</head>
<body onLoad="listPortfolio();">
    <header>
        <div id="headerBox"></div>
        <div id="navPortfolioLabel">Portfolio $</div><div id="navPortfolioValue"></div>
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