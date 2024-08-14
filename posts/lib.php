<?php
use App\Auth;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\UserProfile;
use pluslib\Database\Condition;

function pcl_usid_cond()
{
  return Auth::canlogin() ? cond('user_id', User::current()->_id() ?? -1) : '0';
}
function comment(Comment $comment)
{
  if (!$comment->loaded())
    return;

  $vhref = $comment->can_verified() ? c_url('/writer/comment.php?v=1&com=' . $comment->_id()) : '#c' . $comment->_id();
  ?>
  <div class="card bg-light-subtle mb-3" id="c<?= $comment->_id() ?>">
    <?php if (!$comment->verified()): ?>
      <div class='position-absolute' style='top: 5px;left:5px'><a href="<?= $vhref ?>" http-method=""><span
            class="badge text-bg-danger">تایید
            نشده</span></a></div>
    <?php endif; ?>
    <div class="card-body">
      <div class="d-flex align-items-center">
        <?= $comment->author->sm_profile() ?>

        <h5 class="card-title me-2 mb-0 position-relative"><?= $comment->author->fullname ?></h5>
      </div>

      <p class="card-text pt-3 px-3" dir="auto">
        <?= nl2br($comment->text) ?>
      </p>
      <?php if (Auth::isRole(ROLE_NORMAL)): ?>
        <a data-comment="<?= $comment->_id() ?>" class="card-link text-decoration-none d-block pb-1" href
          onclick="return false;">پاسخ دادن</a>
      <?php endif; ?>
      <?= comments($comment->_id()) ?>
    </div>
  </div>
  <?php
}

function comments_fetch($parent = 'NULL', $nop = false)
{
  global $post_id;
  $verb = strtoupper($parent) == 'NULL' ? 'is' : '=';
  $coms = Comment::select()
    ->WHERE('post_id', $post_id)->WHERE($nop ? '1=1' : "parent_id $verb $parent")
    ->orderBy('date', 'DESC');

  if (!Auth::isRole(2) && !Post::canEdited($post_id)) {
    $coms = $coms->WHERE('verify = 1 OR ' . pcl_usid_cond() . '');
  }

  return $coms->getArray();
}

function comments($parent = 'NULL')
{
  foreach (comments_fetch($parent) as $comm) {
    comment($comm);
  }
}

function postID()
{
  sscanf($_SERVER['REQUEST_URI'], c_url('/posts/%d', false), $d);
  return ScanRoute('/posts/%d', $d)[0];
}

function normalRoute()
{
  global $post, $post_id;
  $slug_ttl = $post->title;
  $slug_ttl = slugify($slug_ttl);
  $slug_ttl = truncate($slug_ttl, 50, '');
  $sfu_e = urlencode($slug_ttl);
  $date = jdate("Ymj", strtotime($post->created_at), tr_num: "en");
  $seoFriendly_URL = c_url("/posts/$post_id/$date/$sfu_e", false);
  return $seoFriendly_URL;
}

function normalized_route()
{
  return normalRoute();
}

function normalize_route()
{
  ?>
  <?php if ($_SERVER['REQUEST_URI'] != normalized_route()): ?>
    <script>
      window.history.replaceState({}, '', "<?= normalized_route() ?>" + window.location.hash)
    </script>
  <?php endif; ?>
<?php
}