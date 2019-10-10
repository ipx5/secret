class Http {
    get(url) {
        return sendRequest('GET', url);
    }

    post(url, data) {
        return sendRequest('POST', url, data);
    }
    // put()
}

function sendRequest(method, url, data = {}) {
    let jsonData = JSON.stringify(data);
    return fetch(url, {method, jsonData}).then(response => response.json())
}

export const http = new Http();