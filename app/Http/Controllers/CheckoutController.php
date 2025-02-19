<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $acess_token = $this->generateAccessToken();
        $session_token = $this->generateSessionToken($acess_token);
        return view('checkout.index', compact('session_token'));
    }

    public function generateAccessToken()
    {
        $url_api = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');

        $auth = base64_encode($user . ':' . $password);

        return Http::withHeaders([
            'Authorization' => 'Basic ' . $auth,
        ])->get($url_api)
            ->body();
    }

    public function generateSessionToken($acess_token)
    {
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/{$merchant_id}";

        $response = Http::withHeaders([
            'Authorization' => $acess_token,
            'Content-Type' => 'application/json',

        ])
            ->post($url_api, [
                'channel' => 'web',
                'amount' => Cart::instance('shopping')->subtotal() + 99,
                'antifraud' => [
                    'clientIp' => request()->ip(),
                    'merchantDefineData' => [
                        "MDD4" => "integraciones@niubiz.com.pe",
                        "MDD32" => "JD1892639123",
                        "MDD75" => "Registrado",
                        "MDD77" => 458
                    ],
                ],
            ])
            ->json();
        return $response['sessionKey'];
    }

    public function paid(Request $request)
    {
        $acess_token = $this->generateAccessToken();
        $merchant_id = config('services.niubiz.merchant_id');
        $url_api = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/{$merchant_id}";

        $response = Http::withHeaders([
            "Authorization" => $acess_token,
            "Content-Type" => 'application/json',
        ])->post($url_api, [
            "channel" => "web",
            "captureType" => "manual",
            "countable" => true,
            "order" => [
                "tokenId" => $request->transactionToken,
                "purchaseNumber" => $request->purchaseNumber,
                "amount" => $request->amount,
                "currency" => "USD",
            ],
        ])->json();

        session()->flash('niubiz', [
            'response' => $response,
            'purchaseNumber' => $request->purchaseNumber,
        ]);

        // return $request->all();

        if (isset($response['dataMap']) && $response['dataMap']['ACTION_CODE'] == '000') {
            $address = Address::where('user_id', Auth::id())->where('default', true)->first();
            Order::create([
                'user_id' => Auth::id(),
                'content' => Cart::instance('shopping')->content(),
                'address' => $address,
                'payment_id' => $response['dataMap']['TRANSACTION_ID'],
                'total' => Cart::instance('shopping')->subtotal() + 99,
            ]);
            Cart::instance('shopping')->destroy();

            return redirect()->route('gracias');
        }
        return redirect()->route('checkout.index');
    }
}
