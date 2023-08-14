

<script>
    const amexPlaceholder = "__ ______ _____";
    const otherPlaceholder = "____ ____ ____ ____";
    const ccEl = document.getElementById('cc');
    const ccTypeContainerEl =  document.getElementById('cc-type-container');
    setHintText(otherPlaceholder);

    function isAmex(val) {
        return (val.indexOf('34') === 0);
    }

    function isMasterCard(val) {
        return val.match(/^(5[1-5]|22[0-1]|2220|272[1-9]27[3-9])/);
    }

    function isVisa(val) {
        return (val.indexOf('4') === 0);
    }

    function isDiscover(val) {
        return val.match(/^(36|38|39|64|65|60|62|81)/);
    }

    function setHintText(val) {
        ccEl.placeholder = val;
        ccEl.dataset.placeholder = val;
    }

    function setCardType(type) {
        ccTypeContainerEl.innerHTML = type;
    }
    
    
    // Ensure credit card number is visually formatted correctly
    ccEl.addEventListener('input', changeEvent);
    function changeEvent(e) {
        const { target } = e;
        const { value } = target;
        if (isAmex(value)) {
            setHintText(amexPlaceholder);
        } else {
            setHintText(otherPlaceholder);
        }

        if (isAmex(value)) {
            setCardType('AMEX');
        } else if (isMasterCard(value)) {
            setCardType('Master Card');
        } else if (isVisa(value)) {
            setCardType('Visa');
        } else if (isDiscover(value)) {
            setCardType('Discover');
        } else {
            setCardType('');
        }
    }
</script>
<script src="./js/uswds/input-mask.js"></script>

