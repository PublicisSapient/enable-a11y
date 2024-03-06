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
<script src="js/link.js"></script>