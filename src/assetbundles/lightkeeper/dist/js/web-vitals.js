const reports = Array.from(document.body.querySelectorAll('lightkeeper-report'));
function showcaseReport(e) {
    if (e.currentTarget.classList.contains('is-open')) {
        e.currentTarget.classList.remove('is-open');
    } else {
        for (let i = 0; i < reports.length; i++) {
            reports[i].classList.remove('is-open');
        }
        e.currentTarget.classList.add('is-open');
    }
}
for (let i = 0; i < reports.length; i++) {
    reports[i].addEventListener('click', showcaseReport);
}