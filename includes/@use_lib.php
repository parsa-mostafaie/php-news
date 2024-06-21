<?php include_once "c-init.php";

function useBootstrap()
{
  ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <?php
}

function useBootstrapScript()
{
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <?php
}

function useTinyMCE()
{
  ?>
  <script src="/tinymce/tinymce.min.js" referrerpolicy="origin"></script><?php
}

function useResubmit()
{
  ?>
  <script src="/libs/pluslib/frontend/resubmit.js"></script>
  <?php
}

function useFormlibAjax()
{
  ?>
  <script src="/libs/pluslib/frontend/formlib.js" type="module"></script>
  <?php
}

function useHTTPLink()
{
  static $imported = false;
  if ($imported)
    return;
  ?>
  <script src="/libs/pluslib/frontend/httplink.js" defer type="module"></script>
  <?php
  $imported = true;
}


function useAjaxInit1()
{
  ?>
  <script src="<?= www_url(c_url('/assets/js/ajaxInit1.js', false)) ?>"></script>
  <?php
}

function useAjaxInit2()
{
  ?>
  <script src="<?= www_url(c_url('/assets/js/ajaxInit2.js', false)) ?>"></script>
  <?php
}

function useFormall()
{
  ?>
  <script src='<?= c_url('/assets/js/formall.js') ?>'></script>
  <?php
}