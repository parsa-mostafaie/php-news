<?php include 'inc.php';
authAdmin(); ?>
<div class="table-responsive small">
  <?php users_table(true, 'l_users_tbl') ?>
</div>
<script>
  httplinksInit();
  ajaxContentReLoads();
</script>