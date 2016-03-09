<?php
namespace App\Services;
/**
 * Custom validator rules.
 * Add this at app\Services
 *
 * @author Alejandro Mostajo <amostajo@gmail.com>
 */
use Symfony\Component\HttpFoundation\File\UploadedFile;
class Validator extends \Illuminate\Validation\Validator
{
	/**
	 * Validates if the value is an audio file.
	 * Returns flag indicating the success of the validation rule.
	 *
	 * @param string $attribute Name of the attribute being validated.
	 * @param mixed  $value     Value of the attribute being validated.
	 * @param array  $parameter Validation parameters.
	 *
	 * @return bool
	 */
	public function validateAudio($attribute, $value, $parameters = [])
	{
		if (!($value instanceof UploadedFile)) return false;
		return in_array(
			preg_replace(
				[
					'/audio\/mpeg/',
					'/audio\/x-wav/',
					'/application\/ogg/',
				], 
				[
					'mp3',
					'wav',
					'ogg',
				], 
				$value->getMimeType()
			),
			$parameters
		);
	}
	/**
	 * Replaces variables in the output message sent by the validator when the audio rule failes.
	 * Returns the replaced string.
	 *
	 * @param string $message 	Output message.
	 * @param string $attribute Name of the attribute being validated.
	 * @param string $rule 			Name of the rule.
	 * @param array  $parameter Validation parameters.
	 *
	 * @return string
	 */
	protected function replaceAudio($message, $attribute, $rule, $parameters)
	{
		return str_replace(':other', implode(' or ', $parameters), $message);
	}
}
namespace App\Providers;
/**
 * Validator provider.
 * Add this at app\Providers
 *
 * @author Alejandro Mostajo <amostajo@gmail.com>
 */
use App\Services\Validator;
use Illuminate\Support\ServiceProvider;
class ValidatorServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register the extended validator as the new validator
		\Validator::resolver(function($translator, $data, $rules, $messages)
		{
			return new Validator($translator, $data, $rules, $messages);
		});
	}
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
// At config\app.php, providers array
        App\Providers\ValidatorServiceProvider::class,
        
// At lang\[whatever]\validation.php, add
    'audio'                => 'The :attribute field is not an audio file of type :other.',
        
// To use
$validator = Validator::make(
  [
  	'audio' 	=> $request->file('audio'),
  	'audiomp3' 	=> $request->file('audiomp3'),
  ],
  [
  	'audio' 	=> 'audio:mp3,wav,ogg',
  	'audiomp3' 	=> 'audio:mp3',
  ]
);