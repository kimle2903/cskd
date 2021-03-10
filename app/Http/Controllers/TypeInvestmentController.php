<?php

namespace App\Http\Controllers;

use App\Busines;
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
        
        if ( Busines::where('type_investment_id', $id)->first() ) {
            return  response()->json(['status'=>"204","message"=>"Loại hình đầu tư đã tồn tại trong cơ sở kinh doanh."]);
        } else{
            $id = TypeInvestment::find($id);
            if(isset($id) && $id->delete()){
                return response()->json(['status'=>"200","message"=>"Xóa thành công"]);
            }else{
                return response()->json(['status'=>"204","message"=>"Xóa không thành công!"]);
            }
        }
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        $list= explode(',', $listId);
        $check = 0;
        foreach($list as $item){
            $data = Busines::where('type_investment_id', $item)->get();
            if(isset($data) && count($data)> 0){
                $check++;
            }
        }
        if($check == 0){
            TypeInvestment::whereIn('id', $list)->delete();
            return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Loại hình đầu tư đã tồn tại trong cơ sở kinh doanh.', 'status'=>204]);
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
