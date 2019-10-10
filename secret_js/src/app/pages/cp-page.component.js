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

    // events() {
    //     return {
    //         'click .collapsible': 'onTabClick'
    //     }
    //}

    createPost(e) {
        e.preventDefault()

        let title = this.data.inputText;
        let text = this.data.inputTitle;
        let data = {title: title, text: text, id: 1};
        var formBody = [];
        for (var property in data) {
            var encodedKey = encodeURIComponent(property);
            var encodedValue = encodeURIComponent(data[property]);
            formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");



        console.log(JSON.stringify(data));
        fetch('http://secret.com/post/1', {
            method: 'POST',
            headers: {
            //     'Access-Control-Allow-Origin': 'http://localhost:4200',
            // 'Access-Control-Allow-Headers': 'http://localhost:4200',
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'

                // 'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
                },
            // mode: 'cors',
            body: formBody
        }).then(res => res.body).then(res => this.render())
        // http.post('http://secret.com/post/1', {title: title, text: text})
        //     .then(res => console.log(JSON.stringify(res))).then(res => this.render());
    }
    // onTabClick({target}) {
    //     let $target = $(target);
    //     if (!$target.hasClass('collapsible-header')) {
    //         return
    //     }
    //     this.el.findAll('.js-tab').forEach(e => e.removeClass('active'));
    //     $target.parent().addClass('active');
    // }
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
            <textarea id="textarea1" name="inputTitle" class="materialize-textarea inputTitle"></textarea>
            <label for="textarea1">Title</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 ">
            <textarea id="textarea2" name="inputText" class="materialize-textarea inputText"></textarea>
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