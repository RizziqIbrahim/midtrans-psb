<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::all();
        return view("index",compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        $rules = array(
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'jumlah' => 'required|integer|',
            'category_id' => 'required|integer|',
            'nomor' => 'required|',

        );

        $cek = Validator::make($request->all(),$rules);

        if($cek->fails()){
            $errorString = implode(",",$cek->messages()->all());
            return response()->json([
                'message' => $errorString
            ], 401);
        }else{
            $order = Order::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'jumlah' => $request->jumlah,
                'category_id' => $request->category_id,
                'nomor' => $request->nomor,
            ]);
            $this->_generatePaymentToken($order);
            return redirect("payments/". $order->id);
        }
    }

    public function bayar(Request $request, $id)
    {
        $order = Order::where('id', $id)->get();
        return view("checkout", compact('order'));
        
    }
    

    private function _generatePaymentToken($order)
    {
        $this->initPaymentGateway();

        $customerDetails = [
            'nama' => $order->nama,
            'email' => $order->email,
            'phone' => $order->nomor,
        ];
        $params = [
            'enable_payments' => Order::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->jumlah,
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start-time' => date('Y-m-d H:i:s T'),
                'unit' => Order::EXPIRY_UNIT,
                'duration' => Order::EXPIRY_DURATION,
            ],
        ];
        $snap = \Midtrans\Snap::createTransaction($params);
        
        if($snap->token){
            $order->payment_token = $snap->token;
            $order->payment_url = $snap->redirect_url;
            $order->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
