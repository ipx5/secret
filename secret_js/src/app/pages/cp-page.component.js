import {WFMComponent, $} from "framework";

class CpPageComponent extends WFMComponent {
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
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">Title</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea2" class="materialize-textarea"></textarea>
            <label for="textarea2">Text</label>
          </div>
        </div>
      </form>
    </div>
    
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
      </center>
    </main>
        `
});