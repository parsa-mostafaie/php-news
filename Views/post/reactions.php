<?php

use App\Auth;
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

$res = db()->TABLE('emojis', alias: 'e')->SELECT([
  'e.id',
  'e.name',
  'e.eng_name',
  'e.emoji',
  expr('COUNT(r.ID) as `count`')
])->ON(
    cond(expr('e.id'), expr('r.emoji_id'))->and(expr('r.post_id'), expr('?')),
    'reactions r',
    'left'
  )->groupBy('e.id')->getArray([$post_id]);

// $sql = `SELECT 
// 		e.id, e.name, e.eng_name, e.emoji, 
// 		COUNT(r.ID) as \`count\` 
// 	FROM emojis e 
// 	LEFT JOIN reactions r 
// 		ON e.id = r.emoji_id AND r.post_id = 90 GROUP BY e.id;`;

$res = array_combine(array_column($res, 'emoji'), $res);

/*
  [
    👍 => 	[
        'id' 				=> 1,
        'emoji'			=> '👍'
        'name' 			=> 'تایید',
        'eng_name'	=> 'like',
        'count'			=> 0
      ],
      ...
  ]
*/
?>
<?php $c_react = $post->reaction_id(); ?>
<?php foreach ($res as $emoji => $edata): ?>
  <?php
  $react_id = $edata['id'];
  $class_react = $react_id == $c_react ? 'primary' : 'outline-secondary';
  $attrs = 'http-method="PUT"
    href="' . c_url("/posts/public/apis/react.php?post=$post_id&react_id=$react_id") . '" ajax-reload="#reactions"' ?>
  <a class="btn btn-<?= $class_react ?>   <?= !Auth::canLogin() ? 'disabled' : '' ?>"
    title="<?= $emoji . ' ' . $edata['name'] ?>" <?= Auth::canLogin() ? $attrs : ""; ?>>
    <!-- <img src="<?= c_url('/emojis/' . $edata['eng_name'] . '.png') ?>" /> -->
    <?= $emoji ?>
    <?= $edata['count'] ?>
  </a>
<?php endforeach; ?>


<script>
  dangerbtns();
  httplinksInit();
  ajaxContentReLoads();
</script>