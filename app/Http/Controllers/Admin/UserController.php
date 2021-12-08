<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ministry;

class UserController extends Controller
{
    //
    //
    public function index()
    {
        $users = User::orderby('role_id', 'asc')->paginate(15);
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        $ministries = Ministry::all();
        return view('admin.user.create', compact('ministries'));
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
            'password' => 'min:6|required|same:password_confirmation',
            'password_confirmation' => 'required',
        ], [
            'email.required' => 'Введите Email!',
            'email.email' => 'Неправильный фоамат Email',
            'email.unique' => 'Email уже существует!',
            'password.min' => 'Пароль должен содержать не менее 6 символов!',
            'password.same' => 'Пароль и подтверждение пароля не совпадают!',
            'password.same' => 'Пароль и подтверждение пароля не совпадают!',
            'password_confirmation.required' => 'Введите подтверждение пароля!',
        ]);

        if ($request->file('avatar') != "") {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=10,min_height=10|required|',
            ], [
                'avatar.required' => 'Загрузить картинку',
                'avatar.dimensions' => 'Картина доллжна быть 40x40 px',
                'avatar.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'avatar.max' => 'Размер картины должна быть менее 2 МБ',
                'avatar.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['avatar'] = $this->uploadFile('uploads/users', $request->file('avatar'));
        }
        User::create($input);
        return redirect('/admin/user')->with(['success_message' => 'Успешно добавлено!']);
    }
    public function edit(Request $request, $id)
    {
        $user = User::findorfail($id);
        $ministries = Ministry::all();
        return view('admin.user.edit', compact('user', 'ministries'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'password' => 'min:6|required|same:password_confirmation',
            'password_confirmation' => 'required',
        ], [
            'email.required' => 'Введите Email!',
            'email.email' => 'Неправильный фоамат Email',
            'email.unique' => 'Email уже существует!',
            'password.min' => 'Пароль должен содержать не менее 6 символов!',
            'password.same' => 'Пароль и подтверждение пароля не совпадают!',
            'password.same' => 'Пароль и подтверждение пароля не совпадают!',
            'password_confirmation.required' => 'Введите подтверждение пароля!',
        ]);

        if ($request->file('avatar') != "") {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=10,min_height=10|required|',
            ], [
                'avatar.required' => 'Загрузить картинку',
                'avatar.dimensions' => 'Картина доллжна быть 40x40 px',
                'avatar.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'avatar.max' => 'Размер картины должна быть менее 2 МБ',
                'avatar.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['avatar'] = $this->uploadFile('uploads/users', $request->file('avatar'), null, $user->avatar != "" ? $user->avatar : null);
        }
        $user->update($input);
        if (Auth::user()->id!= $id) {
            return redirect('/admin/user/')->with(['success_message' => 'Успешно сохранено!']);
        } else {
            return redirect()->back()->with(['success_message' => 'Успешно сохранено!']);
        }
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::findorfail($id);
        $ministries = Ministry::all();
        return view('admin.user.edit', compact('user', 'ministries'));
    }
    public function delete($id)
    {
        if (Auth::user()->role_id == 1 && Auth::user()->id == $id) {
            return redirect()->back();
        }
        $user = User::findOrFail($id);
        if ($user->avatar != "") {
            $this->unlinkFile('public/uploads/users/' . $user->avatar);
        }
        $user->delete();
        return redirect()->back()->with(['success_message' => 'Успешно удалено!']);
    }
}
