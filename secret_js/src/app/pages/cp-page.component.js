import {WFMComponent, $, http} from "framework";
import axios from 'axios';

class CpPageComponent extends WFMComponent {
    constructor(config) {
        super(config);

        this.data ={
            createuser: 'Зарегистрироваться',
            inputTitle: '',
            inputText: ''
        }

        // let createPost = this.createPost.bind(this);
    }

    events() {
        return {
            'click .btn': 'createPost',
            'change .inputTitle' : 'handler',
            'change .inputText' : 'handler'
        }
    }


    handler(e) {
        this.data[e.target.name] = e.target.value;
    }

    goToTabs(event) {
        event.preventDefault();
        console.log(event.target)
    }

    createPost(e) {
        e.preventDefault()

        let title = this.data.inputText;
        let text = this.data.inputTitle;
        let data = {title: title, text: text, id: 1};

        http.post('http://secret.com/post/1', data)
            .then(res => console.log(res)).then(res => this.cleanState());
    }

    cleanState() {
        this.data.inputTitle = '';
        this.data.inputText = '';
        this.render();
    }
}

export const cpPageComponent = new CpPageComponent({
    selector: 'app-cp-page',
    template: `
    <p class="flow-text">Post</p>
    <main>
      <center>
      
      <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea1" name="inputTitle" class="materialize-textarea inputTitle" value = "{{ inputTitle }}"></textarea>
            <label for="textarea1">Title</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 ">
            <textarea id="textarea2" name="inputText" class="materialize-textarea inputText" value = {{inputText}}></textarea>
            <label for="textarea2">Text</label>
            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
            </button>
          </div>
        </div>
      </form>
    </div>
    

      </center>
    </main>
        `
});