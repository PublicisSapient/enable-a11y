

<script src="js/modules/input-mask.js" type="module"></script>


<script>
    const amexMask = "9999 999999 99999";
    const otherMask = "9999 9999 9999 9999";
    const ccEl = document.getElementById('cc');
    const ccTypeContainerEl =  document.getElementById('cc-type-container');
    setHintText(otherMask);

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
        if (ccEl.dataset.mask !== val) {
            ccEl.dataset.mask = val;
            ccEl.maxLength = val.replace(/\s/g, '').length;
        }
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
            setHintText(amexMask);
        } else {
            setHintText(otherMask);
        }

    }
</script>
-->