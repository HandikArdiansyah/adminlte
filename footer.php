<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    header("Location: index.php");
    exit();
}

include_once "auth.php";
?>

<!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">#EssereFerrari</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2014-2025&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
            </strong>
                All rights reserved.
            <!--end::Copyright-->
        </footer>
    <!--end::Footer-->