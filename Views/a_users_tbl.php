<?php include 'inc.php';
authAdmin(); ?>
<div class="table-responsive small">
  <?php users_table(false) ?>
</div>
<script>
  httplinksInit();
  ajaxContentReLoads();
</script>