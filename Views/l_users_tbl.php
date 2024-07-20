<?php include 'inc.php';
use App\Auth;

Auth::authAdmin(2); ?>
<div class="table-responsive small">
  <?php users_table(true, 'l_users_tbl') ?>
</div>
<script>
  httplinksInit();
  ajaxContentReLoads();
</script>