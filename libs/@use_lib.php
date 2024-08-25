<?php

defined('ABSPATH') || exit;

function __Resubmit()
{
  ?>
  <script src="/<?= RELPATH ?>frontend/resubmit.js"></script>
  <?php
}

function __FormlibAjax()
{
  ?>
  <script src="/<?= RELPATH ?>frontend/formlib.js" type="module"></script>
  <?php
}

function __HTTPLink()
{
  static $imported = false;
  if ($imported)
    return;
  ?>
  <script type="module" src="/<?= RELPATH ?>frontend/httplink.js" defer></script>
  <?php
  $imported = true;
}

function __AjaxInit1()
{
  ?>
  <script src="<?= asset('js/ajaxInit1.js') ?>" type="module"></script>
  <?php
}

function __SweetAlert()
{
  static $imported = false;
  if ($imported) {
    return;
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  $imported = true;
}

function __DangerButtons()
{
  __SweetAlert();
  static $imported = false;
  if ($imported) {
    return;
  }
  ?>
  <script src="<?= asset('js/dangerbtn.js') ?>"></script>
  <?php
  $imported = true;
}

function __AjaxContent()
{
  static $imported = false;
  if ($imported) {
    return;
  }
  ?>
  <script src="/<?= RELPATH ?>frontend/ajax-content.js" type="module" defer></script>
  <script>window.httplinksConfig = { refreshOn: 2 }</script>
  <?php
  $imported = true;
}

function __BS_Script()
{
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <?php
}

function useResubmit()
{
  add_footer('__Resubmit');
}

function useFormlibAjax()
{
  add_footer('__FormlibAjax');
}

function useAjaxInit1()
{
  add_footer('__AjaxInit1');
}

function useSweetAlert()
{
  add_footer('__SweetAlert');
}

function useDangerButtons()
{
  add_footer('__DangerButtons');
}
function useAjaxContent()
{
  add_footer('__AjaxContent');
}

function useHTTPLink()
{
  add_footer('__HTTPLink');
}

function useBootstrapScript()
{
  add_footer('__BS_SCRIPT');
}

function useBootstrap()
{
  add_head('__Bootstrap');
}

function __Bootstrap()
{
  ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <?php
}

function useTinyMCE()
{
  add_head('__TinyMCE');
}

function __TinyMCE()
{
  ?>
  <script src="/tinymce/tinymce.min.js" referrerpolicy="origin"></script><?php
}


function useAjaxCommentsInit()
{
  add_footer('__CommentsInit');
}

function __CommentsInit()
{
  __FormlibAjax();
  ?>
  <script src="<?= asset('js/CommentAJAX.js') ?>" type="module"></script>
  <?php
}

function useAjaxInit2()
{
  add_footer('__AjaxInit2');
}
function __AjaxInit2()
{
  __FormlibAjax();
  ?>
  <script src="<?= asset('js/ajaxInit2.js') ?>" type="module"></script>
  <?php
}

function useFormall()
{
  add_footer('__Formall');
}
function __Formall()
{
  ?>
  <script src='<?= asset('js/formall.js') ?>'></script>
  <?php
}