import {WFMDirective} from "../../../framework";

class AppChangeDirective extends WFMDirective {
    constructor(config) {
        super(config)
    }
}

export const appChangeDirective = new AppChangeDirective({
    selector: '[onChange]',
    onInit(element, func = 'blue') {

        let defaultColor = element.css().color;

        element.on('mouseenter', () => {
            element.css({color})
        });
        element.on('mouseleave', () => {
            element.css({color: defaultColor})
        })
    }
});