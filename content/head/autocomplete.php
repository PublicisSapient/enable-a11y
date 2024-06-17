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
                animation: {
                    "accordion-down": "accordion-down 0.2s ease-out",
                    "accordion-up": "accordion-up 0.2s ease-out",
                },
            }
        }
    }
</script>