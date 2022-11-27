<?php

namespace App\Services;

interface AuthService extends GenericService {
    public function signUp($request);
    public function verifyGoogle2fa($request);
    public function signIn($request);
    public function signOut();
}
