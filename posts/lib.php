<?php
function comment($cid)
{
  $comment = db()->TABLE('comments as c', true)->
    SELECT('CONCAT(u.firstname, " ", u.lastname) as fname, c.text, u.profile, c.verify')
    ->WHERE('c.ID=' . $cid)
    ->ON('u.ID = c.user_id', 'users as u');

  if (!isAdmin()) {
    $comment = $comment->WHERE('(verify = 1 OR user_id = ' . getCurrentUserInfo_prop('ID') . ')');
  }

  $comment = $comment->getFirstRow();

  if (!$comment->found) {
    return '';
  }
  $und =
    web_url(c_url('/assets/images/profile.png'));
  $pimg = $comment->getAssetBasedCol('profile')->
    get_img(
      'width="45" height="45" alt="user-profile" class="rounded-circle"',
      $und
    );

  $vhref = isAdmin() ? c_url('/admin/pages/comments/index.php#' . $cid) : '#c' . $cid;
  $v = <<<HTML
                <div class='position-absolute' style='top: 5px;left:5px'><a
                    href="$vhref"><span
                      class="badge text-bg-danger">تایید
                      نشده</span></a></div>
                HTML;
  $v = !$comment->getColumn('verify') ? $v : '';
  return '<div class="card bg-light-subtle mb-3" id="c' . $cid . '">
  ' . $v . '
            <div class="card-body">
              <div class="d-flex align-items-center">
                ' . $pimg . '

                <h5 class="card-title me-2 mb-0 position-relative">' . $comment->getColumn('fname') . '</h5>
              </div>

              <p class="card-text pt-3 pr-3">
                ' . nl2br($comment->getColumn('text')) . '
              </p>
            ' . comments($cid) . '
            </div>
          </div>';
}

function comments_fetch($parent = 'NULL', $nop = false)
{
  global $post_id;
  $verb = strtoupper($parent) == 'NULL' ? 'is' : '=';
  $coms = db()->TABLE('comments as c', true)->SELECT('id')
    ->WHERE('c.post=' . $post_id)->WHERE($nop ? '1=1' : "c.parent $verb $parent");
  if (!isAdmin()) {
    $coms = $coms->WHERE('1=1 AND (verify = 1 OR user_id = ' . getCurrentUserInfo_prop('ID') . ')');
  }
  return $coms->Run()->fetchAll(PDO::FETCH_ASSOC);
}

function comments($parent = 'NULL')
{
  $s = '';
  foreach (comments_fetch($parent) as $comm) {
    $s .= comment($comm['id']);
  }
  return $s;
} ?>