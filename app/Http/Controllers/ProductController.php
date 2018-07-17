<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Product;

class ProductController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  function index() {
   $productsData = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json'), true) : [];
   return view('products.index')->with('products', $productsData);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  function create() {
   return view('products.create');
  }


   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  function store(Request $request) {
    try {
      // my data storage location is project_root/storage/app/data.json file.
      $productInfo = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
      $inputData = $request->only(['name', 'quantity', 'price']);
      $inputData['datetime_submitted'] = date('Y-m-d H:i:s');
      $inputData['total_value_number'] = $inputData['quantity'] * $inputData['price'];
      array_push($productInfo,$inputData);
      Storage::disk('local')->put('data.json', json_encode($productInfo));

      return redirect('/products')->with('success', 'New product created!');
    }
    catch(Exception $e) {
      return ['error' => true, 'message' => $e->getMessage()];
    }
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $datetime_submitted
   * @return \Illuminate\Http\Response
   */
    public function edit($datetime_submitted)
    {
        $productInfo = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];
        $name = $quantity = $price = '';
        foreach ($productInfo as $index => $product) {
            if ($product->datetime_submitted == $datetime_submitted) {
              $name = $product->name;
              $quantity = $product->quantity;
              $price = $product->price;
              $datetime_submitted = $product->datetime_submitted;
            }
        }
        return view('products.edit', compact('name', 'quantity', 'price', 'datetime_submitted'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $datetime_submitted
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $datetime_submitted)
    {
      $inputData = $request->only(['name', 'quantity', 'price']);
      $productInfo = Storage::disk('local')->exists('data.json') ? json_decode(Storage::disk('local')->get('data.json')) : [];

      $productUpdate = array();
      $name = $quantity = $price = '';
      foreach ($productInfo as $index => $product) {
          if ($product->datetime_submitted == $datetime_submitted) {
            $inputData['total_value_number'] = $inputData['quantity'] * $inputData['price'];
            $inputData['datetime_submitted'] = $datetime_submitted;
            array_push($productUpdate, $inputData);
            Storage::disk('local')->put('data.json', json_encode($productInfo));
          }
          else {
            $inputOldData['name'] = $product->name;
            $inputOldData['price'] = $product->price;
            $inputOldData['quantity'] = $product->quantity;
            $inputOldData['total_value_number'] = $product->total_value_number;
            $inputOldData['datetime_submitted'] = $product->datetime_submitted;
            array_push($productUpdate, $inputOldData);
          }
      }
      Storage::delete('storage/app/data.json');
      Storage::disk('local')->put('data.json', json_encode($productUpdate));
      return redirect('/products')->with('success', 'Product updated!');
    }
}