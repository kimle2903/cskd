<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessingLevelRequest;
use App\Http\Requests\UpdateProcessingLevelRequest;
use App\ProcessingLevel;
use Illuminate\Http\Request;

class ProcessingLevelController extends Controller
{
    public function index(){
        return view('governance.processing-level');
    }

    public function store(StoreProcessingLevelRequest $request){
        if(isset($request->name)){
            $processing = new ProcessingLevel();
            $processing->name = $request->name;
            $processing->save();
            return response()->json(['message'=>'Thêm mới thành công.', 'status'=>200]);
        }else{
             return response()->json(['message'=>'Thêm mới thất bại', 'status'=>204]);
        }
    }

    public function update(UpdateProcessingLevelRequest $request, $id){
        $processing = ProcessingLevel::find($id);
        if(isset($processing)){
            $processing->name = $request->name;
            $processing->save();
            return response()->json(['message'=>'Cập nhật thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Cập nhật thất bại', 'status'=>204]);
        }
    }

    public function destroy( $id){
        $processing = ProcessingLevel::find($id);
        if(isset($processing) && ProcessingLevel::destroy($id)){
             return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
             return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        if(isset($listId)){
            $list = explode(',',$listId);
            if(ProcessingLevel::whereIn('id', $list)->delete()){
                 return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
            }else{
                 return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
            }

        }else{
             return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
    }

    public  function getDataAjax(Request $request){
        $data = ProcessingLevel::orderBy('id', 'desc')->get();
        // dd($data);
        return datatables()->of($data)
        ->addColumn('action', function($data){
            return $data->id;
        })->make(true);
    }
}
