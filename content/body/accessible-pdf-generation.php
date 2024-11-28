<p>This guide will demonstrate creating a SpringBoot app that implements the Open HTML to PDF library to generate an accessible PDF. </p>


<h2>Background</h2>
<p>As developers on the AID tool, we want to create a program that takes HMTL and automatically convert it to an accessible PDF.  However, most libraries that convert HTML to a PDF do not have the ability to create an accessible PDF.  Zoltan found a library called Open HTML to PDF that will generate accessible PDFs.
<a href="https://github.com/danfickle/openhtmltopdf">The repopository for Open HTML to PDF can be found here.</a> 
However, it is a Java library and we did not previously have anything that could directly integrate with this.  Therefore, we decided to build a SpringBoot app that allows us to interact with this library and create these accessible PDFs.  This article will walk you through creating a Java SpringBoot app that integrates the OpenHTMLToPDF library.</p>


<h2>Pre-Requisites</h2>
<p>You will need the following installed on your machine:
<ul>
    <li>Java 17</li>
    <li>Maven</li>
</ul>
We will be using SpringBoot, a Java Framework, to develop this app.  If you are unfamiliar with this technology, 
<a href="https://www.ibm.com/topics/java-spring-boot">please see here for more information about SpringBoot.</a>
We will be using the Open HTML to PDF library to create an accessible PDF.  
<a href="https://github.com/danfickle/openhtmltopdf">The repository for Open HTML to PDF for can be found here.</a>  
We will provide references to specific pages that are of interest in the tutorial as applicable.


<h2>Step 1</h2>
<p>We will use the Spring initializer to create a new SpringBoot project. 
<a href="https://start.spring.io/">The Spring initializer tool can be found here.</a>  
This will generate a new SpringBoot project that we will use as the basis for our accessible PDF app.  Open HTML to PDF is injected as a maven dependency, so select “Maven” under project.  
We will be using Java as the language.  Select the latest version of SpringBoot.  In the metadata, add a name, artifact, name, and description relevant to your project (package name is automatically generated, but you can change this to suit your needs).  
Under packaging, we will be selecting Jar, as it works best for our deployment configuration, but please select the packaging that is relevant to your project.  Open HTML to PDF is compatible with, at latest, Java 17, so select Java 17.  The screenshot below describes the configuration that we used.  
Once you have selected your desired configuration, click on generate, and uncompress the generated zip file.  Open this folder in an IDE.</p>
<img src="images/accessible-pdf-generation/step-1.png" alt="A screenshot of the Spring Initializer tool.  The settings are set to those described in the paragraph about Step 1." />


<h2>Step 2</h2>
<p>Navigate to the pom.xml file.  This file controls the dependencies in the code.  This is where we will be adding in the dependency for the Open HTML to PDF.  Following the 
<a>implementation guide in the Open HTML to PDF repository,</a> 
we will add the necessary dependencies to the pom.xml file.  If your PDF does not contain images, right to left test, SVGs, or MathML, you will only need to add the first 2 dependencies found under the “MAVEN ARTIFACTS” section of the article.  We will also need to add the Open HTML to PDF version under the properties section.  
After adding the necessary dependencies and properties for our project, the properties and dependencies tags will similar to below.

<?php includeShowcode("step-2-sample-pom", "", "", "", false, 4); ?>
<template id="step-2-sample-pom" data-showcode-is-java="true">
...
&lt;properties&gt;
    &lt;java.version&gt;17&lt;/java.version&gt;
    &lt;openhtml.version&gt;1.0.10&lt;/openhtml.version&gt;
&lt;/properties&gt;
&lt;dependencies&gt;
    &lt;dependency&gt;
        &lt;groupId&gt;org.springframework.boot&lt;/groupId&gt;
        &lt;artifactId&gt;spring-boot-starter&lt;/artifactId&gt;
    &lt;/dependency&gt;

    &lt;dependency&gt;
        &lt;groupId&gt;org.springframework.boot&lt;/groupId&gt;
        &lt;artifactId&gt;spring-boot-starter-test&lt;/artifactId&gt;
        &lt;scope&gt;test&lt;/scope&gt;
    &lt;/dependency&gt;
    &lt;dependency&gt;
        &lt;!-- ALWAYS required, usually included transitively. --&gt;
        &lt;groupId&gt;com.openhtmltopdf&lt;/groupId&gt;
        &lt;artifactId&gt;openhtmltopdf-core&lt;/artifactId&gt;
        &lt;version&gt;${openhtml.version}&lt;/version&gt;
    &lt;/dependency&gt;

    &lt;dependency&gt;
        &lt;!-- Required for PDF output. --&gt;
        &lt;groupId&gt;com.openhtmltopdf&lt;/groupId&gt;
        &lt;artifactId&gt;openhtmltopdf-pdfbox&lt;/artifactId&gt;
        &lt;version&gt;${openhtml.version}&lt;/version&gt;
    &lt;/dependency&gt;
    &lt;dependency&gt;
        &lt;groupId&gt;org.springframework.boot&lt;/groupId&gt;
        &lt;artifactId&gt;spring-boot-starter-web&lt;/artifactId&gt;
    &lt;/dependency&gt;
