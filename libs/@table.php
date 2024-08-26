<?php

defined('ABSPATH') || exit;

define('TABLE_BASE_CSS_CLASS', 'table table-hover align-middle text-nowrap');

define('TABLE_CONTAINER_BASE_CSS_CLASS', 'table-responsive small');

/**
 * Convert array of models into HTML Table
 * 
 * @param array $fields
 * @param array $values
 * @param callable $render
 * @param string $table_class
 * @param string $container_class
 * @return bool|void
 */
function tablify(
  $fields = [],
  $values = [],
  $render = null,
  $empty_msg = null,
  $table_class = TABLE_BASE_CSS_CLASS,
  $container_class = TABLE_CONTAINER_BASE_CSS_CLASS
) {
  $render ??= fn($model, $tdr) => $tdr($model->toArray());

  if (count($values) == 0) {
    echo value($empty_msg);
    return false;
  }

  $td_render = function ($values) {
    $values = wrap($values);
    ?>
    <?php foreach ($values as $value): ?>
      <td><?= value($value) ?></td>
    <?php endforeach; ?>
  <?php
  }

    ?>
  <div class="<?= $container_class ?>">
    <table class="<?= $table_class ?>">
      <thead>
        <tr>
          <?php foreach ($fields as $field): ?>
            <th><?= value($field) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($values as $value): ?>
          <tr>
            <?= $render($value, $td_render) ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php
}


/**
 * Convert array of models into HTML Table [OPTIMIZED]
 * 
 * @param array $fields
 * @param array $values
 * @param string $table_class
 * @param string $container_class
 * @return bool|void
 */
function tablify_optimized(
  $fields = [],
  $values = [],
  $empty_msg = null,
  $table_class = TABLE_BASE_CSS_CLASS,
  $container_class = TABLE_CONTAINER_BASE_CSS_CLASS,
  $params = []
) {
  if (count($values) == 0) {
    echo value($empty_msg);
    return false;
  }

  ?>
  <div class="<?= $container_class ?>">
    <table class="<?= $table_class ?>">
      <thead>
        <tr>
          <?php foreach ($fields as $field): ?>
            <th><?= $field ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($values as $value): ?>
          <tr>
            <?php foreach ($value->toTableRow() as $col): ?>
              <td><?= $value[$col] ?: $value->$col(...$params) ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php
}