<template id="section-table-of-contents">
    <div class="sidemenu">
        <div class="sidemenu__list">
            ${subsections}
        </div>
    </div>
</template>

<template id="section-subsection">
    <h3 class="sidemenu__title">${subsectionTitle}</h3>
    ${subsectionLinks}
</template>

<template id="section-link">
    <p class="sidemenu__item"><a href="#${slug}__page">${visibleTitle}</a></p>
</template>

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
    <a href="/${slug}.php" class="item-wrapper">
        <div class="icon-wrapper">
            <h3 class="page-list__title id="${slug}__page" >${visibleTitle}</h3>
            <div class="icon">
                <img src="/images/icons/${page}/${slug}.${thumbFileType}" alt="" role="presentation">
            </div>
        </div>
        <div class="links-wrapper">
            <p>${desc}</p>
        </div>    
    </a>
</template>