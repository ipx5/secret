import {WFMComponent, $, http, _} from "framework";
import axios from 'axios';

class SiPageComponent extends WFMComponent {
    constructor(config) {
        super(config);
        this.data = {
            createuser: 'Зарегистрироваться',
            email: '',
            password: '',
            login: false,
            display: 'block',
            message: '',
            username: '',
            displayButton: 'none'
        }
    }

    events() {
        return {
            'change #email': 'toHandler',
            'change #password': 'toHandler',
            'click .login': 'toAuth',
            'click .logout': 'toLogout'
        }
    }

    toHandler(e) {
        this.data[e.target.name] = e.target.value;
    }

    toLogout(e) {
        let localName = localStorage.getItem('username');
        let data = {username: localName}
        http.post('http://serv.secret.com/user/logout', data).then(res => {
            console.log(res)
            if (res.status === 200) {
                localStorage.removeItem("login");
                localStorage.removeItem("username");
                this.data.message = '';
                this.data.display = "block";
                this.data.displayButton = "none";
                console.log(localStorage)
            }
        }).then(res => {
            this.render()
        })
    }

    toAuth(e) {
        e.preventDefault();
        let email = this.data.email;
        let password = this.data.password;
        let data = {email, password};
        http.post('http://serv.secret.com/user/login', data).then(res => {
            if (res.status === 200) {
                this.data.username = res.username;
                localStorage.setItem('login', 'true');
                localStorage.setItem('username', res.username);
                this.data.message = "Вы вошли как" + localStorage.getItem('username');
                this.data.display = "none";
                this.data.displayButton = "block";
            }
        }).then(res => {
            this.render()
        });
    }

    // onInit() {
    //
    // }

    onInit() {
        if (localStorage.getItem('login') === "true") {
            this.data.message = "Вы вошли как" + localStorage.getItem('username');
            this.data.display = "none";
            this.data.displayButton = "block";
        } else {
            this.data.message = '';
            this.data.display = "block";
            this.data.displayButton = "none";
        }
        this.render();
    }
}

export const siPageComponent = new SiPageComponent({
    selector: 'app-si-page',
    template: `
    <p class="flow-text" >Sing in</p>
    <main>
    <center>
      <div class="container">
        {{message}}
        <a class="waves-effect waves-light btn logout" style="display: {{displayButton}}">Выйти</a>
        <div class="row" style="display: {{display}}; padding: 32px 48px 0px 48px;" >
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