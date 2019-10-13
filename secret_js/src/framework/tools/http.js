import {_} from "./util";

class Http {
    get(url) {
        return sendRequest('GET', url);
    }

    post(url, data) {
        return sendRequest('POST', url, data);
    }
    // put()
}

function sendRequest(method, url, data) {
    let object = {method, url, mode: 'cors'}
    if (!_.isUndefined(data)) {
        object['body'] = JSON.stringify(data);
    }
    console.log(object)
    return fetch(url, object).then(response => response.json())
}

export const http = new Http();