&lt;/dependencies&gt;
...
</template>


<h2>Step 3</h2>
<p>We are going to begin to build out a Java file to act as our endpoint to generate a PDF.  To do this, first create a new file at the same level as the automatically generated java file under src/main/java/[your package name].   In our case, it is at the same level as “AccessiblePDFSpringApplication.java”.  
We will call our new file AccessiblePDFController.java.  We will be creating a Controller file, would marks a class as a web request handler.</p>
<img src="images/accessible-pdf-generation/step-3.png" alt="A screenshot of the file structure of the project, showing a new file created in the java/com/publicissapient/aid/accessiblepdfspring called AccessiblePDFController.java." />


<h2>Step 4</h2>
<p>Then, we will start to add to this file to build out our endpoint.  First, we will mark the class as a REST controller by adding @RestController above the class declaration.</p>
<?php includeShowcode("step-4-sample-code", "", "", "", false, 4); ?>
<template id="step-4-sample-code" data-showcode-is-java="true">
@RestController
public class AccessiblePDFController {
    
}
</template>


<h2>Step 5</h2>
<p>Then, we will add a method and have it return a ResponseEntity&lt;byte[]&gt;, since we will be sending the response body as byte array.  This method will need to throw an exception.  You will see an error as we do not have a ResponseEntity as a return value yet, but we will add this in a later step.</p>
<?php includeShowcode("step-5-sample-code", "", "", "", false, 4); ?>
<template id="step-5-sample-code" data-showcode-is-java="true">
@RestController
public ResponseEntity&lt;byte[]&gt; genratePDF() throws Exception {
}
</template>


<h2>Step 6</h2>
<p>We will now create a new file so that we can properly parse the body that is sent to the endpoint in the request.  This will also be at the same level as the Controller file.  We have named ours “HTMLBody.java”. See below for the structure.</p>
<img src="images/accessible-pdf-generation/step-6.png" alt="A screenshot of the file structure of the project, showing a new file created in the java/com/publicissapient/aid/accessiblepdfspring called HTMLBody.java."/>
<p>For our purposes, we will send the HTML to the SpringBoot app as a string, and we will also send the filename, which will be the name of the file that we want to generate.  To consume this information properly, we will create a class that has 2 properties, a String html and a String filename.  The code will look like this:</p>
<?php includeShowcode("step-6-sample-code", "", "", "", false, 4); ?>
<template id="step-6-sample-code" data-showcode-is-java="true">
public class HTMLBody {
    public String html;
    public String filename;
}
</template>


<h2>Step 7</h2>
<p>We will now add the request body as an argument to our method.  This will use the class that we created in the previous step.  In addition to this, we will add the @CrossOrigin annotation, which enables cross-origin resource sharing only for this specific method.  We will also be adding the @PostMapping annotation, which binds the method to an endpoint.  
In the @PostMapping annotation, we will be adding the destination that we want the endpoint at, as well as the format of the body of the request, which in our case is JSON.</p>
<?php includeShowcode("step-7-sample-code", "", "", "", false, 4); ?>
<template id="step-7-sample-code" data-showcode-is-java="true">
@CrossOrigin
@PostMapping(value = "/yourEndpointHere", consumes = MediaType.APPLICATION_JSON_VALUE)
public ResponseEntity&lt;byte[]&gt; genratePDF(@RequestBody HTMLBody html) throws Exception {
}
</template>


