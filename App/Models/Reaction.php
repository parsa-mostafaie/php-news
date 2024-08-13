<?php
namespace App\Models;

defined('ABSPATH') || exit;

use pluslib\Eloquent\BaseModel;

/**
 * @property int $ID
 * @property int $post_id
 * @property int $user_id
 * @property int $emoji_id
 * 
 * @property Emoji $emoji
 * @property Post $post
 * @property User $user
 */
class Reaction extends BaseModel
{
  protected $table = "reactions";
  protected $id_field = "ID";

  protected $fillable = ['post_id', 'user_id', 'emoji_id'];

  const updated_at = null;
  const created_at = null;

  public $_timestamps = false;

  protected $relationships = [
    'post' => [self::BELONGS_TO, Post::class, 'post_id'],
    'user' => [self::BELONGS_TO, User::class, 'user_id'],
    'emoji' => [self::BELONGS_TO, Emoji::class, 'emoji_id']
  ];
}