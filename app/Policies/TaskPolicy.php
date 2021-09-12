<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 指定されたユーザーのタスクのとき削除可能
     * // ユーザー自身のタスクの時だけ削除可能であるように、デストロイメソッドを追加し、チェックする処理を記述
     * 
     * TaskPolicyはTaskModelと紐つけることで有効にすることができる
     *
     * @param User $user
     * @param Task $task
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
}