<h2>Step 8</h2>
<p>Now, we will add fonts to our project.  Note that this is an extremely important step as the PDF will not generate if you do not provide fonts.  First, download the fonts that you would like.  We found ours on 
<a href="https://fonts.google.com/">Google Fonts.</a>  
Be sure that the fonts that you select are free for commercial use.  We downloaded 2 fonts, one for normal text and another for code snippets.  These files should be in .ttf format.  After downloading these fonts, we will add them to the resources folder.</p> 
<img src="images/accessible-pdf-generation/step-8.png" alt="A screenshot of the file structure of the project, showing 2 .ttf files added to the src/main/resources folder.">
<p>We will add these fonts as resources in our pom.xml file so that we can access them in our Java code.  In your pom.xml add the fonts under &lt;build&gt;, then &lt;plugins&gt;.  You will add a &lt;resources&gt; tag, with a &lt;resource&gt; tag, then a &lt;directory&gt; tag, with the &lt;includes&gt; and &lt;include&gt; tag that specifies the name of the files that you would like to access in your Java code.</p>
<?php includeShowcode("step-8-sample-code", "", "", "", false, 4); ?>
<template id="step-8-sample-code" data-showcode-is-java="true">
...
    &lt;build&gt;
        ...
        &lt;resources&gt;
            &lt;resource&gt;
                &lt;directory&gt;src/main/resources&lt;/directory&gt;
                    &lt;includes&gt;
                        &lt;include&gt;Your-Font.ttf&lt;/include&gt;
                        &lt;include&gt;Your-Other-Font.ttf&lt;/include&gt;
                    &lt;/includes&gt;
            &lt;/resource&gt;
        &lt;/resources&gt;
        ...
    &lt;/build&gt;
...
</template>


<h2>Step 9</h2>
<p>We will now add code to deal with the font files.  The Open HTML to PDF library needs the files to be in Java File format, so we will add code to do this.  Since the files are under the resource folder, they will be loaded as resources rather than files.  We will convert the resource into a steam and then write that to a file that is accessible from our controller class.  
We will delete the temporary font files that we’ve generated from the resource stream after we’re done converting the PDF, so we will add code to handle this as well.  The code below is added to our controller file to handle the fonts.</p>
<?php includeShowcode("step-9-sample-code-1", "", "", "", false, 4); ?>
<template id="step-9-sample-code-1" data-showcode-is-java="true">
ClassLoader classloader = Thread.currentThread().getContextClassLoader();

InputStream font1 = classloader.getResourceAsStream("Your-Font.ttf");
InputStream font2 = classloader.getResourceAsStream("Your-Other-Font.ttf");

File fontFile1 = new File("OpenSans-Regular.ttf");
copyInputStreamToFile(font1, fontFile1);
File fontFile2 = new File("SourceCodePro-VariableFont_wght.ttf");
copyInputStreamToFile(font2, fontFile2);
</template>
<p>With the copyInputStreamToFile helper class:</p>
<?php includeShowcode("step-9-sample-code-2", "", "", "", false, 4); ?>
<template id="step-9-sample-code-2" data-showcode-is-java="true">
// https://mkyong.com/java/how-to-convert-inputstream-to-file-in-java/
private static void copyInputStreamToFile(InputStream inputStream, File file) throws IOException {
    try (FileOutputStream outputStream = new FileOutputStream(file, false)) {
        int read;
        byte[] bytes = new byte[DEFAULT_BUFFER_SIZE];
        while ((read = inputStream.read(bytes)) != -1) {
            outputStream.write(bytes, 0, read);
        }
    }
}
</template>


