<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Folder;
class File extends Model
{
	public function get_file_name($id)
	{
		return $file = File::find($id);
	}
	
	public function get_folder_name($id)
	{
		return $folder = Folder::find($id);
	}
}