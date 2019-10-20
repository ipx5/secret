class Http {
    get(url) {
        let object = {
            method: 'GET',
            url: url,
            mode: 'cors'
        };
        return fetch(url, object).then(response => response.json());
    }

    post(url, data) {
        let object = {
            method: 'POST',
            url: url,
            mode: 'cors',
            headers:{"content-type": "application/x-www-form-urlencoded"},
            body: parseData(data)
        };
        return fetch(url, object).then(response => response.json());
    }
}

function parseData(obj) {
    let arrayKeys = Object.keys(obj);
    let resultData = '';
    arrayKeys.forEach((key, idx) => {
        if (idx === 0) {
            resultData += key + '=' + obj[key]
        } else {
            resultData += '&' + key + '=' + obj[key]
        }
    });
    return resultData;
}

export const http = new Http();