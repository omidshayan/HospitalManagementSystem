<script>
    $(document).ready(function() {
        let currentIndex = -1;
        let sellersData = [];

        $(document).on('keydown', '.liveSearchInput', function(e) {
            if (e.key === "ArrowDown" || e.key === "ArrowUp" || e.key === "Enter") {
                e.preventDefault();
                navigateOptions(e, $(this));
            }
        });

        $(document).on('keyup', '.liveSearchInput', function(e) {
            let query = $(this).val().trim();
            let url = $(this).data('url');
            let param = $(this).data('param');
            let targetList = $($(this).data('target-list'));
            let targetHidden = $($(this).data('target-hidden'));

            if (["ArrowDown", "ArrowUp", "Enter"].includes(e.key)) return;

            if (query.length > 0) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        [param]: query,
                        csrf_token: $('input[name="csrf_token"]').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        let output = '';
                        sellersData = [];
                        if (response.status === 'success' && response.sellers.length > 0) {
                            response.sellers.forEach(function(seller) {
                                sellersData.push(seller);
                                output += `<li class="resSel search-item color" 
                                            role="option" 
                                            data-id="${seller.id}">
                                            ${seller.user_name}
                                       </li>`;
                            });
                        } else {
                            output = '<li class="resSel search-item color" role="option">چیزی یافت نشد</li>';
                        }
                        targetList.removeClass('d-none').html(output).show();
                        currentIndex = -1;
                    },
                    error: function(xhr) {
                        console.log("AJAX Error:", xhr.responseText);
                        targetList.html('<li class="resSel search-item color" role="option">خطایی رخ داد، لطفا دوباره امتحان کنید</li>').show();
                    }
                });
            } else {
                targetList.addClass('d-none').hide();
            }
        });

        function navigateOptions(e, inputElement) {
            let targetList = $(inputElement.data('target-list'));
            const items = targetList.find('li');

            if (e.key === "ArrowDown") {
                if (currentIndex < items.length - 1) {
                    currentIndex++;
                    items.removeClass('selected');
                    items.eq(currentIndex).addClass('selected');
                }
            } else if (e.key === "ArrowUp") {
                if (currentIndex > 0) {
                    currentIndex--;
                    items.removeClass('selected');
                    items.eq(currentIndex).addClass('selected');
                }
            } else if (e.key === "Enter") {
                if (currentIndex > -1) {
                    const selectedItem = items.eq(currentIndex);
                    const sellerName = selectedItem.text();
                    const sellerId = selectedItem.data('id');
                    inputElement.val(sellerName);
                    $(inputElement.data('target-hidden')).val(sellerId).trigger('change');
                    targetList.hide();
                }
            }
        }

        $(document).on('click', '.search-back li', function() {
            let inputElement = $('.liveSearchInput:focus');
            if (!inputElement.length) inputElement = $('.liveSearchInput').first();

            const sellerName = $(this).text();
            const sellerId = $(this).data('id');

            inputElement.val(sellerName);
            $(inputElement.data('target-hidden')).val(sellerId).trigger('change');
            $(inputElement.data('target-list')).hide();
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('.liveSearchInput, .search-back').length) {
                $('.search-back').hide();
            }
        });

        $(document).on('focus', '.liveSearchInput', function() {
            if ($(this).val().length > 0) {
                $($(this).data('target-list')).show();
            }
        });
    });
</script>