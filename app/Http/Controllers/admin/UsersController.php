<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($query) {
            return $query->where('name', '!=', 'admin');
        })->get();
        $data = [
            'users' => $users
        ];
        return view('admin.user.index', $data);
    }
    public function destroy($id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);

        if ($user->posts) {
            $user->posts()->delete();
        }
        $user->delete();
        $flasher->addSuccess('User Deleted Succesfully');
        return redirect()->back();
    }

    public function resetPassword($id, FlasherInterface $flasher)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('password');

        $user->save();
        $flasher->addSuccess('User Password has Reset Succesfully');
        return redirect()->back();
    }
}
