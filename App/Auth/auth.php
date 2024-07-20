<?php
namespace App;

defined('ABSPATH') || exit;

use App\Models\User, App\Models\UserRole;

class Auth extends \pluslib\Auth
{
  protected static string $UserTable = User::class;

  static function isRole(UserRole|int $role = 1)
  {
    if (!Auth::canLogin())
      return false;
    return call_user_func([static::$UserTable, 'current'])->auth($role);
  }

  static function authAdmin(UserRole|int $role = 1)
  {
    if (!static::isRole($role)) {
      _403_();
    }
    return true;
  }
}