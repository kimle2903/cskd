<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('governance.department');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
       
        if(isset($request->name)){
            $name = $request->name;
            $department = new Department;
            $department->name = $name;
        
            // $department->created_by = Auth::user()->id;
            // $department->updated_by = Auth::user()->id;
            $department->save();
            return response()->json(['message'=>"Thêm mới thành công", 'status'=>200]);
        // return $name;
        }else{
            return response()->json(['message'=>"Thêm mới thất bại", 'status'=>404]);
        }
       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, $id)
    {
        $data = Department::find($id);
        if(isset($data)){
            $data->name = $request->name;
            $data->save();
            return response()->json(['message'=>'Cập nhật thành công', 'status'=>200]);
        }else{
              return response()->json(['message'=>'Cập nhật thất bại', 'status'=>404]);
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(isset($id) && Department::destroy($id)){
            return response()->json(['message'=>"Xóa thành công", 'status'=>200]);
        }else{
            return response()->json(['message'=>"Xóa thất bại", 'status'=>404]);
        }
    }

    public function getDataAjax(){
        $data = Department::orderBy('id', 'desc')->get();
        return Datatables::of($data)
        ->addColumn('action', function($data){
            return $data->id;
        })->make(true);
    }

    public function multiDelete(Request $request){
      
        if(isset($request->listId)){
            $arrId = explode(",",$request->listId );
            Department::whereIn('id',$arrId )->delete();
            return response()->json(['message'=>"Xóa thành công", 'status'=>200]);
        }else{
            return response()->json(['message'=>"Xóa thất bại", 'status'=>404]);
        }
    }
}
