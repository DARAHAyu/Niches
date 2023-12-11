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
                Schema::create("caterories", function (Blueprint $table) {

						$table->increments('id');
						$table->string('category',20);



						// ----------------------------------------------------
						// -- SELECT [caterories]--
						// ----------------------------------------------------
						// $query = DB::table("caterories")
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
                Schema::dropIfExists("caterories");
            }
        };
    