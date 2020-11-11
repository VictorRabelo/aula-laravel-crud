<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CrudController extends Controller
{
    
    public function index()
    {
        try{
            
            $users = User::all();
            
            return response()->json([
                'codeStatus' => 200,
                'message' => 'Ok',
                'detailMessage' => 'Listagem com sucesso',
                'success' => true, 
                'entity' => $users
            ], 200);

        }catch(Exception $e) {

            return response()->json([

                'error' => $e->getMessage(),
                'codeStatus' => 401,
                'message' => 'Nao autorizado. O usuario precisa ser autenticado',
                'detailMessage' => $e->getMessage(),
                'success' => false

            ], 401);
        }
    }
    
    public function show($id)
    {
        try{ 
                
            $user = User::findOrFail($id);
    
            return response()->json([
    
                'codeStatus' => 200,
                'message' => 'Ok',
                'detailMessage' => 'Listagem com sucesso',
                'success' => true, 
                'entity' => $user
            ], 200);
    
        } catch(Exception $e){
    
            return response()->json([    
                'error' => $e->getMessage(),
                'codeStatus' => 403,
                'message' => 'Nao autorizado. O usuario precisa ser autenticado',
                'detailMessage' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }


    public function store(Request $request)
    {
        try {

            $user = User::create([

                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([

                'codeStatus' => 201,
                'message' => 'Ok',
                'detailMessage' => 'Cadastro com sucesso',
                'success' => true, 
                'entity' => $user
            ], 201);
            
        } catch (Exception $e) {

            return response()->json([

                'error' => $e->getMessage(),
                'codeStatus' => 404,
                'message' => 'Nao autorizado. O usuario precisa ser autenticado',
                'detailMessage' => $e->getMessage(),
                'success' => false
            
            ], 404);
        
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $user = User::findOrFail($id);
            
            $user->update($request->all());
            

            return response()->json([

                'codeStatus' => 200,
                'message' => 'Ok',
                'detailMessage' => 'Update com sucesso',
                'success' => true, 
                'entity' => $user

            ],200);

        } catch (ModelNotFoundException $e) {

            return response()->json([

                'error' => $e->getMessage(),
                'codeStatus' => 404,
                'message' => 'Nao autorizado. O usuario precisa ser autenticado',
                'detailMessage' => $e->getMessage(),
                'success' => false
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {

            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([

                'codeStatus' => 200,
                'message' => 'Ok',
                'detailMessage' => 'Movido para lixeira',
                'success' => true,
            ], 200);    


        } catch (ModelNotFoundException $e) {

            return response()->json([

                'error' => $e->getMessage(),
                'codeStatus' => 401,
                'message' => 'Nao autorizado. O usuario precisa ser autenticado',
                'detailMessage' => $e->getMessage(),
                'success' => false

            ], 404);
        }
    }
}
