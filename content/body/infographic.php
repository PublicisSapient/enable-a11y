<p>
   Infographics are visual representations of information, data, or knowledge designed to present complex information
   quickly and clearly. They combine graphics, charts, and text to simplify and convey a message in an engaging and
   easy-to-understand format. If you want to be equitable, you should convey all the information in an accessible way.
</p>

<h2>Infographics using bitmap image</h2>
<p>
   If I am using infographics using a bitmap, should all information be in the <code>alt</code> ? We prefer to minimize
   the use of extensive
   alt text whenever possible, opting instead to provide detailed descriptions within the main text. This approach is
   often easier for screen reader users who find navigating live text simpler than alt text. As suggested in the
   <a target="blank"
      href="https://sc.edu/about/offices_and_divisions/digital-accessibility/toolbox/best_practices/alternative_text/infographic-alt-text/index.php">Infographic
      Alt Text</a>
   article, one can use a short summary for alt text and place a more detailed description within the main text
   underneath.
</p>

<p>
   The information on this page is also covered in the <a target="blank"
      href="https://www.w3.org/WAI/tutorials/images/complex/">W3C's Complex Images Tutorial</a>.  We do note we did not implement their recommendation of using <code>longdesc</code> since it is on <a href="https://html.spec.whatwg.org/multipage/obsolete.html">the list of obsolete HTML tags on the WHATWG specification</a>.
</p>

<div id="infographics-bitmap-example" class="enable-example">
   <img src="images/infographics/infographics_bitmap.png" class="infographic-bitmap__img"
      alt="Infographic illustrating the size of a petabyte, showcasing its equivalent storage capacity in terms of data, movies, and digital photos it can hold.">
      <details class="enable-drawer">
         <summary class="enable-drawer__button">
            Description of the above image
         </summary>
         <div class="content">
            <h3>Do you know how big is a Petabyte?</h3>
            <p> It would take you over 2.5 years of nonstop binge watching or 11, 000 movies to get through a petabyte's worth
               of 4k movies.<br />
               There is 20+ PB of data in the library of congress.<br />
               If you take a petabyte's worth of 1GB flash drives and lined them up end to end, they would stretch over 92
               football fields.<br />
               You can have 4,000 digital photos everyday for the rest of your life.<br/>
               Sources fo this image are Lifewire.com, Blogs.loc.gov and cobaltiron.com.
            </p>
         </div>
      </details>
</div>

<?php includeShowcode("infographics-bitmap-example"); ?>
<script type="application/json" id="infographics-bitmap-example-props">
{
  "replaceHtmlRules": {},
  "steps": [{
    "label": "Add an alt attribute",
    "highlight": "alt",
    "notes": "You can add a short summary of the image to alt text"
  },
  {
    "label": "Define the long description",
    "highlight": "content",
    "notes": "Contains the description of the image"
  }]
}
</script>

<h2>Infographics using Scalable Vector Graphics(SVG)</h2>

<p>If an SVG (Scalable Vector Graphics) is used for infographics, and the text within it would accurately describe the information inside the infographics, then SVG authors should ensure the text nodes are read 
   from top to bottom, left to right. As mentioned in 
   <a href="https://www.sitepoint.com/tips-accessible-svg/https://www.sitepoint.com/tips-accessible-svg/">Tips for Creating Accessible SVG</a> by <a href="https://tink.uk/">Léonie Watson</a>, the best way to make SVG accessible to Assistive Technologies (AT) like screen readers and speech
         recognition tools is to put it directly into your HTML using the <code>svg</code> tag, instead of embedding it using the <code>img</code> tag.
</p>

<p>
   Here is an example of an embedded SVG with accessible text:
</p>

<div id="infographics-svg-example" class="enable-example">
   <?php includeFileWithVariables(
       "../images/infographics/infographics_vector.svg",
   ); ?>
   <!-- added this paragraph as the title and description of SVG is not getting ready by the screen reader on mobile device -->
<div class="center">This image is based on this <a href="https://www.freepik.com/free-vector/template-with-steps-infographic_7065848.htm#fromView=search&page=1&position=1&uuid=f3f7c521-06a3-4350-b4a7-a77669f967b3">template with steps for infographic</a> on from <a href="https://www.freepik.com">Freepik</a></div>

</div>

<?php includeShowcode("infographics-svg-example"); ?>
<script type="application/json" id="infographics-svg-example-props">
{
  "replaceHtmlRules": {},
  "steps": [
   {
    "label": "Add the paths and images to a group, and include the aria-hidden attribute on the group so that it is not read.",
    "highlight": "aria-hidden",
    "notes": "Adding aria-hidden to images, paths or groups inside SVGs prevents screen readers from reading them aloud, which is useful when the images are purely decorative or serve no informative purpose for users relying on auditory interfaces. If possible, try to place all the images and paths inside one group. If that's not feasible, you may need to distribute your images and paths across several groups."
  },
  {
    "label": "Reposition the text nodes and, if feasible, group them together inside a <g> (group) tag.",
    "highlight": "text",
    "notes": "Reposition the text nodes so that the screen reader reads them from top to bottom and left to right.Grouping text nodes when the content within the group is logically related can aid in making the content more accessible."
  }]
}
</script>
<h2>Screen Reader Inconsistency</h2>
When using a SVG for infographics, there may be scenarios where VoiceOver (VO) in Safari reads non-clickable text
elements as links. To resolve this issue, follow these steps:
<ol>
   <li>VoiceOver (VO) in Safari may announce your <code>text</code> element as a link due to the presence of a
      <code>tspan</code> element within it, which it might interpret as an interactive link. To address this, use
      only text elements and position them using the 'x' and 'y' attributes.</li>
   <li>Additionally, when an id attribute is present on a <code>text</code> element, it can sometimes be
      misinterpreted as indicating interactive or clickable content.</li>
</ol>
<h2>Testing Consideration</h2>
<p>Please ensure that the SVG doesn't have attributes such as 'inkscape' and 'sodipodi' within it for the unit tests to pass.</p>
