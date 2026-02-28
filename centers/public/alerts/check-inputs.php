<script>
    document.addEventListener('DOMContentLoaded', function() {

        function validateForm(form) {
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

            if (!isValid) {
                firstInvalid?.focus();
            }

            return isValid;
        }

        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const ok = validateForm(form);
                if (!ok) {
                    e.preventDefault();
                }
            });
        });

        // ------------ REALTIME ERROR FIX -------------
        document.querySelectorAll('.checkInput, .checkInputGroup').forEach(input => {
            input.addEventListener('input', function() {
                const form = this.closest("form");
                const val = this.value.trim();

                if (this.classList.contains('checkInputGroup')) {
                    const group = form.querySelectorAll('.checkInputGroup');
                    const hasValue = Array.from(group).some(i => i.value.trim() !== '');
                    group.forEach(i => i.classList.toggle('border-error', !hasValue));
                } else {
                    this.classList.toggle('border-error', val === '');
                }
            });
        });

        document.querySelectorAll('.checkSelect').forEach(select => {
            select.addEventListener('change', function() {
                const val = this.value;
                const isDisabledSelected = this.selectedOptions[0]?.disabled;
                const invalid = val.trim() === '' || isDisabledSelected;

                this.classList.toggle('select-error', invalid);
                Array.from(this.options).forEach(opt => {
                    opt.classList.remove('select-error-option');
                });
                if (invalid) {
                    this.selectedOptions[0]?.classList.add('select-error-option');
                }
            });
        });

    });
</script>