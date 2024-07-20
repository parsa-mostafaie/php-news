<?php
include_once ('init.php');
use App\Auth;

Auth::authAdmin();

if (Auth::isRole(2)) {
  redirect(c_url('/admin/pages/posts/'));

} elseif (Auth::isRole(1)) {
  redirect(c_url('/dashboard/pages/posts/'));
}