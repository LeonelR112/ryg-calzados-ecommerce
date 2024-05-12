@if(isset($_SESSION['notification']))
    <script>
        Swal.fire({
            icon: `{{ $_SESSION['notification']['icon'] }}`,
            title: `{{ $_SESSION['notification']['title'] }}`,
            html: `<p class="text-start text-muted small">{!! $_SESSION['notification']['html'] !!}</p>`
        })
    </script>
    @php
        unset($_SESSION['notification']);
    @endphp
@endif