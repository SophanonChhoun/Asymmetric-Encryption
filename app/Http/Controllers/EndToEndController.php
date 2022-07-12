<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EndToEndController extends Controller
{
    public function encryptPublic()
    {
        $data = 'Teacher Coca.';
        $valid = openssl_public_encrypt($data, $crypted, file_get_contents(public_path('public-dara.pem')), OPENSSL_PKCS1_PADDING);
        $data = base64_encode($crypted);
        if ($valid) {
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to encrypt.'
            ]);
        }
    }

    public function decrypt(Request $request)
    {
        $data = openssl_private_decrypt(base64_decode($request->text), $decrypted, openssl_pkey_get_private(file_get_contents(public_path('private.pem'))), OPENSSL_PKCS1_PADDING);
        if ($data) {
            return response()->json([
                'success' => true,
                'data' =>  $decrypted
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to decrypt.'
            ]);
        }
    }
}
