<script>
    $(document).ready(function() {
        function updateStatus(element, isChecked = null) {
            let checkbox = $(element);
            let statusText = $(checkbox.data('target'));
            let url = checkbox.data('url');

            let trueText = checkbox.data('true-text') || '(فعال)';
            let falseText = checkbox.data('false-text') || '(غیر فعال)';
            let trueClass = checkbox.data('true-class') || 'color-green';
            let falseClass = checkbox.data('false-class') || 'color-orange';

            // غیر فعال کردن موقت تا پایان درخواست
            checkbox.prop('disabled', true);

            $.post(url, function(response) {
                    if (response.success) {
                        let newStatus = response.id; // فرض بر اینکه 1 یا 0 برمیگرده

                        let newText = newStatus == 1 ? trueText : falseText;
                        let addClass = newStatus == 1 ? trueClass : falseClass;
                        let removeClass = newStatus == 1 ? falseClass : trueClass;

                        statusText.fadeOut(100, function() {
                            $(this).html(newText).removeClass(removeClass).addClass(addClass).fadeIn(100);
                        });

                        // اگر چک‌باکس هست، وضعیت checked رو بروز کن
                        if (checkbox.is(':checkbox') && isChecked !== null) {
                            checkbox.prop('checked', newStatus == 1);
                        }
                    } else {
                        alert('خطا در بروزرسانی وضعیت!');
                    }
                }, 'json')
                .fail(function() {
                    alert('خطا در ارسال درخواست به سرور!');
                })
                .always(function() {
                    checkbox.prop('disabled', false);
                });
        }

        // برای چک‌باکس ها
        $('.setting-toggle[type="checkbox"]').change(function() {
            updateStatus(this, $(this).prop('checked'));
        });

        // برای آیکون ضربدر
        $('.setting-toggle:not([type="checkbox"])').click(function() {
            updateStatus(this);
        });
    });

    // $(document).ready(function() {
    //     $('.setting-toggle').change(function() {
    //         let checkbox = $(this);
    //         let statusText = $(checkbox.data('target'));
    //         let url = checkbox.data('url');

    //         let trueText = checkbox.data('true-text') || '(فعال)';
    //         let falseText = checkbox.data('false-text') || '(غیر فعال)';
    //         let trueClass = checkbox.data('true-class') || 'color-green';
    //         let falseClass = checkbox.data('false-class') || 'color-orange';

    //         checkbox.prop('disabled', true);

    //         $.post(url, function(response) {
    //                 if (response.success) {
    //                     let newStatus = response.id;

    //                     let newText = newStatus == 1 ? trueText : falseText;
    //                     let addClass = newStatus == 1 ? trueClass : falseClass;
    //                     let removeClass = newStatus == 1 ? falseClass : trueClass;

    //                     statusText.fadeOut(100, function() {
    //                         $(this).html(newText).removeClass(removeClass).addClass(addClass).fadeIn(100);
    //                     });
    //                 } else {
    //                     alert('خطا در بروزرسانی وضعیت!');
    //                 }
    //             }, 'json')
    //             .fail(function() {
    //                 alert('خطا در ارسال درخواست به سرور!');
    //             })
    //             .always(function() {
    //                 checkbox.prop('disabled', false);
    //             });
    //     });
    // });
</script>