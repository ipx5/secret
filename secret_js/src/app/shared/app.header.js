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
      <a href="#" class="brand-logo"><img src="src/framework/secretwhite.png" style="border:20px" >Secret</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">

      <li><a title="Explore" href="#" class="ngl btn-floating btn-large waves-effect waves-light black scale-transition"><i class="material-icons">explore</i></a></li>
      <li><a title="Home" href="#home" class="ngl btn-floating btn-large waves-effect waves-light black"><i class="material-icons">home</i></a></li>
        <li><a title="Create post" href="#create_post" class="ngl btn-floating btn-large waves-effect waves-light black"><i class="material-icons">create</i></a></li>

        <li><a title="Login" href="#si" class="ngl btn-floating btn-large waves-effect waves-light black"><i class="material-icons">input</i></a></li>
        <li><a title="User settings" href="#tabs" class="ngl btn-floating btn-large waves-effect waves-light black"><i class="material-icons">perm_identity</i></a><li>
        <li><a title="Logout" href="#Logout" class="ngl btn-floating btn-large waves-effect waves-light black"><i class="material-icons">eject</i></a><li>
      </ul>
    </div>
  </nav>
    `
});