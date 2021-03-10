<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PostChangePasswordRequest;
use App\Http\Requests\PostChangeProfileRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{


    public function changeProfile(){
        $user = Auth::user();
         $departments = Department::all();
        return view('user.change-profile', compact('user', 'departments'));
    }

    public function uploadImage(Request $request){
        $avatar_tamp = substr($request->avatar_tamp, 1);
        if(File::exists($avatar_tamp)){
            unlink($avatar_tamp);
        }
        $file = $_FILES['avatar'];
        $name = time().$file['name'][0];
        $sourcePath = $file['tmp_name'][0];
        $toPath = 'uploads/avatar/'.$name;
        $data = ['oldName'=> $request->oldName, 'newName' =>  $toPath];
        move_uploaded_file( $sourcePath, $toPath);
        return response()->json(['status'=>200, 'data'=>$data]);

    }


    public function changeProfileHanding(PostChangeProfileRequest $request){
            
            $user = Auth::user();
            $user->name = $request->name;
            $user->department_id = $request->department_id;
            if(isset($request->avatar)){
                $user->avatar =  $request->avatar;
            }
            $user->save();
            return response()->json(['message'=>"Cập nhật thành công", 'status'=>200]);
            
    }

    public function changePassword(){
         $user = Auth::user();
       
        return view('user.change-pass', compact('user', 'roles'));
    }

     public function changePasswordHanding(PostChangePasswordRequest $request){
        $user = Auth::user();
        if(!Hash::check($request->old_password, $user->password)){
            return response()->json(['message'=>"Mật khẩu chưa đúng", 'status'=>204]);
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['message'=>"Cập nhật thành công", 'status'=>200]);

        }
    }

    public function login(){
        if(Auth::check()){
            return  redirect("/");
        }else{
            return view('login');
        }
       
    }
    public function doLogin(LoginRequest $request){
        $email = trim($request->email);
        $password = trim($request->password);
        $remember = $request->remember;

        if (Auth::attempt(['email' => $email, 'password' => $password, ], $remember)) {
            return response()->json(['message'=>"Đăng nhập thành công.", 'status'=>200]);
        } else{
            return response()->json(['message'=>"Tên đăng nhập hoặc mật khẩu chưa đúng.", 'status'=>204]);
        }  
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }
    public function index(){
        $roles = Role::all();
        $departments = Department::all();
        
        return view('governance.users',compact('roles', 'departments'));
    }

    
    public function store(StoreUserRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->department_id = $request->department_id;
        $user->password = bcrypt("123456");
        $user->status = 1;
        $user->save();
        $role_name = $user->role->name;
        $user->assignRole( $role_name);
        
        return response()->json(['message'=>"Thêm mới thành công.", 'status'=>200]);
    }

    public function update(UpdateUserRequest $request, $id){
       $user = User::find($id);
       if(isset($user)){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->department_id = $request->department_id;
            $user->save();
            return response()->json(['message'=>"Cập nhật thành công.", 'status'=>200]);
       }else{
            return response()->json(['message'=>"Cập nhật thất bại.", 'status'=>204]);
       }
    }

    public function destroy( $id){
       $user = User::find($id);
       if(isset($user) && $user->delete()){
            return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);
       }else{
            return response()->json(['message'=>"Xóa thất bại.", 'status'=>204]);
       }
    }

    public function multiDelete(Request $request){
        $listId = $request->listId;
        if(isset($listId )){
            $list = explode(",",$listId);
            User::whereIn('id', $list)->delete();
            return response()->json(['message'=>"Xóa thành công.", 'status'=>200]);

        }else{
            return response()->json(['message'=>"Xóa thất bại.", 'status'=>204]);
        }

    }

    public  function getDataAjax(Request $request){
       
        $data = User::where('role_id', '<>', null)->orderBy('id', 'desc')->get();
        return  datatables()->of($data)
        ->addColumn('action', function($data){
            return  $data->id;
        })
        ->addColumn('role_name', function($data){
            return  $data->role->name;
        })
        ->addColumn('department_name', function($data){
            return  $data->department->name;
        })
        ->make(true);
        

    }
}
