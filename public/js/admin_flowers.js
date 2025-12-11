document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('flower-modal');
    const btnAdd = document.getElementById('btn-add-flower');
    const btnClose = document.getElementById('close-flower-modal');
    const form = document.getElementById('flower-form');
    const modalTitle = document.getElementById('modal-title');
    const flowerIdInput = document.getElementById('flower-id');
    const currentImage = document.getElementById('current-image');

    // Функция открытия модалки
    const openModal = (flowerCard = null) => {
        form.reset();
        currentImage.innerHTML = '';

        if (flowerCard) {
            modalTitle.textContent = 'Редактировать цветок';
            const editBtn = flowerCard.querySelector('.edit-flower');
            const updateUrl = editBtn.dataset.updateUrl;

            flowerIdInput.value = flowerCard.dataset.id;
            form.action = updateUrl;

            // Если редактирование, добавляем скрытое поле _method=PUT
            if (!form.querySelector('input[name="_method"]')) {
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            }

            form.querySelector('#flower-name').value = editBtn.dataset.name;
            form.querySelector('#flower-price').value = editBtn.dataset.price;

            if (editBtn.dataset.image) {
                currentImage.innerHTML = `<img src="${editBtn.dataset.image}" style="max-width:100px;">`;
            }
        } else {
            modalTitle.textContent = 'Добавить цветок';
            flowerIdInput.value = '';
            form.action = form.dataset.storeUrl; // URL добавления
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
        }

        modal.style.display = 'block';
    };

    // Открытие модалки "Добавить"
    btnAdd.addEventListener('click', () => openModal());

    // Закрытие модалки
    btnClose.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', e => {
        if (e.target === modal) modal.style.display = 'none';
    });

    // Открытие модалки "Редактировать"
    document.querySelectorAll('.edit-flower').forEach(btn => {
        btn.addEventListener('click', () => {
            const card = btn.closest('.card');
            openModal(card);
        });
    });
});
