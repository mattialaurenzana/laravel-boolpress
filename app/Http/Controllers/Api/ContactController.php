<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function store(Request $request){

       $data = $request->validate([
           "name" => "nullable | string",
           "surname" => "nullable|string",
           "email" => "required | email",
           "message" => "required | string"
         
       ]);

       $newContact = new Contact();
       $newContact->fill($data);
       $newContact->save();

       return response()->json($newContact);
       
   }
}
