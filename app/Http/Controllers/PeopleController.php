<?php

namespace App\Http\Controllers;

use App\Models\People as PeopleModel;
use App\Http\Resources\People as PeopleResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PeopleController extends Controller
{
    // List peoples
    public function index()
    {
        $peoples = new PeopleModel;
        return PeopleResource::collection($peoples::all());
    }

    // List single people
    public function show($id)
    {
        $people = PeopleModel::findOrFail($id);
        return new PeopleResource($people);
    }

    // Create new people
    public function store(Request $request)
    {   
        $message = [
            'required' => 'O campo :attribute é obrigatório!',
            'name.min' => 'É necessário no mínimo 5 caracteres no nome!',
            'email.email' => 'Digite um email válido!',
            'fone.max' => 'O máximo de caracteres no telefone é 11!',
            'fone.numeric' => 'Somente valores numéricos!',
            'image.image' => 'O arquivo precisa ser do tipo imagem!'
        ];
    
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required',
            'fone' => 'required|numeric|max:99999999999',
            'image' => 'required|image'
        ], $message);

        if ($validator->fails()) {
            return response()->json($validator->errors(),401);
        } else {
            
            if ($request->hasFile('image') && $request->file('image')->isValid()){

                $destination_path = 'public/images';
                $image = $request->file('image');
                $extension = $image->extension(); 
                $image_name = $image->getClientOriginalName();

                if (Storage::disk('public')->exists('images/'.$image_name)){

                    $result = [
                        'status'=> 'error',
                        'mensagem' => 'Esta imagem ja foi cadastrada!'
                    ];
                    return response()->json($result, 401);

                }else{

                    $request->file('image')->storeAs($destination_path,$image_name);
                    $people = new PeopleModel;
                    $people->name = $request->input('name');
                    $people->email = $request->input('email');
                    $people->password = $request->input('password');
                    $people->fone = $request->input('fone');
                    $people->image = 'images/'.$image_name;
                    if ($people->save()) {

                        new PeopleResource($people);
                        $result = [
                            'status'=> 'success',
                            'mensagem' => 'Pessoa cadastrada'
                        ];
                        return response()->json($result, 200);

                    } else {

                        Storage::disk('public')->delete($people->image);
                        $result = [
                            'status'=> 'error',
                            'mensagem' => 'Erro ao salvar cadastro!'
                        ];
                        return response()->json($result, 401);

                    }

                }
            }
        }
    }

    // Update people
    public function update(Request $request, $id)
    {
        $people = PeopleModel::findOrFail($id);
        
        $message = [
            'required' => 'O campo :attribute é obrigatório!',
            'name.min' => 'É necessário no mínimo 5 caracteres no nome!',
            'email.email' => 'Digite um email válido!',
            'fone.max' => 'O máximo de caracteres no telefone é 11!',
            'fone.numeric' => 'Somente valores numéricos!',
            'image.image' => 'O arquivo precisa ser do tipo imagem!'
        ];
    
        
        $validator = Validator::make($request->all(), [
            
            'name' => 'required|min:5',
            'email' => 'email',
            'fone' => 'numeric|max:99999999999',
            'image' => 'image'
        ], $message);

        if ($validator->fails()) {
            return response()->json($validator->errors(),401);
        } else {
            
            if ($request->hasFile('image') && $request->file('image')->isValid()){

                if( Storage::disk('public')->exists($people->image)) {

                    Storage::disk('public')->delete($people->image);
                } 

                $destination_path = 'public/images';
                $image = $request->file('image');
                $extension = $image->extension(); 
                $image_name = $image->getClientOriginalName();

                if (Storage::disk('public')->exists('images/'.$image_name)){

                    $result = [
                        'status'=> 'error',
                        'mensagem' => 'Esta imagem ja foi cadastrada!'
                    ];
                    return response()->json($result, 401);

                } else{
                    $request->file('image')->storeAs($destination_path,$image_name);
                    
                    if($request->input('name')){
                        $people->name = $request->input('name');
                    }

                    if($request->input('email')){
                        $people->email = $request->input('email');
                    }

                    if($request->input('password')){
                        $people->password = $request->input('password');
                    }

                    if($request->input('fone')){
                        $people->fone = $request->input('fone');
                    }

                    $people->image = 'images/'.$image_name;

                    if ($people->save()) {
                        new PeopleResource($people);
                        $result = [
                            'status'=> 'success',
                            'mensagem' => 'Dados da pessoa foram atualizados'
                        ];
                        return response()->json($result, 200);

                    } else{
                        $result = [
                            'status'=> 'error',
                            'mensagem' => 'Erro ao salvar o editar!'
                        ];
                        return response()->json($result, 401);
                    }

                }

            } else {
                $result = [
                    'status'=> 'error',
                    'mensagem' => 'Imagem não é valida!'
                ];
                return response()->json($result, 401);
            }
            
        }
    }

    // Delete people
    public function destroy($id)
    {
        $people = PeopleModel::findOrFail($id);
        if ($people->delete()) {
            Storage::disk('public')->delete($people->image);
            new PeopleResource($people);
            $result = [
                'status'=> 'success',
                'mensagem' => 'Pessoa deletada!'
            ];
            return response()->json($result, 200);

        } else {

            $result = [
                'status'=> 'error',
                'mensagem' => 'Erro ao deletar!'
            ];
            return response()->json($result, 401);
        }
    }
}
