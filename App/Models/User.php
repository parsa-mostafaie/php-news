<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\App\Models\User as UserBase;

class User extends UserBase
{

  protected $_updated_at = null;
  protected $relationships = array(
    'posts' => array(self::HAS_MANY, Post::class, 'author'),
    'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
  );

  function role()
  {
    return @UserRole::from($this->admin);
  }

  function changeRole(UserRole|int $role, User|null $upgrader = null)
  {
    $asInt = is_int($role) ? $role : $role->value;
    if (is_null($upgrader) || ($asInt <= $upgrader->admin && $this->admin <= $upgrader->admin)) {
      $this->admin = $asInt;
    }
  }

  function auth(UserRole|int $minRole)
  {
    $asInt = is_int($minRole) ? $minRole : $minRole->value;

    return $this->admin >= $asInt;
  }
}
