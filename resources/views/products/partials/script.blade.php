<script>
    $(document).ready(function() {
        $('#price').on('input', function() {
            let input = $(this);
            let cursorPosition = input.prop("selectionStart");
            let rawValue = input.val().replace(/\D/g, '');
            let formattedValue = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            let diff = formattedValue.length - input.val().length;

            input.val(formattedValue);
            input[0].setSelectionRange(cursorPosition + diff, cursorPosition + diff);
        });
    });
</script>
