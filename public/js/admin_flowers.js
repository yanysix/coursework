document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('flower-modal');
    const showAddBtn = document.getElementById('show-add-flower');
    const closeBtn = modal.querySelector('.close');
    const form = document.getElementById('flower-form');
    const modalTitle = document.getElementById('modal-title');
    const currentImage = document.getElementById('current-image');
    const flowerIdInput = document.getElementById('flower-id');

    const openModal = (isEdit = false, card = null) => {
        form.reset();
        currentImage.innerHTML = '';
        if (isEdit && card) {
            const id = card.dataset.id;
            flowerIdInput.value = id;
            form.querySelector('#name').value = card.querySelector('h3').textContent;
            form.querySelector('#price').value = card.querySelector('.price').textContent.replace(' ₽','').trim();
            const imgTag = card.querySelector('img');
            if (imgTag) currentImage.innerHTML = `<img src="${imgTag.src}" style="max-width:100px;">`;
            modalTitle.textContent = 'Редактировать цветок';
            form.action = `/admin/flowers/${id}`;
        } else {
            flowerIdInput.value = '';
            modalTitle.textContent = 'Добавить цветок';
            form.action = form.dataset.storeUrl;
        }
        modal.style.display = 'block';
    };

    showAddBtn.addEventListener('click', () => openModal(false));
    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });

    document.querySelectorAll('.edit-flower').forEach(btn => {
        btn.addEventListener('click', e => {
            const card = e.target.closest('.card');
            openModal(true, card);
        });
    });

    form.addEventListener('submit', async e => {
        e.preventDefault();
        const id = flowerIdInput.value;
        const url = form.action; // <- нужно обязательно определить URL
        const formData = new FormData(form);

        // Если редактирование — добавляем _method
        if (id) formData.append('_method', 'PUT');

        try {
            const res = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await res.json();

            if (data.success) {
                if (id) {
                    // обновляем карточку
                    const card = document.querySelector(`.card[data-id="${id}"]`);
                    card.querySelector('h3').textContent = data.flower.name;
                    card.querySelector('.price').textContent = data.flower.price ? data.flower.price + ' ₽' : '-';
                    if (data.flower.image_url) {
                        let imgTag = card.querySelector('img');
                        if (imgTag) {
                            imgTag.src = data.flower.image_url;
                        } else {
                            const img = document.createElement('img');
                            img.src = data.flower.image_url;
                            img.alt = data.flower.name;
                            img.classList.add('flower-image');
                            card.insertBefore(img, card.querySelector('.price'));
                        }
                    }
                } else {
                    // Добавление — перезагрузка страницы
                    location.reload();
                }

                modal.style.display = 'none';
                form.reset();
                currentImage.innerHTML = '';
            }
        } catch (err) {
            console.error(err);
        }
    });
});
