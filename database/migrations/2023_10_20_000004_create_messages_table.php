<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('message');
            $table->datetime('sent_at');
            $table->string('status')->default('Pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}