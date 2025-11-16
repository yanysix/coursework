const btn = document.getElementById('open-packaging-form');
const form = document.getElementById('custom-packaging-form');
const closeBtn = document.getElementById('close-form');

btn.addEventListener('click', () => {
    form.classList.add('show');
});

closeBtn.addEventListener('click', () => {
    form.classList.remove('show');
});
