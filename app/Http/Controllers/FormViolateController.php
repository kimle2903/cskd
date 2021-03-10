<?php

namespace App\Http\Controllers;

use App\FormViolate;
use App\Http\Requests\StoreFormViolateRequest;
use App\Http\Requests\UpdateFormViolateRequest;
use App\Violate;
use Illuminate\Http\Request;

class FormViolateController extends Controller
{
    public function index(){
        return view('governance.form-violate');
    }

    public function store(StoreFormViolateRequest $request){
        if(isset($request->name)){
            $formViolate = new FormViolate();
            $formViolate->name = $request->name;
            $formViolate->save();
            return response()->json(['message'=>" Thêm mới thanh cong.", 'status'=>200]);
        }else{
            return response()->json(['message'=>" Thêm mới thất bại.", 'status'=>204]);
        }
    }

    public function update(UpdateFormViolateRequest $request, $id){
        $form = FormViolate::find($id);
        if(isset($form)){
            $form->name = $request->name;
            $form->save();
            return response()->json(['message'=>" Cập nhật thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>" Cập nhât thất bại.", 'status'=>204]);
        }
    }

    public function destroy( $id){
        $form = FormViolate::find($id);
        if(Violate::where('form_violate_id', $id)->first()){
            return response()->json(['message'=>"Hình thức xử lý vi phạm đã nằm trong kiểm tra và xử lý vi phạm.", 'status'=>204]);
        }else{
            FormViolate::destroy($id);
            return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
        }
       
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        $list= explode(',', $listId);
        $check = 0;
        foreach($list as $item){
            $data = Violate::where('form_violate_id', $item)->get();
            if(isset($data)&& count($data)> 0){
               $check++;
            }
        }
        if($check == 0){
            FormViolate::whereIn('id', $list)->delete();
            return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Linh vực đầu tư đã nằm trong kiểm tra và xử lý vi phạm.', 'status'=>204]);
        }   
       

    }

    public  function getDataAjax(Request $request){
        $data = FormViolate::orderBy('id', 'desc')->get();
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
