<?php  namespace Acme\Helpers; 

use Str;

class FileHelper {

	public static function generateLogoFileName($companyName, $file)
	{
		return time() . '_' . Str::slug($companyName, '_') . '.' . $file->getClientOriginalExtension();
	}

	public static function generateThumbnailFileName($fileName)
	{
		return 'tmb_'.$fileName;
	}

} 