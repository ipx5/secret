import {WFMComponent, router, http} from "framework";

class PostPageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data = {
            posts: 'e',
            title: 'Главная страница',
            link: 'Другая страница',
            ip: 'loading'
        }
    }

    getPostList(posts) {
        this.data.posts += posts.forEach(post => {
            console.log(post);
            return `
            <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">${post.title}}
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">${post.text}}</i></a>
        </div>
        <div>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
        `
        })
        this.render()
    }
}

export const postPageComponent = new PostPageComponent({
    selector: 'app-post-page',
    template: `
        
    `
});