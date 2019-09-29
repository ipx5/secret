const _ = {
    delay(ms = 1000) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve()
            }, ms)
        })
    },


    isUndefined(d) {
        return typeof d === 'undefined';
    },

    isNull(d) {
        return d === null
    },

    isEmpty(d) {
        return d.length && d.length === 0;
    },

    isString(d) {
        return typeof d === "string";
    }
};

export { _ }