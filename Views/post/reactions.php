<?php

use App\Auth;
use App\Models\Emoji;
use App\Models\Post;

include '../inc.php';

$post_id = get_val('post') ?? 'NAN';

if (empty($post_id) || !is_numeric($post_id)) {
  _404_();
}

$post_id = intval($post_id);
$post = Post::find($post_id);

if (!$post) {
  _404_();
}

$res = Emoji::select('emojis.*')
  ->selectRaw('COUNT(r.id) as count')
  ->on(
    cond(expr('emojis.id'), expr('r.emoji_id'))->and(expr('r.post_id'), expr('?')),
    'reactions r',
    'left'
  )->groupBy('emojis.id')
  ->orderBy('count','desc')
  ->getArray([$post_id]);

?>
<?php $c_react = $post->ereaction_id() ?>
<?php
/**
 * @var Emoji $emoji
 */
?>
<?php foreach ($res as $emoji): ?>
  <?php
  $react_id = $emoji->_id();
  $class_react = $react_id == $c_react ? 'primary' : 'outline-secondary';
  $attrs = 'http-method="PUT"
    href="' . url(c_url("/posts/public/apis/react.php?post=$post_id&react_id=$react_id")) . "\" ajax-reload='#reactions$post_id'" ?>
  <a class="btn btn-<?= $class_react ?>   <?= !Auth::canLogin() ? 'disabled' : '' ?>"
    title="<?= $emoji->unicode . ' ' . $emoji->name ?>" <?= Auth::canLogin() ? $attrs : ""; ?>>
    <!-- <img src="<?= c_url('/emojis/' . $edata['eng_name'] . '.png') ?>" /> -->
    <?= $emoji->unicode ?>
    <?= $emoji['count'] ?>
  </a>
<?php endforeach; ?>


<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>