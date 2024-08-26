<?php
namespace App\Models;

use App\Auth;

trait PostTable
{
  function toTableRow()
  {
    return ['tbl_id', 'title', 'author_fullname', 'tbl_actions'];
  }

  function author_fullname()
  {
    return $this->author->fullname;
  }

  function tbl_id()
  {
    ?>
    <a href="<?= $this->get_url() ?>"><?= $this->_id(); ?></a>
    <?php
  }

  function tbl_actions($id)
  {
    if (!$this->canEdit()) {
      return;
    }
    $is_admin = Auth::isRole(2);
    $danger = $this->published() ? 'danger-btn' : '';
    $url = $this->_un_publish_url();
    $attrs = $is_admin ? "href='$url' http-method='PUT' ajax-reload='#$id' $danger" : '';

    $disable = $is_admin ? '' : 'disabled';

    if (!$this['verify']): ?>
      <a <?= $attrs ?> class="btn btn-sm btn-outline-info <?= $disable ?>">در انتظار تایید</a>
    <?php else: ?>
      <a <?= $attrs ?> class="btn btn-sm btn-success <?= $disable ?>">تایید شده</a>
    <?php endif; ?>
    <a href="<?= $this->edit_url() ?>" class="btn btn-sm btn-outline-dark">ویرایش</a>
    <?php if ($is_admin): ?>
      <a ajax-reload="#<?= $id ?>" href="<?= $this->rem_url() ?>" danger-btn class="btn btn-sm btn-outline-danger"
        http-method="DELETE">حذف</a>
    <?php endif; ?>
  <?php
  }
}