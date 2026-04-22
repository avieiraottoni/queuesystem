<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BundlesController extends Controller
{
    public function index() {

        $data = [
            'subtitle'  => 'Bundles',
            'bundles'   => auth()->user()->company->bundles()->get()
        ];

        return view('bundles.home', $data);
    }

    public function createBundle() {
        
        $data = [
            'subtitle'  => 'Criar bundle',
            'queues'     => auth()->user()->company->queues()->get()
        ];

        return view('bundles.create_bundle_frm', $data);
    }

    public function createBundleSubmit(Request $request) {
        
        // form validation
        $request->validate(
            [
                'bundle_name'           => 'required|string|min:5|max:100',
                'credential_username'   => 'required|string|size:64',
                'credential_password'   => 'required|string|size:64',
                'queue_list'            => 'required'
            ],
            [
                'bundle_name.required'          => 'O nome do bundle é obrigatório.',   
                'bundle_name.string'            => 'O nome do bundle deve ser uma string.',   
                'bundle_name.min'               => 'O nome do bundle deve ter pelo menos 5 caracteres.',   
                'bundle_name.max'               => 'O nome do bundle deve ter no máximo 100 caracteres.',
                'credential_username.required'  => 'A credencial username é obrigatória.',  
                'credential_username.string'    => 'A credencial username deve ser uma string.',  
                'credential_username.size'      => 'A credencial username deve ter 64 caracteres.',  
                'credential_password.required'  => 'A credencial password é obrigatória.',  
                'credential_password.string'    => 'A credencial password deve ser uma string.',  
                'credential_password.size'      => 'A credencial password deve ter 64 caracteres.',  
            ]
        );

        // check if the queue list is a valid json and the json is not empty
        if(empty($request->queue_list) || json_decode($request->queue_list) === null || empty(json_decode($request->queue_list))) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['queues_list' => 'A lista de filas é obrigatória.']);
        }

        // check if the name of the bundle already exists 
        $bundle_name = $request->bundle_name;
        $bundleExists = auth()->user()->company->bundles()
            ->where('name', $bundle_name)
            ->exists();
        if($bundleExists) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['bundle_name' => 'Já existe outro bundle com esse nome.']);
        }

        dd($request->all());
    }

    public function generateCredentialValue($num_chars) {
        
        // validate the request
        if(!is_numeric($num_chars) || $num_chars <= 0 || $num_chars > 64) {
            return response()->json(['error' => 'Invalid number of characters'], 400);
        }

        // generate the random string to create the hash code
        $credentialValue = Str::random($num_chars);

        while(Bundle::where('credential_username', $credentialValue)->exists()) {
            $credentialValue = Str::random($num_chars);
        }

        return response()->json(['hash' => $credentialValue]);
    }
}
