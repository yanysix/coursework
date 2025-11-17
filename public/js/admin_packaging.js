document.addEventListener("DOMContentLoaded", function () {

    const modal = document.getElementById("packaging-modal");
    const openBtn = document.getElementById("show-add-packaging");
    const closeBtn = document.querySelector("#packaging-modal .close");
    const form = document.getElementById("packaging-form");

    const packagingIdInput = document.getElementById("packaging-id");
    const nameInput = document.getElementById("name");
    const priceInput = document.getElementById("price");
    const imageInput = document.getElementById("image");
    const currentImage = document.getElementById("current-image");

    const modalTitle = document.getElementById("modal-title");
    const saveButton = document.getElementById("save-packaging");

    const storeUrl = form.dataset.storeUrl;


    // -----------------------------
    // Открытие модалки (добавление)
    // -----------------------------
    openBtn.addEventListener("click", function () {
        modal.style.display = "block";

        modalTitle.textContent = "Добавить упаковку";
        saveButton.textContent = "Добавить";

        form.action = storeUrl;
        form.method = "POST";

        packagingIdInput.value = "";
        nameInput.value = "";
        priceInput.value = "";
        imageInput.value = "";
        currentImage.innerHTML = "";
    });


    // -----------------------------
    // Закрытие модалки
    // -----------------------------
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    window.addEventListener("click", function (e) {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });


    // -----------------------------
    // Редактирование упаковки
    // -----------------------------
    document.querySelectorAll(".edit-packaging").forEach(button => {
        button.addEventListener("click", function () {

            const card = this.closest(".card");
            const id = card.dataset.id;

            fetch(`/admin/packaging/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    modal.style.display = "block";

                    modalTitle.textContent = "Редактировать упаковку";
                    saveButton.textContent = "Сохранить изменения";

                    form.action = `/admin/packaging/${id}`;
                    form.method = "POST";

                    packagingIdInput.value = data.id;
                    nameInput.value = data.name;
                    priceInput.value = data.price ?? "";

                    currentImage.innerHTML = data.image_url
                        ? `<img src="${data.image_url}" width="120" style="margin-bottom:10px;border-radius:6px;">`
                        : "";
                });
        });
    });

});
