<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcessingLevelRequest;
use App\Http\Requests\UpdateProcessingLevelRequest;
use App\ProcessingLevel;
use App\Violate;
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
        if(isset($processing)){
             $data = Violate::where('process_level_id', $id)->get();
             if(isset($data) && count($data)> 0){
                 return response()->json(['message'=>'Cấp xử lý đã nằm trong kiểm tra và xử lý vi phạm.', 'status'=>204]);
             }else{
                $processing->delete();
                return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
             }
            
        }else{
             return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        if(isset($listId)){
            $list = explode(',',$listId);
        
            $check = 0;
            foreach($list as $item){
                $data = Violate::where('process_level_id', $item)->get();
                if(isset($data) && count($data)> 0){
                    $check++;
                }
            }
            if($check == 0){
                ProcessingLevel::whereIn('id', $list)->delete();
                return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
            }else{
                return response()->json(['message'=>'Cấp xử lý đã nằm trong kiểm tra và xử lý vi phạm.', 'status'=>204]);
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
