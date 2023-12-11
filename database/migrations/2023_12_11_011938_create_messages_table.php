<?php
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    return new class extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("messages", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('user_id')->unsigned();
						$table->text('message');
						$table->integer('message_room_id')->nullable()->unsigned();
						//$table->foreign("user_id")->references("id")->on("users");
						//$table->foreign("message_room_id")->references("id")->on("message_rooms");



						// ----------------------------------------------------
						// -- SELECT [messages]--
						// ----------------------------------------------------
						// $query = DB::table("messages")
						// ->leftJoin("users","users.id", "=", "messages.user_id")
						// ->leftJoin("message_rooms","message_rooms.id", "=", "messages.message_room_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("messages");
            }
        };
    