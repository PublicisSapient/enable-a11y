
<div id="<?= $id ?>">

</div>

<?php includeShowcode("$id", "", "", "", false); ?>
<script type="application/json" id="<?= $id ?>-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "<?= $label ?>",
    "highlight": "%INLINE%<?= $id ?>__template",
    "notes": ""
  }]
}
</script>

<template id="<?= $id ?>__template" data-type="text"><?= trim($code) ?>
</template>