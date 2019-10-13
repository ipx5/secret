import {WFMDirective} from "../../../framework";

class AppClickDirective extends WFMDirective {
    constructor(config) {
        super(config)
    }
}

export const appClickDirective = new AppClickDirective({
    selector: '[onClick]',
    onInit(element, func = 'blue') {
        console.log(element)
    }
});