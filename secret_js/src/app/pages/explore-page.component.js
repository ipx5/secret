import {WFMComponent, router, http} from "framework";

class ExplorePageComponent extends WFMComponent {
    constructor(config) {
        super(config);

    //     this.data = {
    //         title: 'Главная страница',
    //         link: 'Другая страница',
    //         ip: 'loading'
    //     }
    }

    // events() {
    //     return {
    //         'click .js-link': 'goToTabs'
    //     }
    // }

    // afterInit() {
    //     http.get('https://api.ipify.org?format=json')
    //         .then(({ip}) => {
    //             this.data.ip = ip;
    //             this.render()
    //         })
    // }

    // goToTabs(event) {
    //     event.preventDefault();
    //     router.navigate('tabs');
    // }
}

export const explorePageComponent = new ExplorePageComponent({
    selector: 'app-explore-page',
    template: `
    <p class="flow-text" >Explore</p>
    <div class="row">
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        <a title="comments" class="ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
      </div>
    </div>
  </div>
    `
});