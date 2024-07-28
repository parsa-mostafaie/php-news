<?php
use App\Auth;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserProfile;

function pcl_usid_cond()
{
  return Auth::canlogin() ? cond('user_id', User::current()->id) : '0';
}
function comment($cid)
{
  $comment = db()->TABLE('comments', alias: 'c')->
    SELECT('CONCAT(u.firstname, " ", u.lastname) as fname, c.text, u.profile, c.verify, u.id as uid')
    ->WHERE('c.ID=' . $cid)
    ->ON('u.ID = c.user_id', 'users as u');

  if (!Auth::isRole(2)) {
    $comment = $comment->WHERE('verify = 1 OR ' . pcl_usid_cond() . '');
  }

  $comment = $comment->getFirstRow();

  if (!$comment->found) {
    return '';
  }
  $pimg = UserProfile::
    get_img(
      $comment->uid,
      'width="45" height="45" alt="user-profile" class="rounded-circle"'
    );

  $vhref = Auth::isRole(2) ? c_url('/admin/pages/comments/index.php#' . $cid) : '#c' . $cid;
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

              <p class="card-text pt-3 px-3" dir="auto">
                ' . nl2br($comment->getColumn('text')) . '
              </p>
              ' .
    (Auth::isRole(UserRole::Normal) ?
      '<a data-comment="' . $cid . '" class="card-link text-decoration-none d-block pb-1" href onclick="return false;">پاسخ دادن</a>' :
      '')
    . '
            ' . comments($cid) . '
            </div>
          </div>';
}

function comments_fetch($parent = 'NULL', $nop = false)
{
  global $post_id;
  $verb = strtoupper($parent) == 'NULL' ? 'is' : '=';
  $coms = db()->TABLE('comments as c', true)->SELECT('id')
    ->WHERE('c.post=' . $post_id)->WHERE($nop ? '1=1' : "c.parent $verb $parent")
    ->ORDER_BY('c.date desc');
  if (!Auth::isRole(2)) {
    $coms = $coms->WHERE('1=1 AND (verify = 1 OR ' . pcl_usid_cond() . ')');
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
}

function postID()
{
  sscanf($_SERVER['REQUEST_URI'], c_url('/posts/%d', false), $d);
  return ScanRoute('/posts/%d', $d)[0];
}

function normalRoute()
{
  global $post, $post_id, $post_date;
  $slug_ttl = $post->getColumn('title');
  $slug_ttl = slugify($slug_ttl);
  $slug_ttl = truncate($slug_ttl, 50, '');
  $sfu_e = urlencode($slug_ttl);
  $date = jdate("Ymj", $post_date, tr_num: "en");
  $seoFriendly_URL = c_url("/posts/$post_id/$date/$sfu_e", false);
  return $seoFriendly_URL;
}