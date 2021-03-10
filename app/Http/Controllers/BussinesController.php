<?php

namespace App\Http\Controllers;

use App\Busines;
use App\District;
use App\Http\Requests\StoreBusinesRequest;
use App\TypeInvestment;
use App\User;
use App\Violate;
use App\Ward;
use Illuminate\Http\Request;

class BussinesController extends Controller
{
    public function index(){
        return view('business.list');
    }

    public function create(){
        $types = TypeInvestment::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('business.add', compact('types', 'districts','wards'));
    }
    public function store(StoreBusinesRequest $request){
        $user = new User();
        $user->name = $request->name_user;
        $user->house_hold = $request->house_hold;
        $user->position_business = $request->position_business;
        $user->save();
        $busines = new Busines();
        $busines->name = $request->name;
        $busines->type_investment_id = $request->type_investment_id;
        $busines->district_id = $request->district_id;
        $busines->ward_id = $request->ward_id;
        $busines->address = $request->address;
        $busines->code = $request->code;
        $busines->day_register = $request->day_register;
        $busines->number_people = $request->number_people;
        $busines->number_certificate = $request->number_certificate;
        $busines->day_number_certificate = $request->day_number_certificate;
        $busines->status = 1;
        $busines->user_id	 = $user->id;
        
        if( $busines->save()){
            return response()->json(['message'=>"Thêm mới thành công", 'status'=>200]);
        } else{
            return response()->json(['message'=>"Thêm mới thất bại", 'status'=>204]);
        }
       
        
    }

    public function edit($id){
        $types = TypeInvestment::all();
        $districts = District::all();
        $busines = Busines::find($id);
        $wards = Ward::where('district_id', $busines->district_id)->get();
        $user = User::where('id', $busines->user_id)->first();
        return view('business.edit', compact('busines', 'user','types','districts','wards'));
    }

    public function update(Request $request, $id){
        $busines = Busines::find($id);
        $user = User::where('id', $busines->user_id)->first();
        $user->name = $request->name_user;
        $user->house_hold = $request->house_hold;
        $user->position_business = $request->position_business;
        $user->save();
        $busines->name = $request->name;
        $busines->type_investment_id = $request->type_investment_id;
        $busines->district_id = $request->district_id;
        $busines->ward_id = $request->ward_id;
        $busines->address = $request->address;
        $busines->code = $request->code;
        $busines->day_register = $request->day_register;
        $busines->number_people = $request->number_people;
        $busines->number_certificate = $request->number_certificate;
        $busines->day_number_certificate = $request->day_number_certificate;
        $busines->status = 1;
        $busines->save();
         return response()->json(['message'=>"Cập nhật thành công", 'status'=>200]);

    }

    public function destroy($id){
        $busines = Busines::find($id);
        if(isset($busines)){
            $violate = Violate::where("busines_id",$id)->delete();
            $busines->delete();
             return response()->json(['message'=>"Xóa thành công", 'status'=>200]);
        }else{
            return response()->json(['message'=>"Xóa thất bại", 'status'=>204]);
        }
    }

    public function getDataAjax(Request $request){
        $data = Busines::orderBy('id', 'desc')->get();
        return datatables()->of($data)
        ->addColumn('action', function($data){
            return $data->id;
        })->addColumn('district', function($data){
            return $data->district->name;
        })->addColumn('type_investment', function($data){
            return $data->typeInvestment->name;
        })->addColumn('ward', function($data){
            return $data->ward->name;
        })->addColumn('status_action', function($data){
            $status = $data->status;
            if($status == 1){
                return "Đang hoạt động";
            }else{
                return "Không hoạt động";
            }
        })->editColumn('created_at', function($data){
            return date( "d/m/Y", strtotime($data->created_at));
        })->make(true);
    }

    public function multiDelete(Request  $request){
        $listId = $request->listId;
        $list = explode(',',$listId);
        Violate::whereIn('busines_id',$list )->delete();
        Busines::whereIn('id', $list)->delete();
        
        return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        
    }

    public function getDataById(Request $request){
         $html = '';
        if(isset($request->id)){
            $wards = Ward::where('district_id', $request->id)->get();
            $html .= '<option value="">-- Chọn phường/xã/thị trấn--</option>';
            foreach($wards as $ward){

                $html .='<option value="'.$ward->id.'">'.$ward->name.'</option>';
            }
        }
        return $html;
    }
}
