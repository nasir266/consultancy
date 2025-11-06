@extends('layouts.master')

@section('title','Barcode Setting')

@section('styles')
  
  <link rel="stylesheet" href="{{ asset('assets/css/barcode.css') }}">

@endsection


@section('content')

<div
class="bg-white rounded-xl p-5 m-2.5 sm:m-5 text-[13px] lg:text-base"
>
<h1 class="text-2xl font-medium mb-7 text-gray-600">
  BarCode / QR Code
</h1>
<form action="#" class="block">
  <div class="space-y-2 max-w-[700px]">
    <div>
      <label for="width" class="block text-gray-600 font-medium mb-1"
        >Width</label
      >
      <input
        id="width"
        type="number"
        class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
        placeholder=""
      />
    </div>
    <div>
      <label for="height" class="block text-gray-600 font-medium mb-1"
        >Height</label
      >
      <input
        id="height"
        type="number"
        class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
        placeholder=""
      />
    </div>
    <div>
      <label
        for="measure"
        class="block text-gray-600 font-medium mb-1"
        >Measure</label
      >
      <select
        name="measure"
        id="measure"
        class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1.5 rounded-md"
      >
        <option value="">Inch</option>
        <option value="">mm</option>
      </select>
    </div>
  </div>

  <button
    class="flex items-center mt-5 px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    type="button"
  >
    Generate Barcode
  </button>
</form>

<div class="flex items-center gap-4 flex-wrap mt-8">
  <div
    id="qrcode"
    class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
  >
    <p class="text-xs">50 mm x 25 mm / 2" x 1" inches</p>
   

    <div class="barcode-image-section size_1">
      <div class="barcode-item-wrapper">
        <p class="barcode-item-description">
          <span class="barcode_name" id="barcode_item">Pent Coat Pent Coat Pent Coat</span>
          (<span id="barcode_size">14/18</span>)
        </p>
    
        <span class="barcode-image-main barcode-image-size">
          <img src="{{ asset('assets/img/barcode_1.png') }}" alt="barcode" class="barcode-img">
          
          <span class="barcode-image-desc-left">
            <h3 id="barcode_ptc" class="desc-left-text">D5543</h3>
          </span>
          
          <span class="barcode-image-desc-right">
            <h3 id="barcode_price">NNG <span id="barcode_sale_rate">5000</span></h3>
          </span>
          
          <span class="barcode-image-desc-bottom">
            <h3 id="barcode_barcode">245</h3>
          </span>
        </span>
      </div>
    </div>

    @if($get->barcode == "size_1")
      <a href="javascript:void(0)" class="text-green text-xs">Selected</a>
    @else 
      <a href="{{ route('barcode.update','size_1') }}" class="text-indigo-600 text-xs">Set Default</a>
    @endif
  </div>




  <div
  id="qrcode"
  class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
  <p class="text-xs">50 mm x 25 mm / 2" x 1" inches  </p>
 

  <div class="qr-image-section size_2">
    <div class="qr-item">
      <p class="qr-description">
        <span id="barcode_item">Pent Coat Pent Coat Pent Coat</span>
        (<span id="barocde_size">14/18</span>)
      </p>
      
      <h3 class="qr-code-text">D5543</h3>
      
      <h3 class="qr-price">
        <strong>NNG: <span id="barcode_sale_rate" class="qr-price-value">5000</span></strong>
      </h3>
      
      <img src="{{ asset('assets/img/qrcode_1.png') }}" alt="qr" class="qr-img">
      
      <h3 id="barcode_barcode" class="qr-barcode">2455566</h3>
    </div>
  </div>

  @if($get->barcode == "size_2")
    <a href="javascript:void(0)" class="text-green text-xs">Selected</a>
  @else 
    <a href="{{ route('barcode.update','size_2') }}" class="text-indigo-600 text-xs">Set Default</a>
  @endif

</div>



<div
  id="qrcode"
  class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
  <p class="text-xs">38 mm x 28 mm / 1.5" x 1.0" inches  </p>
 

  <div class="barcode-image-section size_3">
    <div class="barcode-item">
      <p class="barcode-description">
        <span id="barcode_item">Pent Coat Pent Coat Pent Coat</span> 
        (<span id="barcode_size">14/18</span>)
      </p>
  
      <span class="barcode-image-main">
        <img src="{{ asset('assets/img/barcode_2.png') }}" alt="barcode" class="barcode-img">
  
        <span class="barcode-image-desc-left">
          <h3 id="barcode_ptc">D5543</h3>
        </span>
  
        <span class="barcode-image-desc-right">
          <h3 id="barcode_price">NNG <span id="barcode_sale_rate">5000</span></h3>
        </span>
  
        <span class="barcode-image-desc-bottom">
          <h3 id="barcode_barcode">2455566</h3>
        </span>
      </span>
    </div>
  </div>

  @if($get->barcode == "size_3")
    <a href="javascript:void(0)" class="text-green text-xs">Selected</a>
  @else 
    <a href="{{ route('barcode.update','size_3') }}" class="text-indigo-600 text-xs">Set Default</a>
  @endif

</div>


<div
  id="qrcode"
  class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
  <p class="text-xs">38 mm x 28 mm / 1.5" x 1.0" inches  </p>
 


  <div class="qr-image-section size_4">
    <div class="qr-item">
      <p class="qr-title">
        <span id="barcode_item">Pent Coat Pent Coat Pent Coat</span> 
        (<span id="barocde_size">14/18</span>)
      </p>
  
      <h3 class="qr-code">D5543</h3>
  
      <h3 class="qr-price">
        <strong>NNG: <br><span id="barcode_sale_rate">5000</span></strong>
      </h3>
  
      <img src="{{ asset('assets/img/qrcode_2.png') }}" alt="qr" class="qr-image">
  
      <h3 class="qr-barcode" id="barcode_barcode">2455566</h3>
    </div>
  </div>
  
  @if($get->barcode == "size_4")
    <a href="javascript:void(0)" class="text-green text-xs">Selected</a>
  @else 
    <a href="{{ route('barcode.update','size_4') }}" class="text-indigo-600 text-xs">Set Default</a>
  @endif
  
</div>


</div>















</div>
</div>
</div>


@endsection


