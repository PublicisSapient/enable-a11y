<template id="section-table-of-contents">
    <div class="sidemenu">
        <div class="sidemenu__list">
            ${subsections}
        </div>
    </div>
</template>

<template id="section-subsection">
    <h2 class="sidemenu__title">${subsectionTitle}</h2>
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

<template id="page-list-item">
    <a href="/${slug}.php" class="item-wrapper">
        <div class="icon-wrapper">
            <div class="page-list__title id="${slug}__page" tabindex="-1">${visibleTitle}</div>
            <div class="icon">
                <img src="/images/icons/${page}/${slug}.${thumbFileType}" alt="" role="presentation">
            </div>
        </div>
        <div class="links-wrapper">
            <p>${desc}</p>
        </div>    
    </a>
</template>