<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeInvestmentRequest;
use App\Http\Requests\UpdateTypeInvestmentsRequest;
use App\TypeInvestment;
use Illuminate\Http\Request;

class TypeInvestmentController extends Controller
{
    public function index(){
        return view("governance.type-investment");
    }

    public function store(StoreTypeInvestmentRequest $request){
        if(isset($request->name)){
            $error = new TypeInvestment();
            $error->name = $request->name;
            $error->save();
            return response()->json(['message'=>" Thêm mới thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>" Thêm mới thất bại.", 'status'=>204]);
        }
    }

    public function update(UpdateTypeInvestmentsRequest $request, $id){
        $data = TypeInvestment::find($id);
        if(isset($data)){
            $data->name = $request->name;
            $data->save();
            return response()->json(['message'=>" Cập nhật thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>" Cập nhât thất bại.", 'status'=>204]);
        }
    }

    public function destroy( $id){
         $form = TypeInvestment::find($id);
        if(isset($form) && TypeInvestment::destroy($id)){
             return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
        }else{
             return response()->json(['message'=>"Xóa thất bại.", 'status'=>200]);
        }
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        $list= explode(',', $listId);
         if(TypeInvestment::whereIn('id', $list)->delete()){
            return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
    }

    public  function getDataAjax(Request $request){
        $data = TypeInvestment::orderBy('id', 'desc')->get();
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
