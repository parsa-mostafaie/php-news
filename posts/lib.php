<?php
function comment($cid)
{
  $comment = db()->TABLE('comments as c', true)->
    SELECT('CONCAT(u.firstname, " ", u.lastname) as fname, c.text, u.profile')
    ->WHERE('c.ID=' . $cid)
    ->WHERE('verify = 1')
    ->ON('u.ID = c.user_id', 'users as u')->getFirstRow();
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
  return '<div class="card bg-light-subtle mb-3" id="c' . $cid . '">
            <div class="card-body">
              <div class="d-flex align-items-center">
                ' . $pimg . '

                <h5 class="card-title me-2 mb-0">' . $comment->getColumn('fname') . '</h5>
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
    ->WHERE('c.post=' . $post_id)->WHERE($nop ? '1=1' : "c.parent $verb $parent")->WHERE('verify = 1');
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