<?php

function buildtree($src_arr, $parent_id = 0, $tree = array())
{
	foreach($src_arr as $idx => $row)
	{
		if($row->parent_id == $parent_id)
		{
			foreach($row as $k => $v)
				$tree[$row->id][$k] = $v;
			unset($src_arr[$idx]);
			$tree[$row->id]['children'] = buildtree($src_arr, $row->id);
		}
	}
	
	ksort($tree);
	return $tree;
}

function buildtree_new($src_arr, $output, $parent_id = 0, $tree = array())
{
    $output = '<ul class="list-group">';
	foreach($src_arr as $idx => $row)
    {
        if($row->parent_id == $parent_id)
        {
			$output .= '<li class="list-group-item">'.$row->name.'</li>';
			
			$file = \App\File::where(array("folder_id" => $row->id))->get();
			if(isset($file) && !empty($file))
			{
				$output .= '<ul class="list-group">';
				foreach($file as $fk => $fv)
				{
					$output .= '<li class="list-group-item">'.$fv->name.'</li>';
				}
				$output .= '</ul>';
			}
			
            $output .= buildtree_new($src_arr, $output, $row->id);
        }
    }
	return $output .= '</ul>';
}

function get_folder_name($id)
{
	$folder = \App\Folder::find($id);
	if(is_object($folder) && !empty($folder))
	{
		return $folder->name;
	}
	else
	{
		return '';
	}
}