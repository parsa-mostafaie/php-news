<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\App\Models\User as UserBase;
use pluslib\Database\Expression;

/**
 * @property int $ID
 * 
 * @property int $admin
 * 
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $password
 * @property string $mail
 * @property string|null $profile
 * 
 * @property Expression|string $created_at
 * @property Expression|string $last_activity_time
 * 
 * @property Post[] $posts
 * @property Comment[] $comments
 */
class User extends UserBase
{
  const updated_at = null;

  protected $defaultData = [
    'admin' => 0
  ];

  protected $relationships = array(
    'posts' => array(self::HAS_MANY, Post::class, 'author'),
    'comments' => array(self::HAS_MANY, Comment::class, 'user_id'),
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

  function sm_profile()
  {
    return UserProfile::get_img(
      $this->_id(),
      'width="45" height="45" alt="user-profile" class="rounded-circle"'
    );
  }
}
