<!DOCTYPE html>
<html lang="en">

<head>
    <title>Accessible Multilevel Hamburger Menu</title>
    <?php include("includes/common-head-tags.php"); ?>
     <link rel="stylesheet" type="text/css" href="css/hamburger.css" />
</head>

<body>
    <?php include("includes/example-header.php"); ?>

    <a role="button" id="hamburger__main" href="#hamburger-start" class="hamburger__main-button" aria-expanded="false" aria-controls="mobile-nav" aria-label="main menu">
        ☰
    </a>

    <ul class="hamburger__root hamburger__level">
        <li><a id="hamburger-start" href="#hamburger__main">Close</a></li>
        <li><a id="product-root" href="#products" aria-expanded="false">Products</a>
            <ul class="hamburger__level">
                <li><a id="products" class="back" href="#product-root">Back</a></li>
                <li><a href="">Screen Readers</a></li>
                <li><a href="">Training</a></li>
                <li><a href="">Clue Bats</a></li>
                <li><a href=""></a></li>
                <li><a href=""></a></li>
            </ul>
        </li>
        <li><a href="#services"></a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/acessibility">Accessibility Statement</a></li>
        <li><a href="/privacy">Privacy</a></li>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/accessibility-es4.js"></script>
</body>

</html>