import {_} from "../..";
import {renderComponent} from "./render-component";

export function initComponents(bootstrap, components) {
    if (_.isUndefined(bootstrap)) {
        throw new Error(`Boostrap component is not defined`);
    }

    [bootstrap, ...components].forEach(renderComponent);
}