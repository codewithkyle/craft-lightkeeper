const   runTestButton = document.body.querySelector('.js-run-test'),
        performanceLine = document.body.querySelector('.js-performance-line'),
        performanceNumber = document.body.querySelector('.js-performance-number'),
        accessibilityLine = document.body.querySelector('.js-accessibility-line'),
        accessibilityeNumber = document.body.querySelector('.js-accessibility-number'),
        bestPracticesLine = document.body.querySelector('.js-best-practices-line'),
        bestPracticesNumber = document.body.querySelector('.js-best-practices-number'),
        seoLine = document.body.querySelector('.js-seo-line'),
        seoNumber = document.body.querySelector('.js-seo-number'),
        widget = document.body.querySelector('.js-lightkeeper-widget');

async function runAudit(e){
    e.preventDefault();
    widget.setAttribute('state', 'loading');
    const data = {
        url: runTestButton.dataset.url,
    };
    const request = await fetch('http://134.122.30.183:3000/audit', {
        method: 'POST',
        headers: new Headers({
            'Content-Type': 'application/json',
            'Accepts': 'application/json',
        }),
        body: JSON.stringify(data),
    });
    const response = await request.json();
    if (request.ok){
        widget.setAttribute('state', 'idling');

        const maxOffset = 251;
        performanceLine.style.strokeDashoffset = maxOffset;
        accessibilityLine.style.strokeDashoffset = maxOffset;
        bestPracticesLine.style.strokeDashoffset = maxOffset;
        seoLine.style.strokeDashoffset = maxOffset;
        performanceLine.setAttribute('level', 'neutral');
        accessibilityLine.setAttribute('level', 'neutral');
        bestPracticesLine.setAttribute('level', 'neutral');
        seoLine.setAttribute('level', 'neutral');

        setTimeout(()=>{
            performanceNumber.innerText = response.performance * 100;
            performanceLine.style.strokeDashoffset = maxOffset - maxOffset * response.performance;
            if (response.performance <= 0.49){
                performanceLine.setAttribute('level', 'fail');
            }else if (response.performance < 0.9){
                performanceLine.setAttribute('level', 'warn');
            }else{
                performanceLine.setAttribute('level', 'pass');
            }

            accessibilityeNumber.innerText = response.accessibility * 100;
            accessibilityLine.style.strokeDashoffset = maxOffset - maxOffset * response.accessibility;
            if (response.accessibility <= 0.49){
                accessibilityLine.setAttribute('level', 'fail');
            }else if (response.accessibility < 0.9){
                accessibilityLine.setAttribute('level', 'warn');
            }else{
                accessibilityLine.setAttribute('level', 'pass');
            }

            bestPracticesNumber.innerText = response.bestPractices * 100;
            bestPracticesLine.style.strokeDashoffset = maxOffset - maxOffset * response.bestPractices;
            if (response.bestPractices <= 0.49){
                bestPracticesLine.setAttribute('level', 'fail');
            }else if (response.bestPractices < 0.9){
                bestPracticesLine.setAttribute('level', 'warn');
            }else{
                bestPracticesLine.setAttribute('level', 'pass');
            }

            seoNumber.innerText = response.seo * 100;
            seoLine.style.strokeDashoffset = maxOffset - maxOffset * response.seo;
            if (response.seo <= 0.49){
                seoLine.setAttribute('level', 'fail');
            }else if (response.seo < 0.9){
                seoLine.setAttribute('level', 'warn');
            }else{
                seoLine.setAttribute('level', 'pass');
            }
        }, 150);
    }else{
        widget.setAttribute('state', 'error');
        console.log(response);
    }
}
runTestButton.addEventListener('click', runAudit);