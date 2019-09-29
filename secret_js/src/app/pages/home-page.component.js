import {WFMComponent, router} from "framework";

class HomePageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data = {
            title: 'Главная страница',
            link: 'Другая страница'
        }
    }

    events() {
        return {
            'click .js-link': 'goToTabs'
        }
    }

    goToTabs(event) {
        event.preventDefault();
        router.navigate('tabs');
    }
}

export const homePageComponent = new HomePageComponent({
    selector: 'app-home-page',
    template: `<div class="row">
    <div class="col s12 m6 home__block">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">{{title}}</span>
          <p>I am a very simple card. I am good at containing small bits of information.
          I am convenient because I require little markup to use effectively.</p>
        </div>
        <div class="card-action">
          <a href="#not-exiting-path" class="js-link">{{ link }}</a>
        </div>
      </div>
    </div>
  </div>`,
    styles: `
        .home__block { margin-top: 40px }
    `
});