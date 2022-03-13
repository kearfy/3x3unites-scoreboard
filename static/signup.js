// Should be used exclusively for the signup function.

(async function() {
    const inputEl = document.querySelector("input[type=password]");
    const listEl = document.querySelector("ul.password-validation");
    var attempt = 0;

    inputEl.addEventListener('input', async e => {
        attempt++;
        let currentAttempt = attempt;
        setTimeout(async () => {
            if (currentAttempt == attempt) {
                await validateField()
            }
        }, 500);
    });

    async function validateField() {
        return new Promise((resolve, reject) => {
            var data = new FormData();
            data.append('password', inputEl.value);

            fetch(SITE_LOCATION + '/pb-api/auth/validate-password', {
                method: 'post',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    password: inputEl.value
                })
            }).then(res => res.json()).then(res => {
                listEl.innerHTML = '';
                var finalEl = '';

                if (res.valid) {
                    resolve(true);
                } else {
                    res.issues.forEach(issue => {
                        switch(issue) {
                            case 'uppercase':
                                finalEl += '<li>Je wachtwoord moet een hoofdletter bevatten (A-Z).</li>';
                                break;
                            case 'lowercase':
                                finalEl += '<li>Je wachtwoord moet een kleine letter bevatten (a-z).</li>';
                                break;
                            case 'number':
                                finalEl += '<li>Je wachtwoord moet een cijfer bevatten (0-9).</li>';
                                break;
                            case 'special':
                                finalEl += '<li>Je wachtwoord moet een speciaal karakter bevatten (ex. !@#$%^&).</li>';
                                break;
                            case 'length':
                                finalEl += '<li>Je wachtwoord moet minimaal ' + res.data.minimumLength +' karakters bevatten (momenteel ' + res.data.length + ').</li>';
                                break;
                            case 'score': 
                                var difference = res.data.minimumScore - res.data.score;
                                var missingFactorCount = parseInt(difference / 0.2);
                                if (missingFactorCount < 1) missingFactorCount = 1;
                                missingFactorCount -= (res.issues.length - 1);

                                if (missingFactorCount > 0) {
                                    finalEl += '<li>Je wachtwoord moet nog aan minstens ' + missingFactorCount + ' van de volgende factoren voldoen: <br> <ul>';
                                    Object.keys(res.factors).forEach(factor => {
                                        if (!res.factors[factor] && !res.data.enforcedPolicy.includes(factor)) switch(factor) {
                                            case 'uppercase':
                                                finalEl += '<li>Bevat een hoofdletter (A-Z).</li>';
                                                break;
                                            case 'lowercase':
                                                finalEl += '<li>Bevat een kleine letter (a-z).</li>';
                                                break;
                                            case 'number':
                                                finalEl += '<li>Bevat een cijfer (0-9).</li>';
                                                break;
                                            case 'special':
                                                finalEl += '<li>Bevat een speciaal karakter (ex. !@#$%^&).</li>';
                                                break;
                                        }
                                    });
                                    finalEl += '</ul></li>';
                                }
                                break;
                        }
                    })
                }

                listEl.innerHTML = finalEl;
            });
        });
    }
})();