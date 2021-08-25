<!DOCTYPE html>
<html lang="en">

<head>
    <title>Improved Skip Links</title>
    <?php include "includes/common-head-tags.php";?>


    <link id="enable-skip-link-style" href="css/enable-visible-on-focus.css" rel="stylesheet" />

</head>

<body>

    <?php include "includes/example-header.php";?>

    <main>

        <aside class="notes">
            <p>
                This skip link hopefully will work for mobile browsers with screen readers as well.
            </p>
        </aside>

        <h1>Skip Link</h1>

        <h2>Traditional Skip Link</h2>

        <p>This is an example of a traditional skip link seen on many websites today.  It works well on desktop.  It fails on mobile, due to screen readers not passing screenreader focus events to the mobile browser.</p>

        <div id="desktop-example" class="enable-skip-link__example">
            <div class="enable-visible-on-focus__container enable-skip-link--begin">
                <a href="#end-of-component-1" id="beginning-of-component-1" class="enable-visible-on-focus enable-skip-link">
                    Skip to end of block
                </a>
            </div>
            <div class="fake-component">

            <p>
            Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>

            <p>
            Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>

            <p>
            Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>


            </div>
            <div class="enable-visible-on-focus__container enable-skip-link--end">
                <a href="#beginning-of-component-1" id="end-of-component-1" class="enable-visible-on-focus enable-skip-link">Skip to
                    beginning of block</a>
            </div>
        </div>

        <?php includeShowcode("desktop-example")?>

        <script type="application/json" id="desktop-example-props">
        {
            "replaceHTMLRules": {
                ".fake-component": "<!-- insert HTML with a lot of CTAs here -->"
            },
            "steps": [
                {
                    "label": "Make the first skip link point to the second one",
                    "highlight": "href=\"#end-of-component-1\" ||| id=\"end-of-component-1\"",
                    "notes": ""
                },
                {
                    "label": "Make the second skip link point to the first",
                    "highlight": "href=\"#beginning-of-component-1\" ||| id=\"beginning-of-component-1\"",
                    "notes": ""
                },
                
                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-visible-on-focus",
                    "notes": "This hides the skip link by default"
                },
                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-visible-on-focus:focus",
                    "notes": "This ensures that the skip link appears when focus is applied to it."
                }
            ]
        }
        </script>



        <h2>Mobile Friendly Skip Links</h2>

        <div id="example1" class="enable-skip-link__example">
            <div class="enable-mobile-visible-on-focus__container enable-skip-link--begin">
                <a href="#end-of-component-2" id="beginning-of-component-2" class="enable-mobile-visible-on-focus enable-skip-link">
                    Skip to end of block
                </a>
            </div>
            <div class="fake-component">

            <p>
            Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>

            <p>
            Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur <a href="#">adipiscing elit</a>. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur <a href="#">tincidunt pellentesque orci</a> id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate <a href="#">imperdiet sem</a>, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut dignissim. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac <a href="#">auctor auctor</a>, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet <a href="#">non pellentesque in</a>, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque <a href="#">bibendum odio mi</a>, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, lobortis eu purus non, ultricies convallis elit. <a href="#">Cras ex lacus</a>, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>

            <p>
            Lorem ipsum dolor sit amet, <a href="#">consectetur</a> adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci id condimentum. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>
            <p>
            Vivamus pretium eu metus ut <a href="#">dignissim</a>. Maecenas venenatis id tortor id commodo. In consectetur tempor congue. Nam justo urna, rhoncus id turpis eu, rutrum consequat nunc. Sed iaculis, ante ac auctor auctor, risus nisi convallis ligula, vel venenatis est sem eget lorem. Sed consectetur ullamcorper mattis. Maecenas eget hendrerit enim. Fusce sit amet mauris dapibus, mollis nisl imperdiet, placerat urna. Nam eu blandit orci. Morbi mollis quam quis augue molestie, et porttitor nisi blandit. Pellentesque maximus ac lectus eget tempor. Donec aliquam magna id purus congue pharetra. Vivamus rutrum est mauris, et tempor lorem faucibus ac.
            </p>
            <p>
            Integer urna turpis, imperdiet non pellentesque in, facilisis id ex. Duis at pellentesque augue. Suspendisse eleifend erat ac feugiat congue. Pellentesque bibendum odio mi, quis ullamcorper turpis pulvinar non. Proin in lacus odio. Sed iaculis mi nec fermentum elementum. Sed eget facilisis neque. Suspendisse vitae porttitor neque. Integer mattis est neque, a porttitor tortor imperdiet sed. Proin pulvinar efficitur sem, sit amet aliquam neque sollicitudin sed. Donec sagittis sapien lectus, ac tempor risus rhoncus vel.
            </p>
            <p>
            Suspendisse nibh nisi, tincidunt eget sem non, consequat placerat lacus. Nam odio massa, <a href="#">lobortis eu purus non</a>, ultricies convallis elit. Cras ex lacus, commodo eu mi rhoncus, lobortis consequat magna. Donec nec vehicula lacus, in consectetur nunc. Mauris mollis magna augue, imperdiet scelerisque lacus tempor id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi semper tellus ac diam fermentum, consectetur consectetur enim facilisis. Mauris auctor condimentum ante, quis luctus sapien pulvinar vitae. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam nec libero in enim convallis ornare.
            </p>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent feugiat neque sed urna vestibulum, ac bibendum elit rutrum. Pellentesque mollis nulla enim, euismod dignissim tortor porttitor sed. Donec malesuada feugiat pulvinar. Aliquam molestie viverra elit, ac consectetur velit maximus ut. Aenean quis justo feugiat, lobortis mi et, tincidunt lacus. Maecenas in urna ac felis molestie consequat. Curabitur dapibus lorem quis elit finibus elementum.
            </p>
            <p>
            Curabitur tincidunt pellentesque orci <a href="#">id condimentum</a>. Maecenas vitae egestas metus, eu suscipit ante. Mauris aliquam orci nec mi ullamcorper, vitae pellentesque purus semper. Donec vitae facilisis nisl. Quisque vulputate imperdiet sem, a porta nunc iaculis in. Cras elit lacus, dapibus nec iaculis eu, porttitor dapibus eros. Ut a interdum augue, sed pretium tellus. Sed vel mi leo. Ut lacus diam, luctus sed turpis id, porttitor molestie ante. Morbi ornare, nulla sit amet venenatis consectetur, lorem neque lobortis ante, ut laoreet lectus ante nec tortor. Morbi viverra ac urna in commodo. Donec eu neque vel risus laoreet condimentum. Aliquam accumsan odio diam, ut porttitor justo mattis in.
            </p>



            </div>
            <div class="enable-mobile-visible-on-focus__container enable-skip-link--end">
                <a href="#beginning-of-component-2" id="end-of-component-2" class="enable-mobile-visible-on-focus enable-skip-link">Skip to
                    beginning of block</a>
            </div>
        </div>

        <?php includeShowcode("example1")?>

        <script type="application/json" id="example1-props">
        {
            "replaceHTMLRules": {
                ".fake-component": "<!-- insert HTML with a lot of CTAs here -->"
            },
            "steps": [
                {
                    "label": "Make the first skip link point to the second one",
                    "highlight": "href=\"#end-of-component-1\" ||| id=\"end-of-component-1\"",
                    "notes": ""
                },
                {
                    "label": "Make the second skip link point to the first",
                    "highlight": "href=\"#beginning-of-component-1\" ||| id=\"beginning-of-component-1\"",
                    "notes": ""
                },
                {
                    "label": "Initialize the Javascript",
                    "highlight": "%JS% enableVisibleOnFocus.init",
                    "notes": "This sets up all the events needed for the links"
                },
                {
                    "label": "Skip Link Click Event",
                    "highlight": "%JS% enableVisibleOnFocus.clickEvent",
                    "notes": "Ensures focus goes to the skip links target in all browsers that don't do this correctly (e.g. Firefox)."
                },
                {
                    "label": "Scroll Event",
                    "highlight": "%JS% enableVisibleOnFocus.scrollEvent",
                    "notes": "This ensures that when a user uses the skip link, its target is not outside the browser's viewport."
                },
                {
                    "label": "Hide All Method",
                    "highlight": "%JS% enableVisibleOnFocus.hideAll",
                    "notes": "This method is invoked when the page is loaded, since browsers like Firefox will remember the scroll state of the component when the page is reloaded. This method is also invoked onResize and onOrientationChange, since the look of the component can look odd after these events"
                },
                {
                    "label": "CSS to style the skip link",
                    "highlight": "%CSS%enable-skip-link-style~ .enable-skip-link|width|margin-left ",
                    "notes": "This sets the CSS variable <strong>--prefers-reduced-motion</strong> to 1 if the user has asked the OS to reduce animations, and 0 otherwise."
                }
            ]
        }
        </script>


    </main>

    <?php include "includes/example-footer.php"?>

<script src="js/shared/enable-visible-on-focus.js"></script>
</body>

</html>