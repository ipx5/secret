import {homePageComponent} from "./pages/home-page.component";
import {tabsPagePageComponent} from "./pages/tabs-page.component";
import {notFound} from "./shared/not-found.component";
import {directivePageComponent} from "./pages/directive-page.component";
import {pipePageComponent} from "./pages/pipes-page.component";
import { siPageComponent } from "./pages/si-page.component";
import { suPageComponent } from "./pages/su-page.component";
import { cpPageComponent } from "./pages/cp-page.component";
import { explorePageComponent } from "./pages/explore-page.component";
import {postPageComponent} from "./pages/post.component";

export const appRoutes = [
    { path: '', component: explorePageComponent },
    { path: 'home', component: homePageComponent },
    { path: 'tabs', component: tabsPagePageComponent },
    { path: 'directive', component: directivePageComponent },
    { path: '**', component: notFound },
    { path: 'pipe', component: pipePageComponent },
    { path: 'si', component: siPageComponent },
    { path: 'su', component: suPageComponent },
    { path: 'create_post', component: cpPageComponent },
    { path: 'post', component: postPageComponent }
];