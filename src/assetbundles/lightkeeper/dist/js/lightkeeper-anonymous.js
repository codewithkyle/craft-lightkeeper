import { getCLS, getFID, getLCP, getFCP, getTTFB } from "https://unpkg.com/web-vitals@0.2.3/dist/web-vitals.es5.min.js?module";
import { parseUserAgent } from "https://unpkg.com/detect-browser@5.1.1/es/index.js";
import { v4 as uuid } from 'https://jspm.dev/npm:uuid@8.3.0';

let cls = null,
    fid = null,
    lcp = null,
    fcp = null,
    ttfb = null;

let storageQuota = null;
async function getStorageQuota() {
    const storage = await navigator.storage.estimate();
    storageQuota = storage.quota;
}
if (navigator.storage && navigator.storage.estimate) {
    getStorageQuota();
}

function sendToAnalytics(data) {
    fetch("/lightkeeper/log-report", {
        method: "POST", keepalive: true, body: JSON.stringify(data), headers: new Headers({
            'Content-Type': 'application/json'
        })
    });
}

function checkValues() {
    if (cls && fid && lcp && fcp && ttfb) {
        const data = {
            cls: cls.value,
            fid: fid.value,
            lcp: lcp.value,
            fcp: fcp.value,
            ttfb: ttfb.value,
            connection: null,
            ram: null,
            cpu: null,
            screenWidth: window.innerWidth,
            screenHeight: window.innerHeight,
            storage: storageQuota,
            url: location.href,
            uuid: uuid(),
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