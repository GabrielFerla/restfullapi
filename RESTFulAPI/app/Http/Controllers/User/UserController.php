<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    /**
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return response()->json(['data'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request,$rules);

        
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        return $this->showOne($user);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ];

        $this->validate($request,$rules);

        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        return $this->showOne($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       
        return $this->showOne($user);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'email' => '|email|unique:users,email,'.$user->id,
            'password' => '|min:6|confirmed',
            'admin=> in:'.User::ADMIN_USER.','.User::REGULAR_USER
        ];

        $this->validate($request,$rules);

        if($request->has('name')){
            $user->name = $request->name;
        }

        if($request->has('email') && $user->email != $request->email){
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        if($request->has('admin')){
            if(!$user->isVerified()){
                return $this->errorResponse('only verified users can modify the admin field',409);
            }
            $user->admin = $request->admin;
        }

        if(!$user->isDirty())
        {
            return $this->errorResponse('you need to specify a diferent value to update',422);
        }   
        $user->save();
        return $this->showOne($user);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
        

    }
}
