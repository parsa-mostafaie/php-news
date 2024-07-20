<?php
namespace App\Models;

defined('ABSPATH') || exit;

enum UserRole: int
{
  case Admin = 2;
  case Normal = 0;
  case Writer = 1;
}