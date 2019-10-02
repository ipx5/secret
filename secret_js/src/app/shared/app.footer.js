import {WFMComponent} from "framework";


class AppFooter extends WFMComponent{
    constructor(config) {
        super(config);
    }
}

export const appFooter = new AppFooter({
    selector: 'app-footer',
    template: `
    <footer class="page-footer black">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Footer Content</h5>
          <p class="white-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="white-text text-lighten-3" href="#!">Link 1</a></li>
            <li><a class="white-text text-lighten-3" href="#!">Link 2</a></li>

          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      © 2019 Maximilyan
      <a class="white-text text-lighten-4 right" href="https://github.com/ipx5/secret">Github</a>
      </div>
    </div>
  </footer>
    `
});