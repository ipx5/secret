import {WFMModule} from "framework";
import { appComponent } from './app.component';
import {appHeader} from "./shared/app.header";
import {appRoutes} from "./app.routes";
import {appHoverDirective} from "./shared/directives/hover-directive";
import {appMultiPipe} from "./shared/pipes/multi-pipe";
import { appFooter } from "./shared/app.footer";
import {appClickDirective} from "./shared/directives/click-directive";
import {appPostsPipe} from "./shared/pipes/posts-pipe";

class AppModule extends WFMModule {
    constructor(config) {
        super(config)
    }
}

export const appModule = new AppModule({
    components: [

        appHeader,
        appFooter

    ],
    bootstrap: appComponent,
    routes: appRoutes,
    directives: [
        appHoverDirective,
        appClickDirective
    ],
    pipes: [
        // appMultiPipe,
        appPostsPipe
    ]
});