<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        /*
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'apellidopaterno' => ['required', 'string', 'max:255'],
            'apellidomaterno' => ['required', 'string', 'max:255'],
            'ci' => ['required', 'string', 'max:12'],
            'telefono' => ['required', 'string', 'max:10'],
            'direccion' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),            
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        */
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),            
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        /*
        $userCreated = User::create([
            'name' => $input['name'],
            'apellidopaterno' => $input['apellidopaterno'],
            'apellidomaterno' => $input['apellidomaterno'],
            'ci' => $input['ci'],
            'telefono' => $input['telefono'],
            'direccion' => $input['direccion'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),            
        ]);
        
        
        $userCreated->assignRole('Cliente');
        return $userCreated;
        */
        //$user->assignRole($roleProveedor);

        
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),            
        ]);
        

        

        
    }
}
