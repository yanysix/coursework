document.addEventListener('DOMContentLoaded', function() {
    const registerModal = document.getElementById('registerModal');
    const closeButtons = document.querySelectorAll('.close');
    const profileIcon = document.querySelector('.profile-icon');

    if(profileIcon) {
        profileIcon.addEventListener('click', () => {
            registerModal.style.display = 'flex';
        });
    }

    closeButtons.forEach(btn => {
        btn.onclick = () => {
            registerModal.style.display = 'none';
        };
    });

    window.onclick = (event) => {
        if(event.target === registerModal) {
            registerModal.style.display = 'none';
        }
    };
});
