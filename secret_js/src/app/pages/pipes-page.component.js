import {WFMComponent} from "framework";

class PipePageComponent extends WFMComponent {
    constructor(config) {
        super(config);
        this.data = {
            number: 10,
        }
    }
}

export const pipePageComponent = new PipePageComponent({
    selector: 'app-pipe-page',
    template: `
    <div class="row">
            <div class="col s12 m6 pipe__block">
              <h4>{{number}}</h4>
              <h4>{{number | multi:20}}</h4>
              <h4>{{number | multi}}</h4>
            </div>
          </div>
        `,
    styles: `
       
    `
});