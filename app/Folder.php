<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
	public function get_folder_name($id)
	{
		return $folder = Folder::find($id);
	}
}