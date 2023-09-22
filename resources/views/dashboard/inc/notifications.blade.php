@if ( session('success') || session('error') )
    <script>
        Toastify({
            text: "{{ session('success') ? session('success') : ( session('error') ? session('error') : '') }}",
            close: true,
            stopOnFocus: true,
            style: {
                background: "{{ session('success') ? '#198754' : ( session('error') ? '#dc3545' : '') }}",
            }
        }).showToast();
    </script>
@endif

@if ($errors->any())
    <script>
        @foreach ($errors->all() as $error)
            Toastify({
                text: "{{ $error }}",
                close: true,
                stopOnFocus: true,
                style: {
                    background: "#dc3545",
                }
            }).showToast();
        @endforeach
    </script>
@endif