<!-- calculate invoice -->
<script>
    const categories = document.querySelectorAll(".order-categories button");
    const items = document.querySelectorAll(".order-item");
    // const tbody = document.querySelector("#order-invoice-table tbody");
    const tbodies = document.querySelectorAll("#order-invoice-table tbody");

    const totalEl = document.getElementById("order-total");

    let cart = {};

    function toFNumber(n) {
        return n.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹' [d]);
    }

    categories.forEach((btn) => {
        btn.addEventListener("click", () => {
            categories.forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");
            const cat = btn.dataset.category;
            items.forEach((item) => {
                item.style.display =
                    item.dataset.category === cat ? "block" : "none";
            });
        });
    });

    items.forEach((item) => {
        item.addEventListener("click", () => {
            const name = item.dataset.name;
            const price = parseInt(item.dataset.price);

            if (!cart[name]) {
                cart[name] = {
                    qty: 1,
                    price
                };
            } else {
                cart[name].qty++;
            }
            renderInvoice();
        });
    });

    function renderInvoice() {
        tbodies.forEach(tbody => tbody.innerHTML = "");
        let total = 0;

        const hiddenDiv = document.getElementById("hidden-inputs");
        hiddenDiv.innerHTML = "";

        for (let name in cart) {
            const item = cart[name];
            total += item.qty * item.price;

            tbodies.forEach((tbody, idx) => {
                const row = document.createElement("tr");

                if (idx === 0) {
                    row.innerHTML = `
                    <td>${name}</td>
                    <td>${toFNumber(item.price)}</td>
                    <td>
                        <button class="order-qty-btn" onclick="changeQty('${name}', -1)">-</button>
                        ${item.qty}
                        <button class="order-qty-btn" onclick="changeQty('${name}', 1)">+</button>
                    </td>
                    <td>${toFNumber(item.qty * item.price)}</td>
                    <td>
                        <button onclick="removeItem('${name}')" style="background:none; border:none; cursor:pointer; padding:0;">
                            ❌
                        </button>
                    </td>
                `;
                } else {
                    row.innerHTML = `
                    <td>${name}</td>
                    <td>${toFNumber(item.price)}</td>
                    <td class="w10">${toFNumber(item.qty)}</td>
                    <td>${toFNumber(item.qty * item.price)}</td>
                `;
                }

                tbody.appendChild(row);
            });

            // ایجاد ورودی‌های پنهان
            let inputName = document.createElement("input");
            inputName.type = "hidden";
            inputName.name = "items[name][]";
            inputName.value = name;
            hiddenDiv.appendChild(inputName);

            let inputQty = document.createElement("input");
            inputQty.type = "hidden";
            inputQty.name = "items[qty][]";
            inputQty.value = item.qty;
            hiddenDiv.appendChild(inputQty);

            let inputPrice = document.createElement("input");
            inputPrice.type = "hidden";
            inputPrice.name = "items[price][]";
            inputPrice.value = item.price;
            hiddenDiv.appendChild(inputPrice);
        }

        document.querySelectorAll("#order-total").forEach(el => el.textContent = toFNumber(total));

        let allPrice = document.createElement("input");
        allPrice.type = "hidden";
        allPrice.name = "total_price";
        allPrice.value = total;
        hiddenDiv.appendChild(allPrice);

        // 🔹 کنترل نمایش دکمه ثبت سفارش
        const orderBtn = document.querySelector(".order-btn");
        if (Object.keys(cart).length === 0) {
            orderBtn.style.display = "none";
        } else {
            orderBtn.style.display = "inline-block";
        }
    }




    function changeQty(name, amount) {
        cart[name].qty += amount;
        if (cart[name].qty <= 0) delete cart[name];
        renderInvoice();
    }

    function removeItem(name) {
        delete cart[name];
        renderInvoice();
    }

    const firstCategoryBtn = document.querySelector(".order-categories button");
    firstCategoryBtn.classList.add("active");
    const firstCatName = firstCategoryBtn.dataset.category;

    items.forEach(item => {
        item.style.display = item.dataset.category === firstCatName ? "block" : "none";
    });
</script>

<!-- show selet employees -->
<script>
    const radios = document.querySelectorAll('input[name="order_type"]');
    const deliveryBox = document.querySelector('.order-delivery');
    const deliverySelect = document.querySelector('.order-delivery-select');
    const resultDiv = document.getElementById('delivery-result');

    function updateResult() {
        const selectedRadio = document.querySelector('input[name="order_type"]:checked').value;
        if (selectedRadio === 'enter') {
            resultDiv.textContent = "سفارش: داخلی";
        } else {
            if (deliverySelect.value) {
                resultDiv.textContent = "پیک: " + deliverySelect.value;
            } else {
                resultDiv.textContent = "پیک انتخاب نشده";
            }
        }
    }

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'exit') {
                deliveryBox.classList.remove('d-none');
            } else {
                deliveryBox.classList.add('d-none');
            }
            updateResult();
        });
    });

    deliverySelect.addEventListener('change', updateResult);

    updateResult();
</script>