<?php
namespace App\Models;

use App\Auth;

trait CommentTable
{
  function toTableRow()
  {
    return ['tbl_id', 'author_fullname', 'tbl_post', 'tbl_parent', 'summary', 'tbl_actions'];
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

  function tbl_parent()
  {
    if (!$this['parent_id'])
      return;
    ?>
    <a href="<?= $this->parent->get_url() ?>"><?= $this->parent->author->fullname ?></a>
    <?php
  }

  function tbl_post()
  {
    ?>
    <a href="<?= $this->_post->get_url() ?>"><?= truncate($this->_post->title) ?></a>
    <?php
  }

  function getSummaryAttribute()
  {
    return truncate($this->text);
  }

  function tbl_actions($id)
  {
    $canverify = $this->can_verified();
    $verified = $this->verified();

    $danger = $verified ? 'danger-btn' : '';

    $url = url(c_url('/writer/comment.php'), ['com' => $this->_id(), 'v' => $verified ? 0 : 1]);

    $href = $canverify ?
      "href='$url' http-method='PUT' ajax-reload='#$id' $danger" : '';

    $disable = $canverify ? '' : 'disabled';
    if (!$verified): ?>
      <a <?= $href ?> class="btn btn-sm btn-outline-info <?= $disable ?>">در
        انتظار تایید</a>
    <?php else: ?>
      <a <?= $href ?> class="btn btn-sm btn-success <?= $disable ?>">تایید شده</a>
    <?php endif; ?>
    <?php if (Auth::isRole(2)): ?>
      <a danger-btn http-method="DELETE" ajax-reload="#<?= $id ?>"
        href="<?= url(c_url('/admin/pages/comments/rem.php'), ['com'=>$this->_id()]) ?>"
        class="btn btn-sm btn-outline-danger">حذف</a>
    <?php endif ?>
  <?php
  }
}