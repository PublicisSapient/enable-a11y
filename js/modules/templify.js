/* eslint-disable no-console */
import { interpolate } from './interpolate.js';
import EnableFlyoutHamburger from './enable-hamburger.js';


class Templify {
    constructor(element, props) {
        this.props = props;
        this.element = element;
        this.className = 'flyout-menu';
        this.contentToken = '${html:content}';
        this.varRe = /\$\{[^}]*}/g;

        console.log('content', this.props.content);

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
            console.log('template', id);
            html = interpolate(templateHTML, props);
            if (html.indexOf(this.contentToken) > -1) {
                const contentHTML = this.renderContent(content);
                if (contentHTML === '') {
                    console.log('content: ', content);
                }
                html = html.replace(this.contentToken, contentHTML);
            } else {
                console.log(`no content for template ${id}`);
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


export default Templify;