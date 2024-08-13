<?php include 'inc.php';
use App\Auth;

Auth::authAdmin(2); ?>
  <?php categories_table() ?>
<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>