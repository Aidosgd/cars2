<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller {


	public function facebook(Request $request)
	{
		session()->put('socialite_referrer', $request->server->get('HTTP_REFERER'));

		return Socialite::with('facebook')->redirect();
	}

	public function vkontakte(Request $request)
	{
		session()->put('socialite_referrer', $request->server->get('HTTP_REFERER'));

		return Socialite::with('vkontakte')->redirect();
	}

	public function success_facebook_auth()
	{

		$social_user = Socialite::driver('facebook')->user();

		$user = User::where('social_id', $social_user->getId())
					->where('social_type', 'facebook')->first();

		if(!$user)
		{
			$user = User::create([
				'name' => $social_user->getName(),
				'social_id' => $social_user->getId(),
				'social_type' => 'facebook',
				'email' => 'facebook_'.$social_user->email,
				'password' => bcrypt('facebook_'.$social_user->getId()),
				'social_avatar' => $social_user->getAvatar(),
			]);
		}


		$user->social_avatar = $social_user->getAvatar();
		$user->save();

		Auth::login($user, true);

		if(session()->has('socialite_referrer'))
		{
			$redirectTo = session()->get('socialite_referrer');
			session()->forget('socialite_referrer');
		}
		else{
			$redirectTo = '/';
		}

		return redirect($redirectTo);
	}

	public function success_vkontakte_auth()
	{
		$social_user = Socialite::driver('vkontakte')->user();

		$user = User::where('social_id', $social_user->getId())
			->where('social_type', 'vkontakte')->first();

		if(!$user)
		{
			$user = User::create([
				'name' => $social_user->getName(),
				'social_id' => $social_user->getId(),
				'social_type' => 'vkontakte',
				'email' => 'vkontakte_'.$social_user->email,
				'password' => bcrypt('vkontakte_'.$social_user->getId()),
				'social_avatar' => $social_user->getAvatar(),
			]);
		}


		$user->social_avatar = $social_user->getAvatar();
		$user->save();

		Auth::login($user, true);

		if(session()->has('socialite_referrer'))
		{
			$redirectTo = session()->get('socialite_referrer');
			session()->forget('socialite_referrer');
		}
		else{
			$redirectTo = '/';
		}

		return redirect($redirectTo);
	}

}
