<script>
    $(document).ready(function() {
        let currentIndex = -1;
        let studentsData = [];
        $('#student_name').on('keydown', function(e) {
            if (e.key === "ArrowDown" || e.key === "ArrowUp" || e.key === "Enter") {
                e.preventDefault();
                navigateOptions(e);
            }
        });

        $('#student_name').on('keyup', function(e) {
            let query = $(this).val();
            if (e.key !== "ArrowDown" && e.key !== "ArrowUp" && e.key !== "Enter") {
                if (query.length > 0) {
                    $.ajax({
                        url: '<?= url('search-student-email') ?>',
                        method: 'POST',
                        data: {
                            customer_name: query,
                            csrf_token: $('input[name="csrf_token"]').val()
                        },
                        dataType: 'json',
                        success: function(response) {
                            let output = '';
                            studentsData = [];
                            if (response.status === 'success' && response.students.length > 0) {
                                response.students.forEach(function(student) {
                                    studentsData.push(student);
                                    output += '<li class="res search-item color" role="option" data-id="' + student.id + '">' + student.email + '</li>';
                                });
                            } else {
                                // output = '<li class="res search-item color" role="option">چیزی یافت نشد</li>';
                            }
                            $('#backResponse').html(output).show();
                            currentIndex = -1;
                        },
                        error: function(xhr, status, error) {
                            $('#backResponse').html('<li class="res search-item color" role="option">خطایی رخ داد، لطفا دوباره امتحان کنید</li>').show();
                            console.log(xhr.responseText);
                        }
                    });
                } else {
                    $('#backResponse').hide();
                }
            }
        });

        function navigateOptions(e) {
            const items = $('#backResponse li');
            const container = $('#backResponse');
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
                    const studentName = selectedItem.text();
                    const studentId = selectedItem.data('id');
                    $('#student_name').val(studentName);
                    $('#user_id').val(studentId).trigger('change'); // Set the student ID and trigger change event
                    $('#backResponse').hide();
                    $('#btn-get-infos').show();
                }
            }
            const selectedElement = items.eq(currentIndex);
            if (selectedElement.length > 0) {
                container.scrollTop(selectedElement.position().top + container.scrollTop() - container.height() / 2);
            }
        }

        $(document).on('click', '#backResponse li', function() {
            const studentName = $(this).text();
            const studentId = $(this).data('id');
            $('#student_name').val(studentName);
            $('#user_id').val(studentId).trigger('change'); // Set the student ID and trigger change event
            $('#backResponse').hide();
            $('#btn-get-infos').show();
        });

        $(document).on('click', function(event) {
            if (!$(event.target).closest('#student_name, #backResponse').length) {
                $('#backResponse').hide();
            }
        });

        $('#student_name').on('focus', function() {
            if ($(this).val().length > 0) {
                $('#backResponse').show();
            }
        });
    });

    // $(document).ready(function() {
    //     let currentIndex = -1;
    //     let studentsData = []; // Array to store students data

    //     $('#student_name').on('keydown', function(e) {
    //         if (e.key === "ArrowDown" || e.key === "ArrowUp" || e.key === "Enter") {
    //             e.preventDefault();
    //             navigateOptions(e);
    //         }
    //     });

    //     $('#student_name').on('keyup', function(e) {
    //         let query = $(this).val();
    //         if (e.key !== "ArrowDown" && e.key !== "ArrowUp" && e.key !== "Enter") {
    //             if (query.length > 0) {
    //                 $.ajax({
    //                     url: '<?= url('search-student') ?>',
    //                     method: 'POST',
    //                     data: {
    //                         customer_name: query,
    //                         csrf_token: $('input[name="csrf_token"]').val()
    //                     },
    //                     dataType: 'json',
    //                     success: function(response) {
    //                         let output = '';
    //                         studentsData = []; // Clear previous data
    //                         if (response.status === 'success' && response.students.length > 0) {
    //                             response.students.forEach(function(student) {
    //                                 studentsData.push(student); // Store student data
    //                                 output += '<li class="res search-item color" role="option" data-id="' + student.id + '">' + student.name + ' - ' + student.phone + '</li>';
    //                             });
    //                         } else {
    //                             output = '<li class="res search-item color" role="option">چیزی یافت نشد</li>';
    //                         }
    //                         $('#backResponse').html(output).show();
    //                         currentIndex = -1;
    //                     },
    //                     error: function(xhr, status, error) {
    //                         $('#backResponse').html('<li class="res search-item color" role="option">خطایی رخ داد، لطفا دوباره امتحان کنید</li>').show();
    //                         console.log(xhr.responseText);
    //                     }
    //                 });
    //             } else {
    //                 $('#backResponse').hide();
    //             }
    //         }
    //     });

    //     function navigateOptions(e) {
    //         const items = $('#backResponse li');
    //         const container = $('#backResponse');
    //         if (e.key === "ArrowDown") {
    //             if (currentIndex < items.length - 1) {
    //                 currentIndex++;
    //                 items.removeClass('selected');
    //                 items.eq(currentIndex).addClass('selected');
    //             }
    //         } else if (e.key === "ArrowUp") {
    //             if (currentIndex > 0) {
    //                 currentIndex--;
    //                 items.removeClass('selected');
    //                 items.eq(currentIndex).addClass('selected');
    //             }
    //         } else if (e.key === "Enter") {
    //             if (currentIndex > -1) {
    //                 const selectedItem = items.eq(currentIndex);
    //                 const studentName = selectedItem.text();
    //                 const studentId = selectedItem.data('id');
    //                 $('#student_name').val(studentName);
    //                 $('#user_id').val(studentId); // Set the student ID
    //                 $('#backResponse').hide();
    //             }
    //         }
    //         const selectedElement = items.eq(currentIndex);
    //         if (selectedElement.length > 0) {
    //             container.scrollTop(selectedElement.position().top + container.scrollTop() - container.height() / 2);
    //         }
    //     }

    //     $(document).on('click', '#backResponse li', function() {
    //         const studentName = $(this).text();
    //         const studentId = $(this).data('id');
    //         $('#student_name').val(studentName);
    //         $('#user_id').val(studentId); // Set the student ID
    //         $('#backResponse').hide();
    //     });

    //     $('#myForm').on('submit', function(e) {
    //         e.preventDefault();
    //         // Submit form or any other action you want
    //     });

    //     $(document).on('click', function(event) {
    //         if (!$(event.target).closest('#student_name, #backResponse').length) {
    //             $('#backResponse').hide();
    //         }
    //     });

    //     $('#student_name').on('focus', function() {
    //         if ($(this).val().length > 0) {
    //             $('#backResponse').show();
    //         }
    //     });
    // });
</script>