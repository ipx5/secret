import {WFMComponent, router, http} from "framework"
import axios from 'axios';

class ExplorePageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data = {
            ip: 'loading',
            posts: `loading`
        }
    }

    afterInit() {
        http.get('http://secret.com/posts').then(res => {
            this.data.posts = res.data;
        }).then(res => console.log(this.data.posts)).then(res => this.render());
    }
}

export const explorePageComponent = new ExplorePageComponent({
    selector: 'app-explore-page',
    template: `
    <p class="flow-text" >Explore</p>
    <div class="row">
    <div>{{ posts | postsPipe}}</div>
    `
});