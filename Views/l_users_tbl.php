<?php include 'inc.php';
use App\Auth;

Auth::authAdmin(2); ?>
  <?php users_table(true, 'l_users_tbl') ?>
<script>
  httplinksInit();
  ajaxContentReLoads();
</script>