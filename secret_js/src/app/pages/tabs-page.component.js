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
                  <i class="material-icons">filter_drama</i>First</div>
                <div class="collapsible-body" style="">
                  <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</span>
                </div>
              </li>
              <li class="js-tab">
                <div class="collapsible-header">
                  <i class="material-icons">place</i>Second</div>
                <div class="collapsible-body" style="">
                  <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</span>
                </div>
              </li>
              <li class="active js-tab">
                <div class="collapsible-header">
                  <i class="material-icons">whatshot</i>Third</div>
                <div class="collapsible-body">
                  <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</span>
                </div>
              </li>
            </ul>
        </div>
</div>
        `
});