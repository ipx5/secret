import {WFMComponent, router, http} from "framework"
import axios from 'axios';

class ExplorePageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data = {
            // title: 'Главная страница',
            // link: 'Другая страница',
            ip: 'loading',
            posts: `loading`
        }
    }

    events() {
        return {
            // 'click .white-text': 'goToTabs'
        }
    }

    afterInit() {
        http.get('http://secret.com/posts/1').then(res => {
            this.data.posts = res.data;
        }).then(res => console.log(this.data.posts)).then(res => this.render());
    }



    goToTabs(event) {
        console.log(event.target)
        // event.preventDefault();
        // router.navigate('tabs');
    }

    getPostList(posts) {
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