document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
        document.querySelectorAll("form.unload").forEach(el => el.classList.remove('unload'));
    }, 800);
});

document.querySelectorAll('.page-back').forEach(el => el.addEventListener('click', e => {
    if (document.referrer !== '' && new URL(document.referrer).origin == location.origin) {
        history.back();
    } else {
        location.href = location.origin;
    }
}));

if (feather) feather.replace();