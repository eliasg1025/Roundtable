<?php

namespace App\Traits;

use App;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Funciones para la generacion y verificacion de los codigos de verificacion
 */
trait Verification
{
	public function generateVerificationCode(User $user)
	{
		do {
			$code = Str::random(29);
			$isUnique = $this->isUnique($code);
		} while (!$isUnique);

		$verification_code = new App\VerificationCode();
		$verification_code->code = $code;
		$verification_code->user_id = $user->id;
		$verification_code->save();
	}

	private function isUnique($code)
	{
		$codes = App\VerificationCode::where('code', $code)->get();
		return count($codes) <= 0 ? true : false;
	}
}