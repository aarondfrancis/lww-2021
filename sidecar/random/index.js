function uuid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
        return v.toString(16);
    });
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

exports.handler = async function () {
    await sleep(5000);

    console.log(uuid());

    return uuid();
}
