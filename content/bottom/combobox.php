<script src="js/modules/combobox__improved.js" type="module"></script>
<script>
        const autocompleteSubmit = new function () {
            this.init = () => {
                document.getElementById('aria-example-2a').addEventListener('combobox-change', (e) => {
                    const { currentTarget } = e;
                    const { value } = currentTarget;
                    const q = `https://www.google.com/search?${new URLSearchParams(`q=${value}`).toString()}`
                    location.href=q;
                });
            }
            this.init();
        }
    </script>