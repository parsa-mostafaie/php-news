<?php include '../inc.php';

$post_id = get_val('post') ?? 'NAN';

if (empty($post_id) || !is_numeric($post_id)) {
  _404_();
}

$post_id = intval($post_id);


include_once '../../posts/lib.php';

?>
<p class="fw-bold fs-6 d-flex justify-content-between">تعداد کامنت : <?= count(comments_fetch(nop: true)) ?> <a
    class="text-decoration-none" style="cursor:pointer" onclick="window.resetReply(); ajaxContentLoad('#comment');">تازه
    سازی</a> </p>
<?= comments(); ?>
<script>
  {
    let card = document.querySelector("#comments");
    let rep = document.querySelector("#rep");

    let reps = document.querySelectorAll('[data-comment]');

    reps.forEach((reply) => {
      let $data = reply.getAttribute('data-comment');

      reply.addEventListener('click', () => {
        rep.value = $data;

        reply.append(card);
      })
    });
  }
</script>