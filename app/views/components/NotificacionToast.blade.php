@if(isset($_SESSION['notificacion_toast']))
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="toast_notificacion" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="<?=$_SESSION['notificacion_toast']['time']?>">
        <div class="toast-header <?=$_SESSION['notificacion_toast']['classes']?>">
            <strong class="me-auto"><?=$_SESSION['notificacion_toast']['title']?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast_body">
            <?=$_SESSION['notificacion_toast']['msg']?>
        </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', e => {
            $("#toast_notificacion").toast("show");
        });
    </script>
    @php
        unset($_SESSION['notificacion_toast']);
    @endphp
@endif