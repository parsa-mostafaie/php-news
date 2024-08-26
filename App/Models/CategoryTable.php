<?php
namespace App\Models;

trait CategoryTable
{
  function toTableRow()
  {
    return ['tbl_id', 'name', 'tbl_actions'];
  }

  function tbl_id()
  {
    ?>
    <a href="<?= $this->get_url() ?>"><?= $this->_id(); ?></a>
    <?php
  }

  function tbl_actions()
  {
    ?>
    <a href="<?= c_url('/admin/pages/categories/edit.php?cat=') . $this->_id() ?>"
      class="btn btn-sm btn-outline-dark">ویرایش</a>
    <a type="submit" http-method="DELETE" danger-btn ajax-reload='#a_cats_tbl'
      href="<?= c_url('/admin/pages/categories/rem.php?cat=') . $this->_id() ?>"
      class="btn btn-sm btn-outline-danger">حذف</a>
    <?php
  }

}