<h2>Step 10</h2>
<p>We will now implement the Open HTML to PDF library in our controller file to convert the HTML we have sent as a string in the request body to PDF format.  We will be following the article in the repository called 
<a href="https://github.com/danfickle/openhtmltopdf/wiki/PDF-Accessibility-(PDF-UA,-WCAG,-Section-508)-Support">“PDF Accessibility (PDF UA, WCAG, Section 508 Support’.</a>  
In the section “Builder Example”, you will see the code that we will need to add to our project.  Adapting this to the steps before, we will add the following to our code:
<?php includeShowcode("step-10-sample-code", "", "", "", false, 4); ?>
<template id="step-10-sample-code" data-showcode-is-java="true">
try (FileOutputStream os = new FileOutputStream("./" + html.filename + ".pdf")) {

    PdfRendererBuilder builder = new PdfRendererBuilder();
    builder.useFastMode(); 
    builder.usePdfUaAccessbility(true); 
    // may be required: select the level of conformance
    builder.usePdfAConformance(PdfRendererBuilder.PdfAConformance.PDFA_3_U);
    // Remember to add one or more fonts. Only .ttf fonts are supported.  
    //For font families do not use "serif", "sans-serif", or "monospace" as this causes an error.
    builder.useFont(fontFile1, "BodyFont");
    builder.useFont(fontFile2, "CodeFont");
    builder.withHtmlContent(html.html, "");
    builder.toStream(os);
    builder.run();

} catch (Exception e) {

}
</template>
<p>IMPORTANT: please see the lines with builder.useFont(…).  The second argument in this method MUST match the font family that you have in the CSS that you send in the HTML string, and this MUST NOT match any of the font families that you would typically expect to see (such as serif, sans-serif, or monospace), but rather must be unique. 
If this font convention is not followed, your PDF will not generate properly, and you will likely get an extremely vague error message, usually from the Open HTML to PDF library saying that you did not provide fonts.  If you get that error message, come back to this step and ensure that you have added the fonts properly and that the font families specified in your CSS match those that you have specified in your Java code.</p>


<h2>Step 11</h2>
<p>We will now add the code to convert the PDF to a byte array, as this is the format that we will be sending back in the response.</p>
<?php includeShowcode("step-11-sample-code", "", "", "", false); ?>
<template id="step-11-sample-code" data-showcode-is-java="true">
byte[] inFileBytes = Files.readAllBytes(Paths.get("./" + html.filename + ".pdf"));
byte[] contents = java.util.Base64.getEncoder().encode(inFileBytes);
</template>


<h2>Step 12</h2>
<p>We will now add the code needed to send a response.  This will involve creating the headers needed and then setting the ResponseEntity.  We will add this for both the case where we are successful in generating a PDF, sending an OK status, and in the catch block that we will be in if we are not successful in generating a PDF, in which case we will send a 400 error.  We will also send that the content form of the response is a PDF.  See how we implemented this in the code below.</p>
<?php includeShowcode("step-12-sample-code", "", "", "", false); ?>
<template id="step-12-sample-code" data-showcode-is-java="true">
try {
    // code for generating PDF omitted
} catch (Exception e) {
    HttpHeaders headers = new HttpHeaders();
    headers.setContentType(MediaType.APPLICATION_PDF);
    headers.setContentDispositionFormData(html.filename, html.filename);
    headers.setCacheControl("must-revalidate, post-check=0, pre-check=0");
    // set response
    ResponseEntity&lt;byte[]&gt; response = new ResponseEntity&lt;&gt;(null, headers, HttpStatus.BAD_REQUEST);
    return response;
} 

// code for generating byte array omitted
         
// set headers for the response
HttpHeaders headers = new HttpHeaders();
headers.setContentType(MediaType.APPLICATION_PDF);
headers.setContentDispositionFormData(html.filename, html.filename);
headers.setCacheControl("must-revalidate, post-check=0, pre-check=0");

// set reponse
ResponseEntity&lt;byte[]&gt; response = new ResponseEntity&lt;&gt;(contents, headers, HttpStatus.OK);
return response;
</template>


<h2>Step 13</h2>
<p>We are now able to run this app locally.  Use the command mvn spring-boot:run to run the program.  The endpoint will usually be at http://localhost/yourEndpointName.</p>


<h2>Step 14</h2>
<p>Integrate the endpoint into your existing code.  We have included a JavaScript example to convert a byte array into a PDF and to automatically save the resulting PDF.</p>
<?php includeShowcode("step-14-sample-code", "", "", "", false); ?>
<template id="step-14-sample-code" data-showcode-is-java="true">
function base64ToArrayBuffer(base64) {
    var binaryString = window.atob(base64);
    var binaryLen = binaryString.length;
    var bytes = new Uint8Array(binaryLen);
    for (var i = 0; i < binaryLen; i++) {
      var ascii = binaryString.charCodeAt(i);
      bytes[i] = ascii;
    }
    return bytes;
}

function saveByteArray(reportName, byte) {
    var blob = new Blob([byte], { type: "application/pdf" });
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    var fileName = reportName;
    link.download = fileName;
    link.click();
};
</template>


<h2>Troublshooting</h2>
<p>You may run into some issues once you have integrated the new endpoint in with your code.  This is most likely because you have elements in your HTML that the Open HTML to PDF library is not able to parse.  Though you may get an error indicating that you did not provide a font or that there is an element that the library does not recognize or is malformed, we found that most of these errors were caused by having elements in our HTML that the library could not parse properly.  
To fix this, we removed all buttons, all images (there is a way to keep images, the 
<a href="https://github.com/danfickle/openhtmltopdf/wiki/Plugins:-SVG-Images">documentation for SVG images can be found here</a> 
and 
<a href="https://github.com/danfickle/openhtmltopdf/wiki/Java2D-Image-Output">more documentation for Java 2D images here</a>
, but the only images in our PDF were indicators that a link would open in a new tab, so we elected to remove them), all lists (both ordered and unordered), which were replaced with paragraph tags in the order that we wanted the information displayed, and all code tags which we replaced with &lt;p&gt; tags with corresponding CSS that had the font family set to the code font that we provided the Spring app with.  
There may be other tags that are not recognized that we have not yet come across.</p>
<p>We also had to replace any tags that we wanted to display as text with "&lt;" and "&gt;", and any spaces within link tags (&lt;a&gt;) with "&nbsp;".</p>
<p>Most errors from the library are unfortunately extremely vague.  We have found that all the ones that we have found are fixed by following the advice above, as well as double checking the work that you did in Step 10 in adding the fonts.  To troubleshoot further, we have found that, though slow, the best method to find what HTML is causing the error is to start with small amounts of HTML and then slowly add more in until you see where the problem is.  For example, we would start with the following HTML string:</p>
<?php includeShowcode("troubleshooting-sample-code", "", "", "", false); ?>
<template id="troubleshooting-sample-code" data-showcode-is-java="true">
let html = `&lt;html lang="en"&gt;
    &lt;head&gt;
    &lt;title&gt;${title}&lt;/title&gt;
    &lt;meta name="subject" content="Subject"&gt;&lt;/meta&gt;
    &lt;meta name="description" content="Description"&gt;&lt;/meta&gt;
    &lt;meta name="author" content="Author"&gt;&lt;/meta&gt;
    &lt;style&gt;${yourCSS}&lt;/style&gt;
    &lt;/head&gt;
    &lt;body&gt;&lt;/body&gt;&lt;/html&gt;`;
</template>
<p>And then slowly add body elements until we found one that caused the bug.  So, for the next test we would add in the header to our report, then the table, then the column headers, then a single row, etc., until we isolated where the error was coming from.  For us, this was usually a tag that was not able to be parsed by the library, so we would either remove this tag if it was not necessary or find a way to express the information using other tags if it needed to be included.</p>


<h2>Feedback from a Screen Reader User</h2>
<p>We had the help of Vishnu Ramchandani, a screen reader user, to test our implementation for accessible PDFs.  He had the feedback below.  We have also shared with these points how we were able to remedy the issues or if it is a limitation of the technology.
<ol>
    <li>Page title:  To ensure consistency and clarity, the document title and the filename should both be same and should be meaningful. 
    <ul><li>We remedied this issue by changing the title to be the same as the filename, but this is a point to remember while you are implementing your solution.</li></ul></li>
    <li>Reading behavior of lengthy paragraphs in tables: Screen reader users experience line breaks when reading lengthy paragraphs in table columns using arrow keys. A paragraph is read in a broken manner, making it hard to follow. Ensure that lengthy paragraphs are presented in a linear, single-column format when possible. This helps screen readers read the content in a logical order without breaking lines.
    <ul><li>Unfortunately, this is a limitation of PDF technology.  We recommend keeping lines short in table rows to remedy this situation, but sometimes this was not possible for us.</li></ul></li>
    <li>Issue with Splitting URLs/Links: A single URL or link splits into multiple lines, making screen reader users think there are multiple links instead of a single one.  To prevent links from splitting across multiple lines, consider the following approaches: Use non-breaking spaces (&nbsp;) between words in the link text to prevent line breaks. Apply CSS to ensure the link text does not break into multiple lines. For example, using white-space: nowrap; can help keep the link text on a single line.
    <ul><li>Like in point 2, this is unfortunately a limitation in PDFs.  Again, we recommend keeping links shorter (while still having appropriate and descriptive link text). </li></ul></li>
</ol>
</p>


<h2>Thanks and Contact Us</h2>
<p>Thank you so much for following this guide to create an app to generate accessible PDFs!  If you have any questions or feedback, please reach out to the AID team.  We look forward to hearing from you.</p>

