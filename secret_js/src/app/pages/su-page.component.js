import {WFMComponent, $} from "framework";
import {http} from "../../framework";
import axios from 'axios';
class SuPageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data ={
            name: '',
            email: '',
            password: '',
            passwordRepeat: ''
        }
    }

    events() {
        return {
            'click .btn-register': 'toRegister',
            'change .inputName' : 'toHandler',
            'change .inputEmail' : 'toHandler',
            'change .inputPassword': 'toHandler',
            'change .inputRepeatPassword' : 'toHandler'
        }
    }

    toHandler(e) {
        this.data[e.target.name] = e.target.value;
    }

    toRegister(e) {
        e.preventDefault();
        let email = this.data.email;
        let username = this.data.name;
        let password = this.data.password;
        let repassword = this.data.passwordRepeat;
        let dataForm = {email, username, password, repassword};
        console.log(dataForm)
        axios.post('http://secret.com/user', dataForm).then(res => console.log(res))
        http.post('http://secret.com/user', dataForm).then(res => console.log(res))
    }
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
          <input name="name" id="username" type="text" class="validate inputName" required>
          <label for="username">Имя пользователя</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="email" id="email" type="email" class="validate inputEmail" required>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input name="password" id="password" type="password" class="validate inputPassword" minlength="6" required>
          <label for="password">Пароль</label>
        </div>
        <div class="input-field col s6">
        <input name="passwordRepeat" id="repassword" type="password" class="validate inputRepeatPassword" minlength="6" required>
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