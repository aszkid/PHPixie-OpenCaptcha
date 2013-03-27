<?php
/**
 *
 * OpenCaptcha System for PHPixie (v0.5)
 * ----------------------------
 * Developed by ThePyramidSong, also known as aszkid
 * ----------------------------
 * All credits go to VIRANTE INC (http://www.virante.org/),
 * whose team made OpenCaptcha (http://www.opencaptcha.com/)
 * ----------------------------
 * Features:
 * - Captcha generation
 * - Captcha validation
 *
*/

class Captcha
{
	public $seed;
	public $height;
	public $width;
	public $image;

	function __construct($s, $w, $h)
	{
		$this->seed = $s;
		$this->height = $h;
		$this->width = $w;
		$this->image = "{$s}-{$h}-{$w}.jpgx";
	}
}

class OpenCaptcha
{
	public static function ValidateCaptcha($input, $image)
	{
		$page = file_get_contents("http://www.opencaptcha.com/validate.php?ans=$input&img=$image");
		if($page=='pass')
			return true;
		else
			return false;
	}
	public static function MakeCaptcha($width, $height) 
	{
		return new Captcha(self::MakeSeed(), $width, $height);
	}
	private static function MakeSeed()
	{
		$seed = microtime() + rand(0, 19482673);
		$seed = str_replace('.','',$seed);
		$seed .= date("dYm");
		return $seed;
	}
}

?>