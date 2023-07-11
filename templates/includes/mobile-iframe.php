<?php
  $fullURL = $url . '?' . $queryString . '&copy=' . $copy . '&heading=' . urlencode($heading);
?>
<iframe class="reflow-example__frame"
  src="<?= $fullURL ?>"
  title="<?= urlencode($title) ?>"
>
</iframe>

<p class="center margin-bottom">
<a href="<?= $fullURL ?>" target="blank">Open the above iframe in a new window</a>
</p>