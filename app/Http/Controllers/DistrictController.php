<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Ward;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(){
        return view('governance.district');
    }

    public function store(StoreDistrictRequest $request){
        if(isset($request->name)){
            $district = new District();
            $district->name = $request->name;
            $district->save();
            return response()->json(['message'=>"Thêm mới thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>"Thêm mới thất bại .", 'status'=>404]);
        }
        
    }

    public function update(UpdateDistrictRequest $request, $id){
        $district  = District::find($id);
       if(isset($district)){
            $district->name = $request->name;
            $district->save();
            return response()->json(['message'=>"Cập nhật thành công.", 'status'=>200]);
       }else{
           return response()->json(['message'=>"Cập nhật không thành công.", 'status'=>404]);
       }

    }

    public function destroy($id){
        if(Ward::where('district_id', $id)->first()){
             return response()->json(['message'=>"Quận, huyện đã tồn tại với xã, phường, thị trấn.", 'status'=>204]);
        }else{
            if(isset($id) && District::destroy($id)){

            return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
            }else{
                return response()->json(['message'=>"Xóa không thành công.", 'status'=>204]);
            }
        }
        

    }
    public function multiDelete(Request $request){
        if(isset($request->listId)){
            $arrId = explode(",",$request->listId );
            $dem = 0;
            foreach( $arrId as $id){
                if(count(Ward::where('district_id', $id)->get()) > 0){
                    $dem++;
                }
            }
           
            if($dem == 0){
                District::whereIn('id',$arrId)->delete();
                return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
            }else{
                return response()->json(['message'=>"Tồn tại Quận, huyện đã tồn tại với xã, phường, thị trấn.", 'status'=>204]);
            }
           
        }else{
              return response()->json(['message'=>"Xóa thất bại.", 'status'=>404]);
        }
        
    }

    public function getDataAjax(Request $request){
        $districts = District::all();
        return datatables()->of($districts)
        ->addColumn('action', function($districts){
            return $districts->id;
        })->make(true);
    }
}
