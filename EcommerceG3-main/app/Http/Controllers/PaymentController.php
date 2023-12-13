<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    
    public function createPaymentIntent(Request $request)
    {
        
        
            // Set your secret Stripe key
            
            Stripe::setApiKey(env('STRIPE_SECRET'));

           
           
            try {           // Create a PaymentIntent
            $charge  = Charge::create([
                'amount' => $request->input('amount'), // Le montant à payer en cents (100 = 1 dollar)
                'currency' => 'usd', // La devise
                'source' =>  $request->input('token'), //Le token Stripe de la carte de crédit
                'description' => 'Paiement via Stripe', // Description facultative
                'receipt_email'=>$request->input('email') // L'adresse e-mail à laquelle envoyer un reçu de paiement.
                
]);
        // Le paiement a réussi
     return response()->json(['message' => 'Paiement réussi']);
        } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }
            
    }

}
