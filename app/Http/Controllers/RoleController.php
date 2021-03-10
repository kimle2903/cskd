<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        $permissionParents = Permission::where('parent_id', 0)->where('id', '<>', 1)->get();
        return view('governance.role', compact('permissions', 'permissionParents'));
    }

    public function store(StoreRoleRequest $request){
       $role = Role::create(['name' => $request->name]);
       $role->syncPermissions($request->permissions);
       return response()->json(['message'=>"Thêm mới thành công.", 'status'=>200]);
    }

    public function update(UpdateRoleRequest $request, $id){
       
        $role = Role::find($request->id);
        if(isset($role)){
            $role->name = $request->name;

            // Cập nhật lại các quyền bởi role
            $role->syncPermissions($request->permissions);
            $role->save();
            return response()->json(['message'=>"Cập nhật thành công.", 'status'=>200]);
        }else{
             return response()->json(['message'=>"Cập nhật thất bại.", 'status'=>204]);
        }
    }

    public function destroy($id){
        $role = Role::find($id);
        if(isset($role)){
            //$role->syncPermissions() : Xóa các quyền của role by role
            if( $role->syncPermissions() && $role->delete()){
                return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
            }else{
                 return response()->json(['message'=>"Xóa thất bại", 'status'=>204]);
            }
        }
        
    }

    public function getDataAjax(Request $request){
        $data = Role::orderBy('id', 'desc')->get();
        return datatables()->of($data)
        ->editColumn('created_at',function($data){
            return date( "H:i:s d/m/Y", strtotime($data->created_at));
        })->addColumn('action', function($data){
            return $data->id;
        })->make(true);

    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        $list= explode(',', $listId);
        $check = 0;
        foreach($list as $value){
            $data = User::where('role_id', $value)->get();
            if(isset($data) && count($data)> 0){
                $check++;
            }
        }
        if($check == 0){
            foreach($list as $value){
                $role = Role::find($value);
                $role->syncPermissions();
                $role->delete();
            }
            return response()->json(['message'=>'Xóa thành công.', 'status'=>200]);
        }else{
            return response()->json(['message'=>'Xóa thất bại.', 'status'=>204]);
        }
        
    }

    public function getRoleById($id){
        $role = Role::find($id);
        $permissions = $role->permissions()->pluck('id');
        return $permissions;
    }
}
