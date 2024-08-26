<?php
namespace App\Models;

trait UserTable
{
  function toTableRow()
  {
    return ['tbl_id', 'fullname', 'tbl_actions'];
  }

  function tbl_id()
  {
    ?>
    <a href="#"><?= $this->id; ?></a>
    <?php
  }

  function tbl_actions($id)
  {
    $c_admin = User::current()->admin;
    $this_id = $this->_id();
    $without_actions = $this_id == User::current()->_id() || $c_admin < 2;

    if ($without_actions)
      return;

    $u_admin = $this->admin;
    
    if ($u_admin != 2)
      $upgrade_url = url(c_url('/admin/pages/users/grw.php?' . ($u_admin ? 'admin' : '')), ['usr' => $this_id]);
    else
      $downgrade_url = url(c_url('/admin/pages/users/shrnk.php'), ['usr' => $this_id]);

    if ($u_admin == 1): ?>
      <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= $upgrade_url ?>" class="btn btn-sm btn-outline-dark">ارتقا
        به ادمین</a>
    <?php endif;
    if ($u_admin < 1): ?>
      <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= $upgrade_url ?>" class="btn btn-sm btn-outline-dark">ارتقا به
        نویسنده</a>
    <?php else: ?>
      <a http-method="patch" ajax-reload="#<?= $id ?>" href="<?= $downgrade_url ?>" class="btn btn-sm btn-danger">تنزل</a>
    <?php endif;
  }

}