<?php

namespace App\Http\Controllers;

use App\ErrorViolate;
use App\Http\Requests\StoreErrorViolateRequest;
use App\Http\Requests\UpdateErrorViolateRequest;
use Illuminate\Http\Request;

class ErrorViolateController extends Controller
{
    public function index(){
        return view('governance.error-violate');
    }

    public function store(StoreErrorViolateRequest $request){
        if(isset($request->name)){
            $error = new ErrorViolate();
            $error->name = $request->name;
            $error->save();
            return response()->json(['message'=>" Thêm mới thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>" Thêm mới thất bại.", 'status'=>204]);
        }
    }

    public function update(UpdateErrorViolateRequest $request, $id){
         $data = ErrorViolate::find($id);
        if(isset($data)){
            $data->name = $request->name;
            $data->save();
            return response()->json(['message'=>" Cập nhật thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>" Cập nhât thất bại.", 'status'=>204]);
        }
    }

    public function destroy( $id){
        $form = ErrorViolate::find($id);
        if(isset($form) && ErrorViolate::destroy($id)){
             return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
        }else{
             return response()->json(['message'=>"Xóa thất bại.", 'status'=>200]);
        }
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        $list= explode(',', $listId);
         if(ErrorViolate::whereIn('id', $list)->delete()){
            return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
    }

    public  function getDataAjax(Request $request){
        $data = ErrorViolate::orderBy('id', 'desc')->get();
        return datatables()->of($data)
        ->editColumn('created_at',function($data){
            return date( "H:i:s d/m/Y", strtotime($data->created_at));
        })->editColumn('updated_at', function($data){
             return date( "H:i:s d/m/Y", strtotime($data->updated_at));
        })->addColumn('action', function($data){
            return $data->id;
        })->make(true);
    }
}
