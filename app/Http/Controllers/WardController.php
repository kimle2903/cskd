<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\StoreWardRequest;
use App\Http\Requests\UpdateWardRequest;
use App\Ward;
use Illuminate\Http\Request;

class WardController extends Controller
{
    public function index(){
        $districts = District::all();
        return view('governance.ward', compact('districts'));
    }

    public function store(StoreWardRequest $request){
        $district = District::find($request->district_id);
        if(isset($request->name) && isset($district)){
            $ward = new Ward();
            $ward->name = $request->name;
            $ward->district_id = $request->district_id;
            $ward->save();
            return response()->json(['message'=>"Thêm mới thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>"Thêm mới that bai.", 'status'=>204]);
        }

    }

    public function update(UpdateWardRequest $request, $id){
        $ward = Ward::find($id);
        if(isset($ward) && isset($request->district_id)){
            $ward->name = $request->name;
            $ward->district_id = $request->district_id;
            $ward->save();
             return response()->json(['message'=>"Cập nhật thành công.", 'status'=>200]);
        }else{
             return response()->json(['message'=>"Cập nhật that bại.", 'status'=>204]);
        }
    }

    public function destroy($id){
        $ward = Ward::find($id);
        if(isset($ward) && Ward::destroy($id)){
              return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
        }else{
            return response()->json(['message'=>"Xóa không thành công.", 'status'=>204]);
        }
    }
    public function multiDelete(Request $request){
        
        if(isset($request->listId)){
            $listId = $request->listId;
            $list = explode(',',$listId);
            if(Ward::whereIn('id', $list)->delete()){
                  return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
            }else{
                 return response()->json(['message'=>"Xóa không thành công.", 'status'=>204]);
            }
        }
    }

    public function getDataAjax(Request $request){
        $wards = Ward::orderBy('id', 'desc')->get();
        return datatables()->of($wards)
        ->addColumn('action', function($wards){
            return $wards->id;
        })
        ->addColumn('district_name', function($wards){
            return $wards->district->name;
        })->make(true);
    }
}
