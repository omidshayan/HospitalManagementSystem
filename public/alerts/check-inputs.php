<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submit');

        submitBtn.addEventListener('click', function(e) {
            let isValid = true;
            let firstInvalid = null;

            document.querySelectorAll('.checkInput').forEach(input => {
                const empty = input.value.trim() === '';
                input.classList.toggle('border-error', empty);

                if (empty) {
                    if (!firstInvalid) firstInvalid = input;
                    isValid = false;
                    input.classList.add('shake');
                    setTimeout(() => input.classList.remove('shake'), 300);
                }
            });

            const groupInputs = document.querySelectorAll('.checkInputGroup');
            if (groupInputs.length > 0) {
                const hasValue = Array.from(groupInputs).some(i => i.value.trim() !== '');
                groupInputs.forEach(input => {
                    input.classList.toggle('border-error', !hasValue);

                    if (!hasValue) {
                        if (!firstInvalid) firstInvalid = input;
                        input.classList.add('shake');
                        setTimeout(() => input.classList.remove('shake'), 300);
                    }
                });
                if (!hasValue) isValid = false;
            }

            document.querySelectorAll('.checkSelect').forEach(select => {
                const val = select.value;
                const isDisabledSelected = select.selectedOptions[0]?.disabled;
                const invalid = val.trim() === '' || isDisabledSelected;

                select.classList.toggle('select-error', invalid);

                Array.from(select.options).forEach(opt => {
                    opt.classList.remove('select-error-option');
                });
                if (invalid) {
                    select.selectedOptions[0]?.classList.add('select-error-option');
                    if (!firstInvalid) firstInvalid = select;
                    isValid = false;
                    select.classList.add('shake');
                    setTimeout(() => select.classList.remove('shake'), 300);
                }
            });

            if (!isValid) {
                e.preventDefault();
                firstInvalid?.focus();
            }
        });

        document.querySelectorAll('.checkInput, .checkInputGroup').forEach(input => {
            input.addEventListener('input', function() {
                const val = input.value.trim();

                if (input.classList.contains('checkInputGroup')) {
                    const group = document.querySelectorAll('.checkInputGroup');
                    const hasValue = Array.from(group).some(i => i.value.trim() !== '');
                    group.forEach(i => i.classList.toggle('border-error', !hasValue));
                } else {
                    input.classList.toggle('border-error', val === '');
                }
            });
        });

        document.querySelectorAll('.checkSelect').forEach(select => {
            select.addEventListener('change', function() {
                const val = select.value;
                const isDisabledSelected = select.selectedOptions[0]?.disabled;
                const invalid = val.trim() === '' || isDisabledSelected;

                select.classList.toggle('select-error', invalid);
                Array.from(select.options).forEach(opt => {
                    opt.classList.remove('select-error-option');
                });
                if (invalid) {
                    select.selectedOptions[0]?.classList.add('select-error-option');
                }
            });
        });
    });
</script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submit');

        submitBtn.addEventListener('click', function(e) {

            const form = this.closest("form"); // ✅ فقط فرم فعلی

            let isValid = true;
            let firstInvalid = null;

            // -------- checkInput --------
            form.querySelectorAll('.checkInput').forEach(input => {
                const empty = input.value.trim() === '';
                input.classList.toggle('border-error', empty);

                if (empty) {
                    if (!firstInvalid) firstInvalid = input;
                    isValid = false;
                    input.classList.add('shake');
                    setTimeout(() => input.classList.remove('shake'), 300);
                }
            });

            // -------- checkInputGroup --------
            const groupInputs = form.querySelectorAll('.checkInputGroup');
            if (groupInputs.length > 0) {
                const hasValue = Array.from(groupInputs).some(i => i.value.trim() !== '');
                groupInputs.forEach(input => {
                    input.classList.toggle('border-error', !hasValue);

                    if (!hasValue) {
                        if (!firstInvalid) firstInvalid = input;
                        input.classList.add('shake');
                        setTimeout(() => input.classList.remove('shake'), 300);
                    }
                });
                if (!hasValue) isValid = false;
            }

            // -------- checkSelect --------
            form.querySelectorAll('.checkSelect').forEach(select => {
                const val = select.value;
                const isDisabledSelected = select.selectedOptions[0]?.disabled;
                const invalid = val.trim() === '' || isDisabledSelected;

                select.classList.toggle('select-error', invalid);

                Array.from(select.options).forEach(opt => {
                    opt.classList.remove('select-error-option');
                });

                if (invalid) {
                    select.selectedOptions[0]?.classList.add('select-error-option');
                    if (!firstInvalid) firstInvalid = select;
                    isValid = false;
                    select.classList.add('shake');
                    setTimeout(() => select.classList.remove('shake'), 300);
                }
            });

            // جلوگیری از ارسال فرم اگر ارور هست
            if (!isValid) {
                e.preventDefault();
                firstInvalid?.focus();
            }
        });

        // ------------ REALTIME ERROR FIX -------------
        document.querySelectorAll('.checkInput, .checkInputGroup').forEach(input => {
            input.addEventListener('input', function() {
                const form = this.closest("form"); // 👈 فرم مربوط به همین اینپوت
                const val = input.value.trim();

                if (input.classList.contains('checkInputGroup')) {
                    const group = form.querySelectorAll('.checkInputGroup'); // 👈 داخل همان فرم
                    const hasValue = Array.from(group).some(i => i.value.trim() !== '');
                    group.forEach(i => i.classList.toggle('border-error', !hasValue));
                } else {
                    input.classList.toggle('border-error', val === '');
                }
            });
        });

        document.querySelectorAll('.checkSelect').forEach(select => {
            select.addEventListener('change', function() {
                const val = select.value;
                const isDisabledSelected = select.selectedOptions[0]?.disabled;
                const invalid = val.trim() === '' || isDisabledSelected;

                select.classList.toggle('select-error', invalid);
                Array.from(select.options).forEach(opt => {
                    opt.classList.remove('select-error-option');
                });
                if (invalid) {
                    select.selectedOptions[0]?.classList.add('select-error-option');
                }
            });
        });

    });
</script>