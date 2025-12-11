document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("packaging-modal");
    const openBtn = document.getElementById("show-add-packaging");
    const closeBtn = modal.querySelector(".close");
    const form = document.getElementById("packaging-form");

    const packagingIdInput = document.getElementById("packaging-id");
    const nameInput = document.getElementById("name");
    const priceInput = document.getElementById("price");
    const imageInput = document.getElementById("image");
    const currentImage = document.getElementById("current-image");
    const modalTitle = document.getElementById("modal-title");

    const storeUrl = form.dataset.storeUrl;

    const openModal = (card = null, updateUrl = null) => {
        form.reset();
        currentImage.innerHTML = "";

        if (card && updateUrl) {
            // Редактирование
            modalTitle.textContent = "Редактировать упаковку";
            form.action = updateUrl;
            form.method = "POST";

            // Добавляем скрытое поле _method=PUT
            if (!form.querySelector('input[name="_method"]')) {
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            }

            packagingIdInput.value = card.dataset.id;
            nameInput.value = card.querySelector("h3").textContent;
            priceInput.value = card.querySelector(".price").textContent.replace("₽", "").trim();

            const imgTag = card.querySelector("img");
            if (imgTag) {
                currentImage.innerHTML = `<img src="${imgTag.src}" width="120" style="margin-bottom:10px;border-radius:6px;">`;
            }
        } else {
            // Добавление
            modalTitle.textContent = "Добавить упаковку";
            form.action = storeUrl;
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
            packagingIdInput.value = "";
        }

        modal.style.display = "block";
    };

    // Кнопка "Добавить"
    openBtn.addEventListener("click", () => openModal());

    // Закрытие модалки
    closeBtn.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", e => {
        if (e.target === modal) modal.style.display = "none";
    });

    // Кнопки "Редактировать"
    document.querySelectorAll(".edit-packaging").forEach(btn => {
        btn.addEventListener("click", () => {
            const card = btn.closest(".card");
            const updateUrl = btn.dataset.updateUrl; // URL обновления из кнопки
            openModal(card, updateUrl);
        });
    });
});
