import {WFMComponent, $} from "framework";

class SuPageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        // this.data ={
        //   createuser: 'Зарегистрироваться',
        // }
    }

    // events() {
    //     return {
    //         'click .collapsible': 'onTabClick'
    //     }
    //}

    // onTabClick({target}) {
    //     let $target = $(target);
    //     if (!$target.hasClass('collapsible-header')) {
    //         return
    //     }
    //     this.el.findAll('.js-tab').forEach(e => e.removeClass('active'));
    //     $target.parent().addClass('active');
    // }
}

export const suPageComponent = new SuPageComponent({
    selector: 'app-su-page',
    template: `
    <p class="flow-text">Sing up</p>
    <main>
    <center>
    <div class="container">
<div class="row">
    <form class="col s12" id="reg-form">
      <div class="row">
        <div class="input-field col s12">
          <input id="username" type="text" class="validate" required>
          <label for="username">Имя пользователя</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password" type="password" class="validate" minlength="6" required>
          <label for="password">Пароль</label>
        </div>
        <div class="input-field col s6">
        <input id="repassword" type="password" class="validate" minlength="6" required>
        <label for="repassword">Повторите пароль</label>
      </div>
      </div>
        <div class="input-field col s12">
          <button class="btn btn-large btn-register waves-effect waves-light black" type="submit" name="action">Зарегистрироваться
            <i class="material-icons right">done</i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <a title="Login" href="#si" class="ngl btn-floating btn-large waves-effect waves-light black"><i class="material-icons">input</i></a>
</div>
</center>
</main>
        `
});