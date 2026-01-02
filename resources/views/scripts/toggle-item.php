<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggles = document.querySelectorAll('.toggle-item');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const wrapper = toggle.closest('.input-wrapper');

                if (wrapper) {
                    wrapper.remove();
                }

                const url = toggle.getAttribute('data-url');
                if (!url) {
                    console.warn('URL برای تغییر وضعیت داده نشده');
                    return;
                }

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
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