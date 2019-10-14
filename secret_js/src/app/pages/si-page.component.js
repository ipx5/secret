import {WFMComponent, $, http} from "framework";
import axios from 'axios';

class SiPageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data ={
          createuser: 'Зарегистрироваться',
            email: '',
            password: ''
        }
    }

    events() {
        return {
            'change #email': 'toHandler',
            'change #password': 'toHandler',
            'click .login': 'toAuth'
        }
    }

    toHandler(e) {
        this.data[e.target.name] = e.target.value;
    }

    toAuth(e) {
        e.preventDefault();
        let email = this.data.email;
        let password = this.data.password;
        let data = {email, password};
        axios.post('http://secret.com/user/login', data).then(res => console.log(res))
        http.post('http://secret.com/user/login', data).then(res => console.log(res));
    }
}

export const siPageComponent = new SiPageComponent({
    selector: 'app-si-page',
    template: `
    <p class="flow-text" >Sing in</p>
    <main>
    <center>
      <div class="container">
        <div class="row" style="display: inline-block; padding: 32px 48px 0px 48px;">
          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>
            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' />
                <label for='email'>Email</label>
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
                <button type='submit' name='btn_login' class='login col s12 btn btn-large waves-effect black'>Войти</button>
              </div>
            </center>
          </form>
      <a class='black-text' href="#su">{{ createuser }}</a>
    </center>
  </main>
        `,
        styles: `
        .si__block {width: 50px}
    `
});