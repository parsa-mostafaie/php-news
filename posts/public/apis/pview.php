<?php
require_once '../../../includes/c-init.php';

use pluslib\ajaxAPI;

pls_validate_http_method('put');
API_header();

const ajax = new ajaxAPI();

$post_id = get_val('post');

// dump(json_decode(request_body()));
if (!secure_form(secure_form_enum::get)) {
  throw new Exception('Not-secure request');
}

db()->TABLE('posts')->UPDATE(cond('id', expr('?')))->SET([
  'view' => expr(escape_col('view') . ' + 1')
])
  ->Run([$post_id]);

secure_form(secure_form_enum::expire);
ajax->send();