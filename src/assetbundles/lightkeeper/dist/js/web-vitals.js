let reports = [];
function showcaseReport(el) {
    if (el.classList.contains('is-open')) {
        el.classList.remove('is-open');
    } else {
        for (let i = 0; i < reports.length; i++) {
            reports[i].classList.remove('is-open');
        }
        el.classList.add('is-open');
    }
}
function handleClick(e) {
    showcaseReport(e.currentTarget);
}
function handleKeypress(e) {
    if (e instanceof KeyboardEvent) {
        const key = e.key.toLowerCase();
        if (key === ' ' || key === 'enter') {
            showcaseReport(e.currentTarget);
        }
    }
}
function collectReports(){
    const newReports = Array.from(document.body.querySelectorAll('lightkeeper-report:not([showcase])'));
    for (let i = 0; i < newReports.length; i++) {
        newReports[i].addEventListener('click', handleClick);
        newReports[i].addEventListener('keypress', handleKeypress);
        newReports[i].setAttribute('showcase', 'enabled');
        reports.push(newReports[i]);
    }
}
collectReports();


const loadButton = document.body.querySelector('.js-load-lightkeeper-reports');
let p = 0;
const page = location.href.replace(/\?.*/g, '');
async function handleLoadClick(e) {
    p++;
    const request = await fetch(`${page}?offset=${p}`, {
        method: 'GET',
        credentials: 'include',
        headers: new Headers({
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        })
    });
    const response = await request.text();
    if (request.ok) {
        const tempDocument = document.implementation.createHTMLDocument('temp');
        tempDocument.body.innerHTML = response;
        const newReports = Array.from(tempDocument.body.querySelectorAll('lightkeeper-report'));
        const loadButtonParent = loadButton.parentElement;
        for (let i = 0; i < newReports.length; i++){
            if (i !== 25){
                loadButtonParent.insertBefore(newReports[i], loadButton);
            }
        }
        if (newReports.length < 26){
            loadButton.style.display = 'none';
        }
        collectReports();
    }
}
if (loadButton) {
    loadButton.addEventListener('click', handleLoadClick);
}