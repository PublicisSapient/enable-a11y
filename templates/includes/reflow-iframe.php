<?php
  $url = 'reflow__example-of-issue.php?' . $queryString . '&copy=' . $copy . '&heading=' . urlencode($heading);
?>
<iframe class="reflow-example__frame"
  src="<?= $url ?>"
  title="<?= urlencode($title) ?>"
>
</iframe>

<p class="center margin-bottom">
<a href="<?= $url ?>" target="blank">Open the above iframe in a new window</a>
</p>