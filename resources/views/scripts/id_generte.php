<?php
// در کدهای بک قسمت ثبت فیس یک سشن ست میشه و توی صفحه گرفتن اطلاعات این سشن برسی میشه
    if (isset($_SESSION['search_student_id'])) {
        $studentId = $_SESSION['search_student_id'];
    }


    // مقدار گرفتن سشن در صفحه ثبت فیس و موقع برگشت مقدار می گیره
    $_SESSION['search_student_id'] = $request['student_id'];
?>
// این قطعه کد برای گرفتن اطلاعات شاگرد به صورت اتوماتیک بعد از ثبت فیس در لایو سرچ است که اگر یک سشن مقدار گرفته باشه متود اجرا میشه
    <script>
        $(document).ready(function() {
            var studentId = '<?= isset($studentId) ? $studentId : '' ?>';
            if (studentId) {
                loadUserInfo(studentId);
            }
            function loadUserInfo(id) {
                var url = '<?= url('get-student-infos') ?>' + '/' + id;
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response) {
                        $('.clearable').empty();
                        $('.show_details-class').hide();
                        if (response.status === 'success') {
                            console.log(response);
                            $('.insert-student-info').show();
                            $('#submit').show();
                            let paymentElement = document.querySelector('.bg');

                            // genral infos
                            if (response.terms_in_progress.length > 0) {
                                $('.show_details-class').show();
                                $('.title-acc').append('سمستر جاری: سمستر ' + response.terms_in_progress[0].name_term);
                                $('#show_class_name').append(response.class_infos.lesson_name);
                                $('#show_class_time').append(response.class_infos.time);
                                $('#show_term_payment').append(response.terms_in_progress[0].total_payment);
                                $('#show_term_discount').append(response.terms_in_progress[0].total_discount);
                                let all_payment = parseInt(response.terms_in_progress[0].total_payment) + parseInt(response.terms_in_progress[0].total_discount);
                                let residue = response.terms_in_progress[0].cost_term - all_payment;
                                $('#show_term_all_payment').append(all_payment);
                                $('#show_term_residue').append(residue);

                                if (parseInt(all_payment) < parseInt(response.terms_in_progress[0].cost_term)) {
                                    paymentElement.style.border = '1px solid #ff0000ff';
                                } else {
                                    paymentElement.style.border = '1px solid #36a303ff';
                                }
                            }

                            // start get end terms
                            if (response.terms_end_details.length > 0) {
                                $.each(response.terms_end_details, function(index, termsEndDetails) {
                                    let all_payment = parseInt(termsEndDetails.total_payment) + parseInt(termsEndDetails.total_discount);
                                    let residue = termsEndDetails.cost_term - all_payment;
                                    var accordionHtml = `
                                    <div class="accordion-item clearable">
                                        <div class="accordion-title color-orange clearable bgPayment">مشخصات سمستر ${termsEndDetails.name_term}</div>
                                        <div class="show_details-table">
                                            <div>
                                                <div class="detailes-culomn d-flex cursor-p bg-main">
                                                    <div class="title-detaile clearable fs14">فیس پرداختی</div>
                                                    <div class="info-detaile fs14">${termsEndDetails.total_payment}</div>
                                                </div>
                                                <div class="detailes-culomn d-flex cursor-p bg-main">
                                                    <div class="title-detaile clearable fs14">تخفیف</div>
                                                    <div class="info-detaile fs14">${termsEndDetails.total_discount}</div>
                                                </div>
                                                <div class="detailes-culomn d-flex cursor-p bg-main">
                                                    <div class="title-detaile clearable fs14">مجموع</div>
                                                    <div class="info-detaile fs14">${all_payment}</div>
                                                </div>
                                                <div class="detailes-culomn d-flex cursor-p bg-main">
                                                    <div class="title-detaile clearable fs14">فیس باقیمانده</div>
                                                    <div class="info-detaile fs14">${residue}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearable">
                                        <br />
                                        <hr class="hr" />
                                        <br />
                                    </div>
                                `;
                                    $('#accordion-container').append(accordionHtml);
                                    let PaymentStatus = document.querySelectorAll('.bgPayment')[index];
                                    if (all_payment < termsEndDetails.cost_term) {
                                        PaymentStatus.style.border = '1px solid #ff0000ff';
                                    } else {
                                        PaymentStatus.style.border = '1px solid #36a303ff';
                                    }
                                });
                            } // end get end terms

                            // start set infos for form
                            $('#form_class_id').append(' <input type="hidden" value=" ' + response.class_infos.id + '" name="class_id"/>');
                            $.each(response.all_terms, function(index, allTerms) {
                                if (allTerms.status === 1 || allTerms.status === 3) {
                                    let selected = response.terms_in_progress.some(term => term.id === allTerms.id) ? 'selected' : '';
                                    $('#terms-select').append('<option value="' + allTerms.id + '" ' + selected + '>' + allTerms.name_term + '</option>');
                                }
                            }); // end set infos for form

                        } else {
                            console.log(response.status);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('error');
                        $('#student_info').append('<p>خطا در دریافت اطلاعات</p>');
                    }
                });
            }

            $('#user_id').on('change', function() {
                var id = $(this).val();
                loadUserInfo(id);
            });
        });
    </script>
