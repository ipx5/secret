import {WFMComponent, router, http} from "framework";
import axios from 'axios';

class HomePageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data = {
            title: 'Главная страница',
            link: 'Другая страница',
            ip: 'loading'
        }
    }

    events() {
        return {
            'click .js-link': 'goToTabs'
        }
    }

    afterInit() {
        // http.get('http://secret.com/posts/1').then(res => console.log(res))
        // this.render()
    }

    goToTabs(event) {


        event.preventDefault();
        router.navigate('tabs');
    }
}

export const homePageComponent = new HomePageComponent({
    selector: 'app-home-page',
    template: `
    <p class="flow-text">Home</p>
    <div class="row">
        <div class="col  home_block  offset-s5">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">{{title}}</span>
          <p>{{ip}}</p>
        </div>
        <div class="card-action">
          <a href="#not-exiting-path" class="js-link">{{ link }}</a>
        </div>
      </div>
    </div>
  </div>

  `,
    styles: `
        .home_block { margin-top: 40px }
    `
});