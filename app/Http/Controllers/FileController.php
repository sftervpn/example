<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File;
use App\Http\Controllers\FolderController;
use App\Folder;
class FileController extends Controller
{
    protected $FolderController;
    public function __construct(FolderController $FolderController)
    {
        $this->FolderController = $FolderController;
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data['FileModels'] = File::latest()->get();
		$data['folder']		= Folder::latest()->get();
		return view('fileAjax')->with($data);
    }
	
	public function get_FileModel_info($id) // the id in the url
	{
		$FileModel = FileModel::find($id);
		dd($FileModel);
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	 
    public function store(Request $request)
    {
		$FileModel = new \App\File();
		$FileModel->name 		= $request->name;
		$FileModel->folder_id 	= $request->folder_id;
		$FileModel->save(); 
		return response()->json(['success'=>'File saved successfully.']);
    }
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $FileModel = File::find($id);
        return response()->json($FileModel);
    }
	
    public function file_name($id)
    {
        $FileModel = File::find($id);
        return $FileModel->name;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	   File::find($id)->delete();
       return response()->json(['success'=>'Item deleted successfully.']);
    }
}