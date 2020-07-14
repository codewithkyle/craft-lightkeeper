const reports = Array.from(document.body.querySelectorAll('lightkeeper-report'));
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
for (let i = 0; i < reports.length; i++) {
    reports[i].addEventListener('click', handleClick);
    reports[i].addEventListener('keypress', handleKeypress);
}