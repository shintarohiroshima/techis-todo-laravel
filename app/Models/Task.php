<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // 'user_id' → ログイン機能の開発以降に使用 'name' → タスク名のカラム
    protected $fillable = ['name'];

    /**
     * タスクを保持するユーザーの取得
     * タスクはユーザーに所属する、という意味
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
