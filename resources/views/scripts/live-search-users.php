<script>
    $(document).ready(function() {
        let currentIndex = -1;
        let itemsData = [];
        let debounceTimer;

        const $input = $('#search_seller');
        const $resultBox = $('#backResponseSeller');

        $input.on('keydown', function(e) {
            if (["ArrowDown", "ArrowUp", "Enter"].includes(e.key)) {
                e.preventDefault();
                navigateOptions(e);
            }
        });

        $input.on('keyup', function(e) {
            const query = $input.val().trim();
            if (!["ArrowDown", "ArrowUp", "Enter"].includes(e.key)) {

                if (query.length === 0) {
                    $resultBox.addClass('d-none').hide();
                    return;
                }

                $resultBox.html('<li class="search-loading"><div class="spinner"></div> در حال جستجو...</li>')
                    .removeClass('d-none').show();

                    $.ajax({
                        url: '<?= url('search-em') ?>',
                        method: 'POST',
                        data: {
                            customer_name: query
                        },
                        dataType: 'json',
                        success: function(response) {
                            let output = '';
                            itemsData = [];
                            if (response.status === 'success' && response.items.length > 0) {
                                response.items.forEach(function(item) {
                                    itemsData.push(item);
                                    output += '<li class="resSel search-item color" role="option" data-id="' + item.id + '">' +
                                        item.user_name + ' - ' + item.birth_year + ' - ' + item.phone +
                                        '</li>';
                                });
                            } else {
                                output = '<li class="resSel search-item color" role="option">چیزی یافت نشد</li>';
                            }
                            $resultBox.html(output).show();
                            currentIndex = -1;
                        },
                        error: function(xhr) {
                            $resultBox.html('<li class="resSel search-item color" role="option">خطایی رخ داد، لطفا دوباره امتحان کنید</li>').show();
                        }
                    });
            }
        });

        function navigateOptions(e) {
            const items = $resultBox.find('li');
            if (e.key === "ArrowDown") {
                if (currentIndex < items.length - 1) currentIndex++;
            } else if (e.key === "ArrowUp") {
                if (currentIndex > 0) currentIndex--;
            } else if (e.key === "Enter") {
                if (currentIndex > -1) selectItem(currentIndex);
            }
            items.removeClass('selected');
            if (currentIndex > -1) items.eq(currentIndex).addClass('selected');
        }

        function selectItem(index) {
            const item = itemsData[index];
            if (!item) return;
            $input.val(item.employee_name);
            $('#employee_id').val(item.id).trigger('change');
            $('#bast').val(item.bast);
            $('#position').val(item.position);
            $('#appointment_type').val(item.appointment_type);
            $('#office_name').val(item.office_name);
            $('#employee_name').val(item.employee_name);
            $('#father_name').val(item.father_name);
            $('#grand_father').val(item.grand_father);
            $('#ghadam').val(item.ghadam);
            $resultBox.hide();
        }

        $resultBox.on('click', 'li', function() {
            selectItem($(this).index());
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest($input).length && !$(event.target).closest($resultBox).length) {
                $resultBox.hide();
            }
        });

        $input.on('focus', function() {
            if ($input.val().length > 0) $resultBox.show();
        });
    });
</script>