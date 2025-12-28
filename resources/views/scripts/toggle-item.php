<script>
    document.addEventListener('DOMContentLoaded', () => {
        // انتخاب تمام آیکون های ضربدر که کلاس 'toggle-item' دارند
        const toggles = document.querySelectorAll('.toggle-item');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                // پیدا کردن المان والد (مثلاً wrapper یا والد مناسب)
                const wrapper = toggle.closest('.input-wrapper'); // یا کلاس والد خودت را بگذار

                // اگر المان والد یافت شد، آن را حذف کن
                if (wrapper) {
                    wrapper.remove();
                }

                // گرفتن URL از data-attribute
                const url = toggle.getAttribute('data-url');
                if (!url) {
                    console.warn('URL برای تغییر وضعیت داده نشده');
                    return;
                }

                // ارسال درخواست POST به سرور برای تغییر وضعیت
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            // در صورت نیاز، توکن CSRF یا header های دیگر را اینجا اضافه کن
                        },
                        // در صورت نیاز، می توانی داده های بیشتری مثل id ارسال کنی
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert('خطا در تغییر وضعیت آیتم');
                        }
                    })
                    .catch(error => {
                        console.error('خطا در ارسال درخواست به سرور:', error);
                    });
            });
        });
    });
</script>