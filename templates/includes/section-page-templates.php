<template id="page-list">
    <div class="plp">
        <div class="plp-list">
            ${content}
        </div>
    </div>
</template>

<template id="page-list__heading">
    <h2>${headingText}</h2>
    ${content}
</template>

<template id="page-list-item">
    <a href="${slug}.php" class="item-wrapper">
        <div class="icon-wrapper">
            <h3 class="page-list__title" id="${slug}__page" >${visibleTitle}<span class="sr-only">.</span></h3>
            <div class="icon">
                <img src="images/icons/${page}/${slug}.${thumbFileType}" alt="" role="presentation">
            </div>
        </div>
        <div class="links-wrapper">
            <p>${desc}</p>
        </div>    
    </a>
</template>