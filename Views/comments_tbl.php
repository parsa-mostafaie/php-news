<?php include 'inc.php';
$last = urlParam_Sended('last');
$by = urlParam_Sended('by');
$prefix = ($last ? 'l' : 'a') . ($by ? 's' : ''); // ls l as a
?>
<div class="table-responsive small">
  <?php comments_table($last, $by ? getCurrentUserInfo_prop('ID') : null, $prefix . '_comments_tbl') ?>
</div>
<script>
  httplinksInit();
  dangerbtns();
  ajaxContentReLoads();
</script>