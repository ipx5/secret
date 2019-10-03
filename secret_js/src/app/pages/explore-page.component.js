import {WFMComponent, router, http} from "framework";

class ExplorePageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data = {
            title: '',
            text: ' ',

        }
    }

    // events() {
    //     return {
    //         'click .js-link': 'goToTabs'
    //     }
    // }

    afterInit() {
        http.get('http://localhost/posts/')
            .then(({title}) => {
                this.data.title = title;
                this.render()
            })
            .then(({data}) => {
              this.data.text = text;
              this.render()
          })
    }

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
        <span class="white-text">{{ title }} {{ data }}
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        </div>
        <div >
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        </div>
        <div>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        </div>
        <div>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        </div>
        <div>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        </div>
        <div>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
    <div class="col s12 m5">
      <div class="card-panel teal">
        <span class="white-text">I am a very simple card. I am good at containing small bits of information.
        I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
        </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
        </div>
        <div>
        <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
        </div>
        </div>
        </div>
    </div>
  </div>
  <ul class="pagination">
  <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
  <li class="active"><a href="#!">1</a></li>
  <li class="waves-effect"><a href="#!">2</a></li>
  <li class="waves-effect"><a href="#!">3</a></li>
  <li class="waves-effect"><a href="#!">4</a></li>
  <li class="waves-effect"><a href="#!">5</a></li>
  <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
</ul>
    `
});