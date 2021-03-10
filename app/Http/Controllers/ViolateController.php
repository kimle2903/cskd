<?php

namespace App\Http\Controllers;

use App\Busines;
use App\ErrorViolate;
use App\FormViolate;
use App\Http\Requests\StoreViolateRequest;
use App\Http\Requests\UpdateViolateRequest;
use App\ProcessingLevel;
use App\User;
use App\Violate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ViolateController extends Controller
{
    public function index(){
        return view('violate.list');
    }

    public function create(){
        $business = Busines::all();
        $error_violates = ErrorViolate::all();
        return view('violate.create', compact('business','error_violates'));
    }

    public function store(StoreViolateRequest $request){
        $violate = new Violate();
        $violate->busines_id = $request->busines_name;
        $violate->day_check = $request->day_check;
        $violate->error_violate_id = $request->error_violate;
        $violate->note_error_violate = $request->note_error;
        $violate->created_by = Auth::user()->id;
        $violate->updated_by = Auth::user()->id;
        $violate->save();
        return response()->json(['message'=>'Thêm mới thành công', 'status'=>200]);

    }

    public function edit($id){
        $violate = Violate::find($id);
        $business = Busines::all();
        $error_violates = ErrorViolate::all();
        $process_levels = ProcessingLevel::all();
        $users = User::where("role_id", "<>", 'null')->get();
        $form_violates = FormViolate::all();
        return view("violate.edit", compact('violate','business','error_violates','process_levels','users','form_violates'));
    }

    public function update(UpdateViolateRequest $request, $id){
        $violate = Violate::find($id);
        $violate->busines_id = $request->busines_name;
        $violate->user_decision_id = $request->user_decision_id;
        $violate->user_handler_id = $request->user_handler_id;
        $violate->error_violate_id = $request->error_violate;
        $violate->form_violate_id = $request->form_violate;
        $violate->process_level_id = $request->processing_level_id;
        $violate->note_error_violate = $request->note_error;
        $violate->note_form_violate = $request->note_form_violate;
        $violate->day_check = $request->day_check;
        $violate->status = $request->status;
        $violate->created_by =Auth::user()->id;
        $violate->updated_by = Auth::user()->id;
        $violate->save();
        return response()->json(['message'=>'Cập nhật thành công', 'status'=>200]);

    }

    public function destroy($id){
        $violate = Violate::find($id);
        if(isset($violate) && $violate->delete() ){
            return response()->json(['message'=>'Xóa thành công', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Xóa thất bại', 'status'=>204]);
        }
    }

    public function getDataAjax(){
        $data = Violate::all();
        return datatables()->of($data)
        ->addColumn('action', function($data){
            return $data->id;
        })
        ->addColumn('user_decision_name', function($data){
           return isset($data->user->name)?$data->user->name: '';
        })
        ->addColumn('user_handler_name', function($data){
            return isset($data->user1->name)? $data->user1->name: '';
        })
        ->addColumn('error_violate_name', function($data){
            return isset($data->errorViolate->name)?$data->errorViolate->name: ''; 
        })
        ->addColumn('form_violate_name', function($data){
            return isset($data->formViolate->name)?$data->formViolate->name: ''; 
        })
        ->addColumn('process_level_name', function($data){
            return isset($data->processLevel->name)?$data->processLevel->name: ''; 
        })
      
        ->addColumn('busines_name', function($data){
            return $data->busines->name;
        })
        ->addColumn('busines_type', function($data){
            return $data->busines->typeInvestment->name;
        })
        ->addColumn('representative', function($data){
            return  isset($data->busines->user->name)?$data->busines->user->name:"";
        })
        ->addColumn('address', function($data){
            return $data->busines->address;
        })
        ->editColumn('created_at', function($data){
            return date( "d/m/Y", strtotime($data->created_at));
        })->addColumn("status_action", function($data){
            return $data->status;
        })
        ->make(true);
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        $list = explode(",", $listId);
        if(Violate::whereIn('id', $list)->delete()){
            return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
    }

    public function getDataByBusines(Request $request, $id){
        $violate = Violate::find($id);
        $busines_id = $request->busines_id;
        $violates_busines  = Violate::where('busines_id', $busines_id  )->get();
        // dd( $busines_id, $violates_busines);
        $html = '';
        foreach($violates_busines as $violate){
            $html .= '<tr>';
            $html .= '<td>'.$violate->busines->name.'</td>';
            $html .= '<td>'.$violate->errorViolate->name.'</td>';
            $html .= '<td>'.$violate->day_check.'</td>';
            if(isset($violate->formViolate->name)){
                $html .= '<td>'.$violate->formViolate->name.'</td>';
            }else{
                $html .= '<td></td>';
            }
            if($violate->status == 1){
                $html .= '<td style="color:red">Chưa xử lý</td>';
            }else{
                $html .= '<td>Đã xử lý</td>';
            }
            $html .= '</tr>';
           
        }
         return $html;
    }
}
