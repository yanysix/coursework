document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("bouquet-modal");
    const btnAdd = document.getElementById("show-add-bouquet");
    const closeBtn = modal.querySelector(".close");
    const form = document.getElementById("bouquet-form");

    const bouquetIdInput = document.getElementById("bouquet-id");
    const nameInput = document.getElementById("name");
    const priceInput = document.getElementById("price");
    const zodiacSelect = document.getElementById("zodiac_sign");
    const currentImage = document.getElementById("current-image");
    const modalTitle = document.getElementById("modal-title");
    const storeUrl = form.dataset.storeUrl;

    const openModal = (data = null, updateUrl = null) => {
        form.reset();
        currentImage.innerHTML = "";

        // Удаляем старое _method
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();

        if (data && updateUrl) {
            // Редактирование
            modalTitle.textContent = "Редактировать букет";
            form.action = updateUrl;
            form.method = "POST"; // Всегда POST, Laravel преобразует через _method

            // Добавляем скрытое поле _method=PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);

            bouquetIdInput.value = data.id;
            nameInput.value = data.name;
            priceInput.value = data.price;
            zodiacSelect.value = data.zodiac || "";

            currentImage.innerHTML = data.image
                ? `<img src="${data.image}" style="max-width:150px; display:block; margin-bottom:15px;">`
                : "";
        } else {
            // Добавление
            modalTitle.textContent = "Добавить букет";
            form.action = storeUrl;
            bouquetIdInput.value = "";
        }

        modal.style.display = "block";
    };

    // Кнопка "Добавить"
    btnAdd.addEventListener("click", () => openModal());

    // Закрытие модалки
    closeBtn.addEventListener("click", () => modal.style.display = "none");
    window.addEventListener("click", e => {
        if (e.target === modal) modal.style.display = "none";
    });

    // Кнопки "Редактировать"
    document.querySelectorAll(".edit-bouquet").forEach(btn => {
        btn.addEventListener("click", () => {
            if (!btn.dataset.updateUrl) return;

            const data = {
                id: btn.dataset.id,
                name: btn.dataset.name || "",
                price: btn.dataset.price || "",
                zodiac: btn.dataset.zodiac || "",
                image: btn.dataset.image || ""
            };

            const updateUrl = btn.dataset.updateUrl;
            openModal(data, updateUrl);
        });
    });
});
