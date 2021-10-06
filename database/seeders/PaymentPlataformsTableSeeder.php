<?php

namespace Database\Seeders;

use App\Models\PaymentPlatform;
use Illuminate\Database\Seeder;

class PaymentPlataformsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		PaymentPlatform::create([
			'name' => 'Paypal',
			'image' => 'img/payment-platforms/paypal.jpg',
		]);

		PaymentPlatform::create([
			'name' => 'Stripe',
			'image' => 'img/payment-platforms/stripe.jpg',
		]);

		PaymentPlatform::create([
			'name' => 'Placetopay',
			'image' => 'img/payment-platforms/placetopay.jpg',
		]);
	}
}
