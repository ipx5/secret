class Http {
    get(url) {
        return sendRequest('GET', url);
    }

    post(url, data) {
        return sendRequest('POST', url, data);
    }
}

function sendRequest(method, url, data = {}) {
    return fetch(url, {method, data}).then(response => response.json())
}

export const http = new Http();