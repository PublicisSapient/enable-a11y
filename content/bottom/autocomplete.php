<!--Note: Using CDN version of Tailwind CSS here until the REACT NEXTJS project is setup.
    This is a temporary solution due to Tailwind needing PostCSS and this project using a preproccessor. 
    See here:  https://tailwindcss.com/docs/installation/play-cdn -->
    <script src="https://cdn.tailwindcss.com"></script>

<!-- adding tailwind config file with tw- prefix -->
<script>
    tailwind.config = {
        prefix: 'tw-',
        theme: {
            extend: {
                colors: {
                    primary: {
                    DEFAULT: "#000",
                    foreground: "#FFF",
                    },
                },
            }
        },
        corePlugins: {
            preflight: false, // disable preflight - prevents Tailwind from resetting all styles
        }
    }
</script>