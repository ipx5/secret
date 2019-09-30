import {WFMPipe} from "framework/index";

class AppMultiPipe extends WFMPipe{
    constructor(config) {
        super(config);
    }
}

export const appMultiPipe = new AppMultiPipe({
    name: 'multi',
    transform(value, number = 2) {
        return +value * number;
    }
});