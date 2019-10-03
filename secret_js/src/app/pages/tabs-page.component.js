import {WFMComponent, $} from "framework";

class TabsPagePageComponent extends WFMComponent {
    constructor(config) {
        super(config);
    }

    events() {
        return {
            'click .collapsible': 'onTabClick'
        }
    }

    onTabClick({target}) {
        let $target = $(target);
        if (!$target.hasClass('collapsible-header')) {
            return
        }
        this.el.findAll('.js-tab').forEach(e => e.removeClass('active'));
        $target.parent().addClass('active');
    }
}

export const tabsPagePageComponent = new TabsPagePageComponent({
    selector: 'app-tabs-page',
    template: `
    <div class="row">
    <div class="col s6 offset-s3">
            <ul class="collapsible popout">
              <li class="js-tab">
                <div class="collapsible-header">
                  <i class="material-icons">person_outline</i>Учетная запись</div>
                <div class="collapsible-body" >
                <form action="#">
                <p>
                <div class="switch">
                <label>
                  Off
                  <input type="checkbox">
                  <span class="lever"></span>
                  On
                </label>
              </div>
              <div class="switch">
              <label>
                Off
                <input type="checkbox">
                <span class="lever"></span>
                On
              </label>
            </div>
                  <label>
                    <input type="checkbox" />
                    <span>Red</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" checked="checked" />
                    <span>Yellow</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" class="filled-in" checked="checked" />
                    <span>Filled in</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input id="indeterminate-checkbox" type="checkbox" />
                    <span>Indeterminate Style</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" checked="checked" disabled="disabled" />
                    <span>Green</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" disabled="disabled" />
                    <span>Brown</span>
                  </label>
                </p>
              </form>
                </div>
              </li>
              <li class="js-tab">
                <div class="collapsible-header">
                  <i class="material-icons">home</i>Блог</div>
                <div class="collapsible-body" >
                <form action="#">
                <p>
                  <label>
                    <input type="checkbox" />
                    <span>Red</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" checked="checked" />
                    <span>Yellow</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" class="filled-in" checked="checked" />
                    <span>Filled in</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input id="indeterminate-checkbox" type="checkbox" />
                    <span>Indeterminate Style</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" checked="checked" disabled="disabled" />
                    <span>Green</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" disabled="disabled" />
                    <span>Brown</span>
                  </label>
                </p>
              </form>
                </div>
              </li>
              <li class="active js-tab">
                <div class="collapsible-header">
                  <i class="material-icons">settings</i>Настройки</div>
                <div class="collapsible-body">
                <form action="#">
                <p>
                  <label>
                    <input type="checkbox" />
                    <span>Red</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" checked="checked" />
                    <span>Yellow</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" class="filled-in" checked="checked" />
                    <span>Filled in</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input id="indeterminate-checkbox" type="checkbox" />
                    <span>Indeterminate Style</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" checked="checked" disabled="disabled" />
                    <span>Green</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" disabled="disabled" />
                    <span>Brown</span>
                  </label>
                </p>
              </form>
                </div>
              </li>
            </ul>
        </div>
</div>
        `
});