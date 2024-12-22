const addToCartBtn = document.querySelectorAll(".product-btn");
let timeout;

const showAlert = (type, message) => {
    if (timeout) clearTimeout(timeout);
    const alertContainer = document.querySelector(".alert-container");
    alertContainer.classList.remove("d-none");
    const alertHTML = `
        <div class="store-alert alert-${type}">
            <span class="text-white">${message}</span>
        </div>
    `;
    alertContainer.innerHTML = alertHTML;

    timeout = setTimeout(() => {
        alertContainer.classList.add("d-none");
    }, 3000);
};

const addToCart = async (btn, itemId) => {
    const newFormData = new FormData();
    newFormData.append("itemId", itemId);
    btn.innerHTML = `<div class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`;
    const response = await fetch("cart.php", {
        method: "POST",
        body: newFormData,
    });
    const data = await response.json();
    if (data.status === 403) {
        showAlert("error", data.message);
    }
    if (data.status === 200) {
        showAlert("success", data.message);
        const cartCountDisplay = document.querySelector(".cart-count-display");
        cartCountDisplay.textContent = data.count;
    }
    btn.innerHTML = `Add To Cart`;
};

addToCartBtn.forEach((btn) => {
    btn.addEventListener("click", function (e) {
        const itemId = this.dataset.id;
        addToCart(this, itemId);
    });
});
