<?php
defined('ABSPATH') || exit;

class Auth extends pluslib\Auth
{
  protected static string $UserTable = User::class;

  static function isRole(UserRole|int $role = 1)
  {
    if (!Auth::canLogin())
      return false;
    return User::current()->auth($role);
  }

  static function authAdmin(UserRole|int $role = 1)
  {
    if (!static::isRole($role)) {
      _403_();
    }
    return true;
  }
}