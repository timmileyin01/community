<!-- BEGIN .main-footer -->
<footer class="main-footer fixed-btm">© 2023 <?= $settings['title'] ?></footer>
<!-- END: .main-footer -->
</div>
<!-- END: .app-wrap -->

<!-- jQuery first, then Tether, then other JS. -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="vendor/unifyMenu/unifyMenu.js"></script>
<script src="vendor/onoffcanvas/onoffcanvas.js"></script>
<script src="js/moment.js"></script>



<!-- Data Tables -->
<script src="vendor/datatables/dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap.min.js"></script>

<!-- Custom Data tables -->
<script src="vendor/datatables/custom/custom-datatables.js"></script>
<script src="vendor/datatables/custom/fixedHeader.js"></script>



<!-- Slimscroll JS -->
<script src="vendor/slimscroll/slimscroll.min.js"></script>
<script src="vendor/slimscroll/custom-scrollbar.js"></script>

<!-- Common JS -->
<script src="js/common.js"></script>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/c003743f81.js" crossorigin="anonymous"></script>

<!-- for alerts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>



<script>
    $(document).ready(function() {
        $('table').DataTable({
            order: [0, 'desc']
        });


        $("#appendPrice").click(function() {

            $("#receivePrice").append('<div class="form-group"><span class="text-dark my-1">Regular in (Naira)</span><input type="text" class="form-control" name="regularPrice" placeholder="Price e.g. 6000"></div><div class="form-group"><span class="text-dark my-1">VIP in (Naira)</span><input type="text" class="form-control" name="vipPrice" placeholder="Price e.g. 6000"></div><div class="form-group"><span class="text-dark my-1">VVIP in (Naira)</span><input type="text" class="form-control" name="vvipPrice" placeholder="Price e.g. 6000"></div>');
            $('#hideAppendPrice').hide();
        });
    });
</script>