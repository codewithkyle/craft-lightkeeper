import { getCLS, getFID, getLCP, getFCP, getTTFB } from "https://unpkg.com/web-vitals@0.2.3/dist/web-vitals.es5.min.js?module";
import { parseUserAgent } from "https://unpkg.com/detect-browser@5.1.1/es/index.js";

let cls = null,
    fid = null,
    lcp = null,
    fcp = null,
    ttfb = null;

function sendToAnalytics(data) {
    const body = JSON.stringify(data);
    if (navigator.sendBeacon) {
        navigator.sendBeacon("/actions/lightkeeper/default/report", body);
    } else {
        fetch("/actions/lightkeeper/default/report", { body, method: "POST", keepalive: true });
    }
}

function checkValues() {
    if (cls && fid && lcp && fcp && ttfb) {
        const data = {
            cls: cls,
            fid: fid,
            lcp: lcp,
            fcp: fcp,
            ttfb: ttfb,
            connection: null,
            ram: null,
            cpu: null,
            screenWidth: window.innerWidth,
            screenHeight: window.innerHeight,
        };
        if ("connection" in navigator) {
            data.connection = window.navigator.connection.effectiveType;
        }
        if ("deviceMemory" in navigator) {
            data.ram = window.navigator.deviceMemory;
        }
        if ("hardwareConcurrency" in navigator) {
            data.cpu = window.navigator.hardwareConcurrency;
        }
        const browserInfo = parseUserAgent(window.navigator.userAgent);
        data.browser = browserInfo.name;
        data.browserVersion = browserInfo.version;
        data.os = browserInfo.os;
        data.type = browserInfo.type;
        sendToAnalytics(data);
    }
}

getCLS((metric) => {
    cls = metric;
    checkValues();
});
getFID((metric) => {
    fid = metric;
    checkValues();
});
getLCP((metric) => {
    lcp = metric;
    checkValues();
});
getFCP((metric) => {
    fcp = metric;
    checkValues();
});
getTTFB((metric) => {
    ttfb = metric;
    checkValues();
});