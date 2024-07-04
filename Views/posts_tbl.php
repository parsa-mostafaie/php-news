<?php include 'inc.php';
$last = urlParam_Sended('last');
$by = urlParam_Sended('by');
$prefix = ($last ? 'l' : 'a') . ($by ? 's' : ''); // ls l as a
Auth::authAdmin($by ? 0 : 2);
?>
<div class="table-responsive small">
  <?php posts_table($last, $by ? getCurrentUserInfo_prop('ID') : null, $prefix . '_posts_tbl') ?>
</div>
<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>