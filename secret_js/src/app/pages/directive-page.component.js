import {WFMComponent, router} from "framework";

class DirectivePageComponent extends WFMComponent {
    constructor(config) {
        super(config);
    }
}

export const directivePageComponent = new DirectivePageComponent({
    selector: 'app-directive-page',
    template: `
    <div class="row">
            <div class="col s12 m6 home__block">
              <h2 appHover="red">Наведи на меня!</h2>
            </div>
          </div>
        `,
    styles: `
       
    `
});