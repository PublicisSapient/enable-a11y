<!-- File WIP -->

<?php includeStats(array('doNot' => true, 'comment' => 'The accessibility of this page is questionable.')) ?>

<p>This page uses MathJax to implement
  <a href="https://www.mathjax.org/">MathML</a> in browsers that don't support it. There are browser compatibility
  issues:
</p>
<ul>
  <li>Safari with Voiceover:
    <ul>
      <li>reads this (but apparently there are some bugs)</li>
      <li>allows the user to interact with the equation.</li>
    </ul>
  </li>
  <li>NVDA with Firefox ignores the equation.</li>
</ul>




<h2>Polynomial (MathML)</h2>
<div id="equation" class="enable-example">
  <math display="block" xmlns="http://www.w3.org/1998/Math/MathML">
    <mrow>
      <mi>E</mi>
      <mo>=</mo>
      <mfrac>
        <mrow>
          <mn>2</mn>
          <mi>π</mi>
          <mi>h</mi>
          <msup>
            <mi>c</mi>
            <mn>2</mn>
          </msup>
        </mrow>
        <mrow>
          <msup>
            <mi>λ</mi>
            <mn>5</mn>
          </msup>
          <mrow>
            <mo>(</mo>
            <mrow>
              <msup>
                <mi>e</mi>
                <mrow>
                  <mi>h</mi>
                  <mi>c</mi>
                  <mo>−</mo>
                  <mi>λ</mi>
                  <msub>
                    <mi>k</mi>
                    <mi>b</mi>
                  </msub>
                  <mi>T</mi>
                </mrow>
              </msup>
              <mo>−</mo>
              <mn>1</mn>
            </mrow>
            <mo>)</mo>
          </mrow>
        </mrow>
      </mfrac>
    </mrow>
  </math>


</div>

<p>The code below is the source for the equation above. To understand how MathML works, please visit the <a href="https://developer.mozilla.org/en-US/docs/Web/MathML">MDN MathML page</a> for more information.</p>

<?php includeShowcode("equation", "", "", "", false)?>
<script type="application/json" id="equation-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "",
    "highlight": "",
    "notes": ""
  }]
}
</script>