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
                Schema::create("purchase_orders", function (Blueprint $table) {
						$table->increments('id');
						$table->string('title',50);
						$table->text('purchase_abstract');
						$table->timestamps();
						$table->unsignedBigInteger('user_id');

                        // 以下外部キー制約、必要に応じてコメントアウト
						$table->foreign("user_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [purchase_orders]--
						// ----------------------------------------------------
						// $query = DB::table("purchase_orders")
						// ->leftJoin("caterories","caterories.id", "=", "purchase_orders.category_id")
						// ->leftJoin("users","users.id", "=", "purchase_orders.user_id")
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
                Schema::dropIfExists("purchase_orders");
            }
        };
    