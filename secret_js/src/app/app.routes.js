import {homePageComponent} from "./pages/home-page.component";
import {tabsPagePageComponent} from "./pages/tabs-page.component";
import {notFound} from "./shared/not-found.component";
import {directivePageComponent} from "./pages/directive-page.component";
import {pipePageComponent} from "./pages/pipes-page.component";

export const appRoutes = [
    { path: '', component: homePageComponent },
    { path: 'tabs', component: tabsPagePageComponent },
    { path: 'directive', component: directivePageComponent },
    {path: '**', component: notFound},
    { path: 'pipe', component: pipePageComponent },
];