@if($setting->barcode == "size_1")


<div
id="qrcode"
class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
<p class="text-xs">50 mm x 25 mm / 2" x 1" inches</p>


<div class="barcode-image-section size_1 bq-inner-box">
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


</div>

@endif

@if($setting->barcode == "size_2")

<div
id="qrcode"
class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
<p class="text-xs">50 mm x 25 mm / 2" x 1" inches  </p>


<div class="qr-image-section size_2 bq-inner-box">
<div class="qr-item">
  <p class="qr-description">
    <span id="barcode_item">Pent Coat Pent Coat Pent Coat</span>
    (<span id="barocde_size">14/18</span>)
  </p>

  <h3 class="qr-code-text" id="barcode_ptc">D5543</h3>

  <h3 class="qr-price">
    <strong>NNG <span id="barcode_sale_rate" class="qr-price-value">5000</span></strong>
  </h3>

  <img src="{{ asset('assets/img/qrcode_1.png') }}" alt="qr" class="qr-img">

  <h3 id="barcode_barcode" class="qr-barcode">2455566</h3>
</div>
</div>

</div>

@endif

@if($setting->barcode == "size_3")


<div
id="qrcode"
class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
<p class="text-xs">38 mm x 28 mm / 1.5" x 1.0" inches  </p>


<div class="barcode-image-section size_3 bq-inner-box">
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

</div>

@endif

@if($setting->barcode == "size_4")


<div
id="qrcode"
class="flex items-center justify-center gap-2 flex-col transition-colors bg-indigo-50 w-full max-w-[400px] p-2 border-2 border-dashed border-indigo-300 rounded-xl bq-box"
>
<p class="text-xs">38 mm x 28 mm / 1.5" x 1.0" inches  </p>



<div class="qr-image-section size_4 bq-inner-box">
<div class="qr-item">
  <p class="qr-title">
    <span id="barcode_item">Pent Coat Pent Coat Pent Coat</span>
    (<span id="barocde_size">14/18</span>)
  </p>

  <h3 class="qr-code" id="barcode_ptc">D5543</h3>

  <h3 class="qr-price">
    <strong>NNG <br><span id="barcode_sale_rate">5000</span></strong>
  </h3>

  <img src="{{ asset('assets/img/qrcode_2.png') }}" alt="qr" class="qr-image">

  <h3 class="qr-barcode" id="barcode_barcode">2455566</h3>
</div>
</div>

</div>

@endif
