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
                Schema::create("user_details", function (Blueprint $table) {

						$table->increments('id');
						$table->string('occupation',255);
						$table->integer('age');
						$table->string('business_area',255);
						$table->string('nickname',255);
						$table->timestamps();
						$table->integer('user_id')->unsigned();
						

                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        //$table->foreign("user_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [user_details]--
						// ----------------------------------------------------
						// $query = DB::table("user_details")
						// ->leftJoin("users","users.id", "=", "user_details.user_id")
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
                Schema::dropIfExists("user_details");
            }
        };
    