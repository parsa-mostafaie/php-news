<?php include 'inc.php';
authAdmin(); ?>
<div class="table-responsive small">
  <?php categories_table() ?>
</div>
<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>