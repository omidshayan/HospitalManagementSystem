<script>
    $(document).ready(function() {
        $('#submitform').submit(function(event) {
            showLoadingOverlay()
            $("#submit").hide();
            event.preventDefault();
            var formData = new FormData(this);
            var url = $(this).data('url');
            var method = $(this).data('method');
            var successMessage = $(this).data('success-message');
            var errorMessage = $(this).data('error-message');
            $.ajax({
                type: method,
                url: url,
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    hideLoadingOverlay()
                    $("#submit").show();
                    if (response.success) {
                        $('#alert').removeClass('error').addClass('success').text(response.message).fadeIn().delay(3000).fadeOut();
                    } else {
                        $('#alert').removeClass('success').addClass('error').text(response.message).fadeIn().delay(3000).fadeOut();
                    }
                },
                error: function(xhr, status, error) {
                    $('#alert').removeClass('success').addClass('error').text(errorMessage).fadeIn().delay(3000).fadeOut();
                }
            });
        });

        function showLoadingOverlay() {
            var overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = 'flex';
            }
        }

        function hideLoadingOverlay() {
            var overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.style.display = 'none';
            }
        }

    });
</script>