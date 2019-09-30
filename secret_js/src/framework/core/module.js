import {router} from "./routing/router";
import {_} from "../tools/util";
import { renderComponent } from "./component/render-component";
import {RoutingModule} from "./routing/routing.module";
import { initComponents } from "./component/init-components";
import { initRouting } from "./routing/init-routing";
import {initDirectives} from "./directives/init-directives";
import {EventEmitter} from "..";
import {initPipes} from "./pipes/init-pipes";

export class Module {
    constructor(config) {
        this.components = config.components;
        this.botstrapComponent = config.bootstrap;
        this.routes = config.routes;
        this.directives = config.directives;
        this.pipes = config.pipes;
        this.dispatcher = new EventEmitter();
    }

    start() {
        initPipes(this.pipes);

        initComponents(this.botstrapComponent, this.components);
        initRouting(this.routes, this.dispatcher);
        initDirectives(this.directives);

        this.dispatcher.on('routing.change-page', () => {
            initDirectives(this.directives);
        })
    }
}