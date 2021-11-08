<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Accessible animated hide and show</title>
		<?php include "includes/common-head-tags.php";?>
    <link id="link-css" rel="stylesheet" type="text/css" href="css/animated-hide-and-show.css" />
  </head>

  <body>
    <?php include "includes/documentation-header.php";?>

    <main>
      <aside class="notes">
        <h2>Notes:</h2>

        
      </aside>

      <h1>Accessible Animated Hide and show.</h1>

      <!-- Here's a way to animate/transition 
      the opacity and display of your div! -->
      <style>
        /*This is a fade in example.*/
        @keyframes fadeIn {
          0% {opacity:0;}
          1% {opacity:0;}
          100% {opacity:1;}
        }
        /*This is a fade out example. */
        @keyframes fadeOut {
          0% {opacity:1;}
          1% {opacity:1;}
          100% {opacity:0;}
        }
        
        #block-to-hide-and-show {
          width: 200px;
          min-height: 200px;
          background-color: black;
          color: white;
          opacity: 0;
          padding: 10px;
        }

        #block-to-hide-and-show a,
        #block-to-hide-and-show a:visited
        {
          color: #ffccff !important;
        }

        .hide {
          display: none;
        }

        .animate {
          /* You must have this for accessibility reasons */
          display: block;
          animation: fadeIn 2s 1 forwards;
        }
      </style>
     
      <!-- You can put anything to activate the function, by the way. -->
      <button onclick="appear()"> example </button>
      <!-- This div is what's being animated, which explains why the function
      appear() has 'animate' in it. -->
      <div id="block-to-hide-and-show" class="hide">
        <a href="#">This is a dummy link</a> that should only gain keyboard focus when the block is visible.
      </div>


      <script>
        function appear() {
          const el = document.getElementById('block-to-hide-and-show');
          el.classList.add('animate')
          /* you can also change the display completely after the animation 
          is done. (setTimeout, same time as animation-duration). For example,
          setTimeout after 2 seconds, and make function .style.display = "block";
          and style.opacity = "1"; to make the change permanent. */
        }
      </script>


    </main>

    <script src="js/link.js"></script>

    <?php include "includes/example-footer.php"?>
  </body>
</html>
