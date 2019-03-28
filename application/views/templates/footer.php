<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 0.4.0
    </div>
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="#">Straits Business Group</a>.</strong> All rights reserved.
</footer>
<div class="control-sidebar-bg"></div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
</div>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() . 'assets/' ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() . 'assets/' ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() . 'assets/' ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . 'assets/' ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() . 'assets/' ?>dist/js/demo.js"></script>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url() . 'assets/' ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<!--<script src="<?php echo base_url() . 'assets/' ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>-->
<!--<script src="<?php echo base_url() . 'assets/' ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
<script src="<?php echo base_url() . 'assets/' ?>js/pnotify.custom.min.js"></script>
<!--<link href="<?php echo base_url() . 'assets/' ?>css/mk-notifications.css" rel="stylesheet">
<script src="<?php echo base_url() . 'assets/' ?>js/mk-notifications.js"></script>-->
<script type="text/javascript">
    $(function () {
        $('#example1').DataTable({
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [-1]
                }]
        })
        $('#example2').DataTable({
            "aaSorting": [],
            aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [-1]
                }]
        })
        $('#datepicker').datepicker({
            autoclose: true
        })

        $('#myModal').on('hidden.bs.modal', function () {
            location.reload();
        })
    })

    $(document).ready(function ()
    {
        $("#Mobile_number").on("blur", function ()
        {
            var mobNum = $(this).val();
            var filter = /^\d*(?:\.\d{1,2})?$/;
            if (filter.test(mobNum))
            {
                if (mobNum.length == 10 || mobNum.length == 11)
                {
                    $("#mobile-valid").removeClass("hidden");
                    $("#folio-invalid").addClass("hidden");
                    $("#submit").prop('disabled', false);
                    mob = true;
                } else
                {
                    $("#folio-invalid").removeClass("hidden");
                    $("#mobile-valid").addClass("hidden");
                    $("#submit").prop('disabled', true);
                    mob = false;
                    return false;
                }
            } else
            {
                $("#folio-invalid").removeClass("hidden");
                $("#mobile-valid").addClass("hidden");
                $("#submit").prop('disabled', true);
                mob = false;
                return false;
            }
            if (mob && em)
            {
                $("#submit").prop('disabled', false);
            }
        });

        $("#Email").on("blur", function ()
        {
            var email = $(this).val();
            var filter = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
            if (filter.test(email))
            {
                $("#email-valid").removeClass("hidden");
                $("#email-invalid").addClass("hidden");
                $("#submit").prop('disabled', false);
                em = true;
            } else
            {
                $("#email-invalid").removeClass("hidden");
                $("#email-valid").addClass("hidden");
                $("#submit").prop('disabled', true);
                em = false;
                return false;
            }
            if (mob && em)
            {
                $("#submit").prop('disabled', false);
            }
        });
    });
</script>
</body>
</html>