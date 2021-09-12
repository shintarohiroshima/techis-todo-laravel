<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     * 新しいテーブル、カラム、インデックスを追加するもの
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            // プライマリーキーとなるtask-id(increments：オートインクリメントのカラムを追加するメソッド)
            $table->increments('id'); 
            // ユーザーのテーブルと紐づくuser-id
            // integer：INT型で出力  unsigned：「符号なし」という条件をつけている（マイナスとかの数字がないように！）
            //  index：検索条件に入れ、処理スピードUPさせている
            $table->integer('user_id')->unsigned()->index();  
            // タスクの名前
            $table->string('name');  
            // 作成・更新日時（timestamps：created_at と update_at カラム）
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     * upメソッドの操作を元に戻すためのもの
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
