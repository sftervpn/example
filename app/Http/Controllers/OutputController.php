<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\File;

class OutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$folders 	= Folder::latest()->get();
		// $output  	= buildtree($folders);
		$output  	= buildtree_new($folders,'');
		
		echo '<pre>';
		print_r($output);
		// $output  	= buildtree_new($folders,'');
		// return view('output',compact('output'));
		// return view('output')->with($data);
    }
	
	static function allFolderRecords()
	{
		return $folders = Folder::latest()->get();
	}

	public function get_folder_info($id) // the id in the url
	{
		$folder = Folder::find($id);
		dd($folder);
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function store(Request $request)
    {
		$folder = new \App\Folder();
		$folder->name 		= $request->name;
		$folder->parent_id 	= $request->parent_id;
		$folder->save(); 
		return response()->json(['success'=>'Folder saved successfully.']);
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $folder = Folder::find($id);
        return response()->json($folder);
    }
	
    public function folder_name($id)
    {
        $folder = Folder::find($id);
        return $folder->name;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Folder::find($id)->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }
}