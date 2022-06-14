<!-- <?php
        echo '<pre>';
        print_r($_SESSION);
        print_r($_SESSION['login']['type']);
        echo '</pre>';
        ?>  -->
<!-- Start Footerbar -->

</div>
<div class="footerbar">
    <footer class="footer">
        <p class="mb-0">© <?= date('Y') ?> Karawang Peduli - All Rights Reserved.</p>
    </footer>
</div>
<!-- End Footerbar -->
</div>

</body>

<!-- App js -->
<script src="<?= BASEURL ?>/assets/js/app.js"></script>
<script>
    function reload_location(url) {
        location.href = "<?= BASEURL; ?>/" + url;
    }
</script>


</html>