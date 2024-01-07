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
                Schema::create("sales_orders", function (Blueprint $table) {
						$table->increments('id');
						$table->string('title',50);
						$table->text('sales_abstract');
						$table->timestamps();
						$table->unsignedBigInteger('user_id');

                        // 以下外部キー制約、必要に応じてコメントアウト
						$table->foreign("user_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [sales_orders]--
						// ----------------------------------------------------
						// $query = DB::table("sales_orders")
						// ->leftJoin("caterories","caterories.id", "=", "sales_orders.category_id")
						// ->leftJoin("users","users.id", "=", "sales_orders.user_id")
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
                Schema::dropIfExists("sales_orders");
            }
        };
    