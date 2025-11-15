document.addEventListener('DOMContentLoaded', function () {
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal'); // если есть
    const profileIcon = document.querySelector('.profile-icon'); // иконка профиля
    const closeButtons = document.querySelectorAll('.close');
    const openRegister = document.getElementById('openRegister');

    if(profileIcon) {
        profileIcon.addEventListener('click', () => loginModal.style.display = 'flex');
    }

    closeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            if(loginModal) loginModal.style.display = 'none';
            if(registerModal) registerModal.style.display = 'none';
        });
    });

    window.addEventListener('click', (event) => {
        if(event.target === loginModal) loginModal.style.display = 'none';
        if(event.target === registerModal) registerModal.style.display = 'none';
    });

    if(openRegister) {
        openRegister.addEventListener('click', (e) => {
            e.preventDefault();
            if(loginModal) loginModal.style.display = 'none';
            if(registerModal) registerModal.style.display = 'flex';
        });
    }
});
