<?php include 'inc.php';
use App\Auth;

Auth::authAdmin(2); ?>
<div class="table-responsive small">
  <?php users_table(false) ?>
</div>
<script>
  httplinksInit();
  ajaxContentReLoads();
</script>