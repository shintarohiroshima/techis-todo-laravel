<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリ
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * コンストラクタ（自動的に呼び出される初期化処理用のメソッド）
     * 認証機能をタスクコントローラーで有効にするためのコード
     * 
     * @return void
     */
    // コンストラクタでタスクリポジトリを受け取れるように引数を追加
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        // この引数をプロパティに代入するコード
        $this->tasks = $tasks;
    }

    /**
     * タスク一覧
     *
     * @param Request $request //1 これはどこから来ている？？→ GETやPOSTで送信されたものが入ってくるイメージ
     * @return Response
     */
    // 2 このindex関数は何するもの？→ 自身で決めるもの！忘れてる！
    public function index(Request $request)
    {
        // データベースからタスク一覧の取得を行う（詳細メモあり）
        // $tasks = Task::orderBy('created_at', 'asc')->get();

        // 認証済みのユーザーを取得（$request->user()）
        // そのユーザーが保持するタスク一覧を取得（->tasks()->get()）
        // $tasks = $request->user()->tasks()->get();
        
        // 引数である「tasks.index」は、tasksフォルダ（resourcesでゆくゆく作成）のindexというviewを使用する、という意味 
        return view('tasks.index', [
            // $tasksに全てまとめて戻している
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

        /**
     * タスク登録
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // validate：パラメーターが有効かどうかのバリゲーション（入力チェック）をしている
        $this->validate($request, [
            // 必須｜最長２５５文字、というチェックをしている
            'name' => 'required|max:255',
        ]);
 
        // タスク作成
        // Task::create([
            // 'user_id' => 0,
            // 'name' => $request->name
        // ]);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

        /**
     * タスク削除
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        // これで、ユーザー自身のタスクしか削除できないようになる
        // authorize：承認、という意味
        $this->authorize('destroy', $task);

        $task->delete();
        return redirect('/tasks');
    }
}
