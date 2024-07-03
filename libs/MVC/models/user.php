<?php
defined('ABSPATH') || exit;

use pluslib\MVC\Defaults\User as UserBase;

class User extends UserBase
{
  protected $relationships = array(
    'posts' => array(self::HAS_MANY, 'Post', 'author'),
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

enum UserRole: int
{
  case Admin = 2;
  case Normal = 0;
  case Writer = 1;
}