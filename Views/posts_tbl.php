<?php include 'inc.php';
authAdmin();
$last = urlParam_Sended('last');
$by = urlParam_Sended('by');
$prefix = ($last ? 'l' : 'a') . ($by ? 's' : ''); // ls l as a
?>
<div class="table-responsive small">
  <?php posts_table($last, $by ? getCurrentUserInfo_prop('ID') : null, $prefix . '_posts_tbl') ?>
</div>
<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>