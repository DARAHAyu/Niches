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
                Schema::create("message_room_user", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('user_id')->unsigned();
						$table->integer('message_room_id')->unsigned();
						//$table->foreign("user_id")->references("id")->on("users");
						//$table->foreign("message_room_id")->references("id")->on("message_rooms");



						// ----------------------------------------------------
						// -- SELECT [message_room_user]--
						// ----------------------------------------------------
						// $query = DB::table("message_room_user")
						// ->leftJoin("users","users.id", "=", "message_room_user.user_id")
						// ->leftJoin("message_rooms","message_rooms.id", "=", "message_room_user.message_room_id")
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
                Schema::dropIfExists("message_room_user");
            }
        };
    