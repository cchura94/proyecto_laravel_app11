<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles =  Role::get();
        $permisos = Permission::get();
        return view("admin.role.index", ["roles" => $roles, "permisos" => $permisos ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->back();
    }

    public function addPermiso($id, Request $request){
        $role = Role::find($id);
        $role->givePermissionTo($request->id);
        // $permission->assignRole($role);
        return redirect()->back();
    }

    public function quitarPermiso($id, Request $request){
        $role = Role::find($id);
        $role->revokePermissionTo($request->id);
        // $permission->removeRole($role);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
