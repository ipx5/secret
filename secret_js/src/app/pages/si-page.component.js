import {WFMComponent, $} from "framework";

class SiPageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data ={
          createuser: 'Зарегистрироваться',
        }
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

export const siPageComponent = new SiPageComponent({
    selector: 'app-si-page',
    template: `
    <main>
    <center>
      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' />
                <label for='email'>Логин</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' />
                <label for='password'>Пароль</label>
              </div>
              <label style='float: right;'>
								<a class='black-text' href='#!'><b>Забыли пароль?</b></a>
							</label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect black'>Войти</button>
              </div>
            </center>
          </form>
      <a class='black-text' href="#login">{{ createuser }}</a>
    </center>
  </main>
        `,
        styles: `
        .si__block {width: 50px}
    `
});