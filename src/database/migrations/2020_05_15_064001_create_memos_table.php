<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザーID');
            $table->string('content', 255)->nullable()->comment('内容');
            $table->softDeletes()->comment('レコード削除日時');
            // mysql5.5対応。複数カラムのdefaultにCURRENT_TIMESTAMPが使えない
            // $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('レコード作成日時');
            $table->timestamp('created_at')->default(null)->nullable()->comment('レコード作成日時');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('レコード更新日時');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('NO ACTION')
                  ->onUpdate('NO ACTION');
        });

        DB::statement("ALTER TABLE memos COMMENT 'メモ'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memos');
    }
}
