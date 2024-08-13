<?php include 'inc.php';
use App\Auth;

Auth::authAdmin(2); ?>
  <?php users_table(false) ?>
<script>
  httplinksInit();
  ajaxContentReLoads();
</script>