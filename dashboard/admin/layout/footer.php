<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto"> &copy;
            <span id="footerCopyrightDate"></span> ONLINE AUCTION
        </div>
    </div>
</footer>
</div>
</div>

<script src="<?= ROOT ?>/assets/admin/js/jquery.min.js"></script>
<script src="<?= ROOT ?>/assets/admin/js/bootstrap.bundle.min.js"></script>
<script src="<?= ROOT ?>/assets/admin/js/jquery.easing.min.js"></script>
<script src="<?= ROOT ?>/assets/admin/js/sb-admin-2.min.js"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
        $('#dataTable').DataTable({
        	order: [],
        });
    });
    document.querySelector("#footerCopyrightDate").innerHTML = new Date().getFullYear();
</script>

</body>
</html>