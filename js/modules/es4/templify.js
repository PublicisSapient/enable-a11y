/* eslint-disable no-console */
class Templify {
    constructor(element, props) {
        this.props = props;
        this.element = element;
        this.className = 'flyout-menu';
        this.contentToken = '${html:content}';
        this.varRe = /\$\{[^}]*}/g;

        element.innerHTML = this.renderContent(this.props.content);
    }

    renderContent(templates) {
        const html = [];

        if (templates) {
            templates.forEach((template) => {
                html.push(this.renderTemplate(template));
            });
        }

        return html.join('');
    }

    renderTemplate(template) {
        const { id, props, content } = template;
        const $template = document.getElementById(id);
        let html;

        if ($template) {
            const templateHTML = $template.innerHTML;
            html = interpolate(templateHTML, props);
            if (html.indexOf(this.contentToken) > -1) {
                const contentHTML = this.renderContent(content);
                html = html.replace(this.contentToken, contentHTML);
            }

            /* Let's remove all other variables that haven't been used. */
            if (html.match(this.varRe) !== null) {
                html = html.replace(this.varRe, '');
            }
        } else {
            html = `%${id}%`;
        }

        return html;
    }
}