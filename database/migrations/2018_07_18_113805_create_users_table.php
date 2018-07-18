<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('email', 191)->unique();
			$table->string('password', 191);
			$table->text('address', 65535)->nullable();
			$table->string('job_title', 191)->nullable();
			$table->string('phone_country_code', 191)->nullable();
			$table->string('phone_number', 191)->nullable();
			$table->text('two_factor_options', 65535)->nullable();
			$table->string('integration_id', 191)->nullable();
			$table->string('gateway', 191)->nullable();
			$table->string('card_brand', 191)->nullable();
			$table->string('card_last_four', 191)->nullable();
			$table->dateTime('trial_ends_at')->nullable();
			$table->string('payment_method_token', 191)->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->integer('created_by')->unsigned()->nullable()->index();
			$table->integer('updated_by')->unsigned()->nullable()->index();
			$table->softDeletes();
			$table->timestamps();
			$table->text('notification_preferences', 65535)->nullable();
			$table->integer('reward_points')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
