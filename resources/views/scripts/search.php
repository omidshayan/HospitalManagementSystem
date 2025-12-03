<script>
    $(document).ready(function() {

        let itemsData = [];
        let currentIndex = -1;

        const $productName = $('#item_name');
        const $backResponse = $('#backResponse');
        const searchUrl = $productName.data('search-url');

        // جستجو زنده
        $productName.on('keyup', function(e) {
            const query = $(this).val();

            if (["ArrowDown", "ArrowUp", "Enter"].includes(e.key)) return;
            if (!query.length) {
                $backResponse.hide();
                return;
            }

            $backResponse.html('<li class="search-item text-center">در حال جستجو...</li>').show();

            $.post(searchUrl, {
                customer_name: query,
                csrf_token: $('input[name="csrf_token"]').val()
            }, function(response) {
                let output = '';
                itemsData = [];

                if (response.status === 'success' && response.products.length) {
                    response.products.forEach(p => {
                        itemsData.push(p);
                        output += `<li class="res search-item" data-id="${p.id}">${p.product_name}</li>`;
                    });
                } else {
                    output = '<li class="res search-item color">چیزی یافت نشد</li>';
                }

                $backResponse.html(output);
                currentIndex = -1;
            }, 'json');
        });

        // انتخاب با کلیک
        $(document).on('click', '#backResponse li', function() {
            if ($(this).hasClass('color')) return;

            const id = $(this).data('id');
            const name = $(this).text();

            $('#item_id').val(id);
            $('#item_name').val(name);

            $backResponse.hide();
        });

        // انتخاب با کیبورد
        $productName.on('keydown', function(e) {
            const items = $backResponse.find('li');

            if (e.key === "ArrowDown") currentIndex = Math.min(currentIndex + 1, items.length - 1);
            if (e.key === "ArrowUp") currentIndex = Math.max(currentIndex - 1, 0);

            if (e.key === "Enter" && currentIndex > -1) {
                e.preventDefault();
                const it = items.eq(currentIndex);
                if (!it.hasClass('color')) {
                    $('#item_id').val(it.data('id'));
                    $('#item_name').val(it.text());
                    $backResponse.hide();
                }
            }

            items.removeClass('selected');
            if (currentIndex > -1) {
                items.eq(currentIndex).addClass('selected');
            }
        });

        // مخفی کردن لیست وقتی بیرون کلیک شود
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#item_name, #backResponse').length) {
                $backResponse.hide();
            }
        });

    });
</script>