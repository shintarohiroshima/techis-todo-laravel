<?php
 
namespace App\Repositories;
 
use App\Models\User;
 
class TaskRepository
{
    /**
     * ユーザーのタスク一覧取得
     * データアクセスに関することは、リポジトリだけに記載し、コントローラーでこれを呼び出すようにすれば、
     * コントローラーでのデータ操作を気にする必要がなくなる
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
 