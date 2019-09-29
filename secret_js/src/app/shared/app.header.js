import {WFMComponent} from "framework";

class AppHeader extends WFMComponent{
    constructor(config) {
        super(config);
    }
}

export const appHeader = new AppHeader({
    selector: 'app-header',
    template: `
       <nav class="black">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Secret</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="#">Главная</a></li>
        <li><a href="#tabs">Табы</a></li>
        <li><a href="#directive">Директивы</a></li>
      </ul>
    </div>
  </nav>
    `
});