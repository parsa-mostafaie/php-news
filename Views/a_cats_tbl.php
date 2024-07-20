<?php include 'inc.php';
use App\Auth;

Auth::authAdmin(2); ?>
<div class="table-responsive small">
  <?php categories_table() ?>
</div>
<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>