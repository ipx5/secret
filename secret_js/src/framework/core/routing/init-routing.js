import {_} from "../..";
import {RoutingModule} from "./routing.module";

export function initRouting(routes, dispathcer) {
    if (_.isUndefined(routes)) return;
    let routing = new RoutingModule(routes, dispathcer);
    routing.init();
}