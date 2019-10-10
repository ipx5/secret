import {WFMPipe} from "framework/index";

class AppPostsPipe extends WFMPipe{
    constructor(config) {
        super(config);
    }
}

export const appPostsPipe = new AppPostsPipe({
    name: 'postsPipe',
    transform(data) {
        if (typeof data === 'string') {
            return 'loading'
        }
        let result = '';
         data.forEach(el => {
            result += `
                <div class="col s12 m5">
                 <div class="card-panel teal">
                <h6>${el.title}</h6>
                <span class="white-text"><p>${el.text}</p>
                </span>
        <div class="row">
        <div class="col offset-s8">
        <a title="comments" class=" ngl btn-floating btn-small waves-effect waves-light scale-transition"><i class="material-icons">forum</i></a>
             </div>
             <div >
             <a title="like" class="ngl btn-floating btn-small waves-effect waves-light  scale-transition pulse"><i class="material-icons ">favorite_border</i></a>
             <span>${el.likes}</span>
            </div>
                </div>
             </div>
            </div>
            `
        });
        return result
    }
});