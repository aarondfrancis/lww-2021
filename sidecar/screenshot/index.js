// This comes from the layer, not from our own package.json
const chromium = require('chrome-aws-lambda');
let page = null;

async function getPage() {
    if (page !== null) {
        return page;
    }

    let browser = await chromium.puppeteer.launch({
        args: [...chromium.args, '--hide-scrollbars', '--disable-web-security'],
        executablePath: await chromium.executablePath,
        headless: true,
        ignoreHTTPSErrors: true,
    });

    return browser.newPage();
}

exports.handler = async function (event) {
    page = getPage();

    let viewport = {
        width: 1200,
        height: 630,
        deviceScaleFactor: 2,
        ...(event.viewport || {})
    }

    page = await page;

    let settingViewport = page.setViewport(viewport);

    await page.goto(event.url, {
        waitUntil: 'load',
        ...(event.goto || {})
    });

    let screenshot = {
        type: 'jpeg',
        encoding: 'base64',
        ...(event.screenshot || {})
    }

    await settingViewport;

    let image = await page.screenshot(screenshot);

    return {
        image: image,
        viewport: viewport,
        screenshot: screenshot
    }
}
