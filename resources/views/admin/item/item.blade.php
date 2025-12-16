@extends('layouts.master')

@section('title','Item')

@section('styles')

  <style>
    .disabled {
      cursor: not-allowed;
      opacity: 0.6;
      pointer-events: none;
    }

    .main-table td {
        padding: 10px;
        text-align: center;
        border-right: 1px solid #f1f1f1;
    }

    .main-table tr{
        border-bottom: 1px solid #f1f1f1;
    }

    .text-center {
        text-align: center;
    }

    /* Nav Pills Styling */
.nav-pills {
    display: flex;
    justify-content: start;
    margin-bottom: 15px;
}

.nav-pills .nav-link {
    padding: 8px 15px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.nav-pills .nav-link.active {
    background-color: rgb(79 70 229 / var(--tw-bg-opacity, 1));
    color: white;
}

.nav-pills .nav-link:hover {
    background-color: rgb(79 70 229 / var(--tw-bg-opacity, 1));
    color: white;
}


/* Hide Non-Active Payment Fields */
.payment-field {
    display: none;
}

.payment-field.active {
    display: block;
}

/* Submit Button */
.submit-btn {
    background-color: rgb(79 70 229 / var(--tw-bg-opacity, 1));
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.submit-btn:hover{
  background: transparent;
}

.payment-fields {
    margin-top: 20px;
}

button:focus-visible{
  outline: red auto 1px;
}

span.multi-select-button{
  width: 100%;
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  border: 1.5px solid #aaa !important;
  border-radius: 0.375rem;
  box-shadow: unset;
}

.multi-select-button:after{
  content: unset !important;
}

.payment-field label{
  font-weight: 600;
  font-size: 15px;
}

.payment-field input, .payment-field select {
    margin-top: 3px;
    margin-bottom: 3px;
}

#invoice_form .main-table {
    max-height: 400px;
    overflow-y: auto;
}

#payment_total_amount{
    font-weight: bolder;
    border: 1.5px solid black !important;
}

.d-flex{
  display: flex;
  justify-content: space-between;
}

.popup_close i{
  cursor: pointer;
}

.dark-f{
  background: #ddd;
}

tbody{
  background: white;
}
.w-300{
  min-width: 300px;
}

#description,#barcode{
  font-weight: bold;
}

#item-search-model .selectize-input .item {
  white-space: nowrap;       /* Prevent text from wrapping */
  overflow: hidden;          /* Hide the overflow */
  text-overflow: ellipsis;   /* Add the "..." */
  width: 220px;              /* Set a fixed width */
}

.w-100{
  width: 100px;
}

.w-150{
  width: 150px;
}

.show_barcode{
    margin-top: 20px;
    margin-left: auto;
}

#barcode_wrapper {
    display: flex;
    flex-basis: 50%;
    flex-wrap: wrap;
    max-height: 200px;
    overflow: scroll;
}
#barcode_wrapper .bq-inner-box {
    flex-basis: 50%;
    margin-bottom:10px;
}
.rightSide{
    text-align: right;
}
  </style>

<link rel="stylesheet" href="{{ asset('assets/css/mult-select.css?v=2') }}">

<link rel="stylesheet" href="{{ asset('assets/css/barcode.css?v=4x') }}">

@endsection

@section('content')
<div class="p-2.5 md:p-6 text-[13px] lg:text-base">
  <form id="form" enctype="multipart/form-data" method="post" action="#" class="block">
    @csrf

    <input type="hidden" id="from">
    <input type="hidden" id="to">
    <input type="hidden" id="less">

    <div class="bg-white rounded-t-xl">
      <div class="flex items-center flex-wrap sm:flex-nowrap gap-4 p-4 pb-0">
        <div class="w-full max-w-[180px]">
          <label
            for="id"
            class="text-gray-600 block mb-1 font-medium"
            >Item ID</label
          >

          <input
            id="id"
            name="id"
            type="number"
            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            placeholder="id"
            value="{{ $id + 1 }}"
            min="1"
            max="{{ $id + 1 }}"
            oninput="get_id_item(this.value,'id')"
            required
          />
        </div>
        <div class="w-full max-w-[280px]">
          <label
            for="s-date"
            class="text-gray-600 font-medium block mb-1"
            >Select Date</label
          >
          <input
            value="{{ date("Y-m-d") }}"
            id="date"
            type="date"
            name="date"
            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            required
          />
        </div>
        <label
          for="uploadImg"
          class="flex items-center justify-center gap-2 flex-col cursor-pointer transition-colors hover:bg-indigo-50 w-36 h-24 p-2 border-2 border-dashed border-indigo-300 rounded-xl"
        >
          <input
            id="uploadImg"
            name="image"
            type="file"
            accept="image/*"
            oninput="uploadFile(event, 'previewImg', 'img')"
            class="hidden"
          />
          <i class="fa-regular fa-image text-4xl text-indigo-400"></i>
          <img
            id="previewImg"
            class="block hidden w-full h-full object-cover rounded-md"
            alt=""
          />
          <span class="text-xs font-medium text-indigo-400 underline"
            >Upload Image</span
          >
        </label>
        <button
          class="flex items-center justify-center gap-2 flex-col cursor-pointer transition-colors hover:bg-indigo-50 w-36 h-24 p-2 border-2 border-dashed border-indigo-300 rounded-xl"
          type="button"
          onclick="opneCam(event, 'previewImg')"
        >
          <i class="fa-solid fa-camera text-4xl text-indigo-400"></i>
          <span
            class="block text-xs font-medium text-indigo-400 underline"
            >Open Camera</span
          >
        </button>
      </div>
    </div>
    <div class="bg-white rounded-b-xl p-4 pt-0">
      <div class="space-y-2.5">
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="w-full max-w-[180px]">
            <label
              for="party_id"
              class="text-gray-600 font-medium block mb-1"
              >Party ID</label
            >
            <input
              oninput="syncPartyId(this,'party_name')"
              type="number"
              id="party_id"
              min="1"
              name="party_id"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              required
            />
          </div>
          <div class="w-full max-w-[588px]">
              <label
                for="party_name"
                class="text-gray-600 font-medium block mb-1"
                >Select Party/Brand</label
              >
              <select
                class="selectize-input-sp w-full"
                name="party_name"
                id="party_name"
                oninput="syncPartyId(this,'party_id')"
                required
                autofocus
              >
              <option value="">Select Party</option>
              @foreach($parties as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <button
            type="button"
            onclick="openModal(event, 'item-search-model')"
            class="px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          >
            Item Search
          </button>
          <a
              target="_blank"
            href="../party"
            class="px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          >
            Add Party
          </a>
        </div>
          <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="w-full max-w-[180px]">
              <label
                  for="s-part"
                  class="text-gray-600 font-medium block mb-1"
              >Enter Item Code</label
              >
              <select
                  class="c_selectize w-full"
                  name="item_code"
                  id="item_code"
              >
                  <option value="">Select</option>
              </select>
          </div>
          <div class="w-full max-w-[486px]">
            <label
              for="c-item"
              class="text-gray-600 font-medium block mb-1"
              >Choose Item</label
            >
            <select
              id="define_item_id"
              class="selectize-input-sp w-full"
              name="define_item_id"
              required
            >
              <option value="">Choose</option>
              @foreach($define_items as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <button
            type="button"
            onclick="openModal(event, 'choose-item-model-1')"
            class="px-4 py-[8px] transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          >
            <i data-feather="plus" class="w-4 h-4"></i>
          </button>
          <div class="w-full max-w-[180px]">
            <label
              for="define_size_id"
              class="text-gray-600 font-medium block mb-1"
              >Choose Size</label
            >
            <select
              id="define_size_id"
              class="selectize-input-sp w-full"
              name="define_size_id"
              required
            >
              <option value="">Choose</option>
              @foreach($define_sizes as $item)
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <button
            type="button"
            onclick="openModal(event, 'choose-item-model-2')"
            class="px-4 py-[8px] transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          >
            <i data-feather="plus" class="w-4 h-4"></i>
          </button>
        </div>
        <div class="flex gap-3 flex-wrap sm:flex-nowrap">
          <div class="w-full max-w-[180px]">
            <label
              for="barcode"
              class="text-gray-600 font-medium block mb-1"
              >Barcode</label
            >
            <input
              type="text"
              id="barcode"
              name="barcode"
              value="{{ $id + 1 }}"
              placeholder="Enter Bar Code"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
              required
            />
          </div>
          <div class="flex-grow md:flex-1">
            <label
              for="description"
              class="text-gray-600 font-medium mb-1 block"
              >Description</label
            >
            <input
              type="text"
              id="description"
              name="description"
              placeholder="Enter Description"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
              required
              readonly
            />
          </div>
        </div>
        <div class="flex gap-3 flex-wrap sm:flex-nowrap">
          <div class="w-full max-w-[180px]">
            <label
              for="p-rate"
              class="text-gray-600 font-medium block mb-1"
              >Purchase Rate</label
            >
            <input
              type="text"
              id="purchase_rate"
              name="purchase_rate"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"
              required
            />
          </div>
            <div class="flex flex-col gap-1 flex-grow md:flex-1">
                <label for="p-disc" class="text-gray-600 font-medium"
                >Margin </label
                >
                <input
                    type="text"
                    name="margin_field"
                    id="margin_field"
                    oninput="calcProfit()"
                    value="0"
                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

                />
            </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="s-rate" class="text-gray-600 font-medium"
              >Sale Rate</label
            >
            <input
              type="text"
              id="sale_rate"
              name="sale_rate"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"
              required
            />
          </div>

          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="p-disc" class="text-gray-600 font-medium"
              >Party Disc</label
            >
            <input
              type="text"
              name="party_disc"
              id="party_discount"
              oninput="calcProfit()"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field dark-f"

            />
          </div>

          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="p-less" class="text-gray-600 font-medium"
              >Party Less</label
            >
            <input
              type="text"
              name="party_less"
              id="party_less"
              oninput="calcProfit()"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field dark-f"

            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="c-less" class="text-gray-600 font-medium"
              >Customer Less</label
            >
            <input
              type="text"
              name="customer_less"
              id="customer_less"
              oninput="calcProfit()"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="profit" class="text-gray-600 font-medium"
              >Profit</label
            >
            <input
              type="text"
              name="profit"
              id="profit"
              oninput="calcProfit()"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
              required
              readonly
            />
          </div>
        </div>
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-center">
          <div class="w-full max-w-[180px]">
            <label
              for="Packet-q"
              class="text-gray-600 font-medium block mb-1"
              >Packet Qty</label
            >
            <input
              type="text"
              id="packet_qty"
              name="packet_qty"
              oninput="calculateTotalPieces()"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

            />
          </div>
          <div class="text-indigo-600 mt-[28px]">
            <i data-feather="x" class="w-4 h-4"></i>
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="p-packet"
              class="text-gray-600 font-medium block mb-1"
              >Pcs In Packet</label
            >
            <input
              type="text"
              name="pieces_in_packet"
              id="pieces_in_packet"
              oninput="calculateTotalPieces()"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

            />
          </div>
          <div class="text-indigo-600 mt-[28px]">
            <i data-feather="minus" class="w-4 h-4"></i>
            <i
              data-feather="minus"
              class="w-4 h-4"
              style="margin-top: -11"
            ></i>
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="t-pieces"
              class="text-gray-600 font-medium block mb-1"
              >Total Pieces</label
            >
            <input
              type="number"
              name="total_pieces"
              id="total_pieces"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
              readonly
            />
          </div>


          <button class="flex items-center px-4 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600 show_barcode" type="button" onclick="openModal(event, 'barcode-model')">
            Show Barcode
          </button>


        </div>
      </div>
    </div>
    <div
      class="my-4 flex items-center gap-2 justify-between bg-white p-3 px-4 rounded-lg shadow-sm"
    >

    <div class="space-y-2">
      <h3 class="text-2xl font-medium">Status</h3>
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <label for="active" class="text-gray-600 font-medium"
            >Active</label
          >
          <input
            type="radio"
            name="status"
            id="active"
            value="active"
            checked
            class="accent-indigo-600 w-3 h-3"
          />
        </div>
        <div class="flex items-center gap-2">
          <label for="inactive" class="text-gray-600 font-medium"
            >Inactive</label
          >
          <input
            type="radio"
            name="status"
            id="inactive"
            value="inactive"
            class="accent-red-600 w-3 h-3"
          />
        </div>
      </div>
    </div>

      <div class="flex items-center flex-wrap sm:flex-nowrap gap-3 justify-end">
        <button
          class="flex items-center px-4 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          type="button"
          id="reset_btn"
          onclick="reset_item()"
        >
          <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i>
          Reset
        </button>
        <button
          class="flex items-center px-4 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          type="submit"
          id="save_btn"
        >
          <i data-feather="save" class="w-4 h-4 mr-3"></i>
          <span id="save">Save</span>
        </button>
        <button
          class="flex items-center px-4 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          type="button"
          id="print_btn"
        >
          <i data-feather="printer" class="w-4 h-4 mr-3"></i>
          Print
        </button>
        <button
          class="flex items-center px-4 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600 disabled"
          id="list_data"
          type="button"
        >
          <i data-feather="align-right" class="w-4 h-4 mr-3"></i>
          List Data in Purchase
        </button>
      </div>
    </div>


    <div class="bg-white rounded-xl space-y-4 p-4">
      <h3 class="text-xl font-medium">Retail Details</h3>
      <div class="space-y-3">
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="retail_sale_rate_p" class="text-gray-600 font-medium"
              >Retail Sale Rate(%)</label
            >
            <input
              type="text"
              id="retail_sale_rate_p"
              name="retail_sale_rate_p"
              value="{{ $setting->retail_sale_rate }}"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field dark-f"
            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="retail_sale_rate" class="text-gray-600 font-medium"
              >Retail Sale Rate(Rs)</label
            >
            <input
              type="text"
              id="retail_sale_rate"
              name="retail_sale_rate"
              value="{{ $setting->retail_sale_rate_rs }}"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="retail_less" class="text-gray-600 font-medium"
              >R Less(Rs)</label
            >
            <input
              type="text"
              id="retail_less"
              name="retail_less"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"
            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="retail_discount" class="text-gray-600 font-medium"
              >R Discount(%)</label
            >
            <input
              type="text"
              id="retail_discount"
              name="retail_discount"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"
            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="retail_profit" class="text-gray-600 font-medium"
              >R Profit | R Rate</label
            >
              <div class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
              id = "retail_profit_text"
              ></div>
            <input
              type="hidden"
              id="retail_profit"
              name="retail_profit"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
              readonly
            />
          </div>
          <button
            class="flex items-center px-4 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
            onclick="openModal(event,'retail-barcode-model')"
          >
            R Barcode
          </button>
        </div>
      </div>
    </div>
    <div class="col-span-2 space-y-4 bg-white rounded-xl p-4 mt-4">
      <h3 class="text-xl font-medium">Other Details</h3>
      <div class="space-y-2.5">
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="w-full max-w-[180px]">
            <label
              for="min-level"
              class="text-gray-600 font-medium block mb-1"
              >Min Level</label
            >
            <input
              type="text"
              id="min-level"
              placeholder="min"
              name="min_level"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="max-level"
              class="text-gray-600 font-medium block mb-1"
              >Max Level</label
            >
            <input
              type="text"
              id="max-level"
              placeholder="max"
              name="max_level"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="w_sale_man_commension" class="text-gray-600 font-medium"
              >W Sale Man Commision</label
            >
            <input
              oninput="calcProfit()"
              type="text"
              id="w_sale_man_commension"
              name="w_sale_man_commension"
              placeholder="commision"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="flex flex-col gap-1 flex-grow md:flex-1">
            <label for="r_sale_man_commension" class="text-gray-600 font-medium"
              >R Sale Man Commision</label
            >
            <input
              type="text"
              id="r_sale_man_commension"
              name="r_sale_man_commension"
              placeholder="commision"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
        </div>
      </form>
        <br>
        <hr>
        <br>

        <form method="post" id="invoice_form">
        @csrf
        <div class="space-y-2 5">
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="w-full max-w-[180px]">
            <label
              for="current_date"
              class="text-gray-600 font-medium block mb-1"
              >Current Date</label
            >
            <input
              value="{{ date("Y-m-d") }}"
              id="current_date"
              name="current_date"
              type="date"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              required
            />
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="bill"
              class="text-gray-600 font-medium block mb-1"
              >Bill</label
            >
            <input
              type="number"
              id="bill_no"
              name="bill_no"
              value="{{ $bill_no }}"
              oninput="get_invoice(this.value)"
              min="1"
              max="{{ $bill_no }}"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              required
            />
          </div>
          <div class="w-full max-w-[100px]">
            <label for="vr" class="text-gray-600 font-medium block mb-1"
              >Vr</label
            >
            <input
              type="number"
              id="vr_no"
              name="vr_no"
              value="{{ $vr_no }}"
              min="1"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              required
            />
          </div>
        </div>
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="w-full max-w-[180px]">
            <label
              for="party_inv_date"
              class="text-gray-600 font-medium block mb-1"
              >Party Inv Date</label
            >
            <input
              value="{{ date("Y-m-d") }}"
              id="party_inv_date"
              name="party_inv_date"
              type="date"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              required
            />
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="party_inv_no"
              class="text-gray-600 font-medium block mb-1"
              >Party Inv</label
            >
            <input
              type="text"
              id="party_inv_no"
              name="party_inv_no"
              placeholder="Part Inv"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"

            />
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="bilty"
              class="text-gray-600 font-medium block mb-1"
              >Bilty</label
            >
            <input
              type="text"
              id="bilty_no"
              name="bilty_no"
              placeholder="# bilty"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"

            />
          </div>
          <div class="w-full max-w-[180px]">
              <label
                for="godown"
                class="text-gray-600 font-medium block mb-1"
                >Godown</label
              >
              <select
                name="godown"
                id="godown"
                class="selectize-input-sp w-full"
                required
              >
                @foreach($goddown as $item)
                    <option @if($item->default_status == "true") selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
              </select>
          </div>
        </div>
        <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end">
          <div class="flex flex-col gap-1 flex-1">
            <label for="remark" class="text-gray-600 font-medium"
              >Remark</label
            >
            <input
              id="remarks"
              name="remarks"
              type="text"
              placeholder="remark"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
        </div>
        </div>
            <div class="flex gap-3">
                <div class="w-full max-w-[180px]">
                    <label
                        for="party_id"
                        class="text-gray-600 font-medium block mb-1"
                    >Party ID</label
                    >
                    <input
                        oninput="syncPartyId2(this,'party_name2')"
                        type="number"
                        id="party_id2"
                        min="1"
                        name="party_id2"
                        class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                        required
                    />
                </div>
                <div class="w-full max-w-[588px]">
                    <label
                        for="party_name2"
                        class="text-gray-600 font-medium block mb-1"
                    >Select Party/Brand</label
                    >
                    <select
                        class="selectize-input-sp w-full"
                        name="party_name2"
                        id="party_name2"
                        onchange="syncPartyId2(this,'party_id2')"
                        required
                        autofocus
                    >
                        <option value="">Select Party</option>
                        @foreach($parties as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        <div
          class="flex gap-3 flex-wrap sm:flex-nowrap items-end overflow-x-auto pt-4 pb-3"
        >
          <div class="flex-grow flex-shrink-0 table-wrapper main-table">
            <table
              class="table-auto w-full border-collapse border text-sm"
            >
              <thead class="bg-gray-50 text-gray-600 font-medium">
                <tr>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Sr #
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Barcode
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    P Item Code
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Description
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Godown
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Pkt Qty
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Pcs in Pkt
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Total Pcs
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    P Rate
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Amount
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Less / pcs
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Dis / pcs
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    L Rate
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    G Amount
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Margin
                  </th>
                    <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Total Margin
                  </th>
                    <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Total Less
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Total Dis %
                  </th>
                  <th
                    class="border border-gray-200 px-4 py-2 text-left"
                  >
                    Action
                  </th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

        </div>

        <div class="flex gap-5 flex-wrap sm:flex-nowrap pt-5">
            <div>
                <div class="flex items-center gap-3 flex-wrap w-50">

                    <label
                        for="uploadImg"
                        class="flex items-center justify-center gap-2 flex-col cursor-pointer transition-colors hover:bg-indigo-50 w-20 h-20 p-2 border-2 border-dashed border-indigo-300 rounded-xl"
                    >
                        <input
                            id="uploadImg"
                            name="image"
                            type="file"
                            accept="image/*"
                            oninput="uploadFile(event, 'previewImg', 'img')"
                            class="hidden"
                        />
                        <i class="fa-regular fa-image text-1xl text-indigo-400"></i>
                        <img
                            id="previewImg"
                            class="block hidden w-full h-full object-cover rounded-md"
                            alt=""
                        />
                        <span class="text-xs font-medium text-indigo-400 "
                        >Upload Image</span
                        >
                    </label>

                    <button
                        class="flex items-center justify-center gap-2 flex-col cursor-pointer transition-colors hover:bg-indigo-50 w-20 h-20 p-2 border-2 border-dashed border-indigo-300 rounded-xl"
                        type="button"
                        onclick="opneCam(event, 'previewImg')"
                    >
                        <i class="fa-solid fa-camera text-1xl text-indigo-400"></i>
                        <span
                            class="block text-xs font-medium text-indigo-400 "
                        >Open Camera</span
                        >
                    </button>

                    <button
                        class="flex items-center justify-center gap-2 flex-col w-20 cursor-pointer transition-colors hover:bg-indigo-50 h-20 p-2 border-2 border-dashed border-indigo-300 rounded-xl relative"
                        type="button"
                        onclick="openModal(event, 'bin-model')"
                        style="width: 70px;"
                    >
                        <i class="fa-solid fa-trash text-1xl text-indigo-400"></i>

                        <span class="block text-xs font-medium text-indigo-400 w-20">
            Bin
        </span>

                        <!-- Counter Badge -->
                        <span class="absolute -top-2 -right-2 bg-indigo-400 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg" style="position: absolute; margin-top: -57px; margin-left: 67px; " id="bin-counter">0</span>
                    </button>

                    <button
                        class="flex items-center justify-center gap-2 flex-col w-20 cursor-pointer transition-colors hover:bg-indigo-50 h-20 p-2 border-2 border-dashed border-indigo-300 rounded-xl relative"
                        type="button"
                        onclick="openModal(event, 'comment-model')"
                        id="reasons"
                        style="width: 70px; text-decoration: none !important;"
                    >
                        <i class="fa-solid fa-comment text-1xl text-indigo-400"></i>

                        <span class="block text-xs font-medium text-indigo-400 ">
            Reasons
        </span>

                        <!-- Counter Badge -->
                        <span class="absolute -top-2 -right-2 bg-indigo-400 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg" style="position: absolute; margin-top: -57px; margin-left: 67px; " id="comment-counter">0</span>
                    </button>

                    {{--<button
                        class="flex items-center justify-center gap-2 flex-col w-20 cursor-pointer transition-colors hover:bg-red-50 h-20 p-2 border-2 border-dashed border-red-300 rounded-xl"
                        type="button"
                        onclick="openModal(event, 'bin-model')"
                    >
                        <i class="fa-solid fa-bell  text-1xl text-red-400"></i>
                        <span class="block text-xs font-medium text-red-400 underline">
                      Notification
                    </span>
                    </button>--}}
                </div>

                <!-- New row for Bin and Reasons buttons -->
                <div class="flex items-center gap-3 mt-4 w-96" style="margin-top: 149px;">

                    <button
                        class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        type="button"
                        onclick="openModal(event, 'payment-method-model')"
                    >
                        <i data-feather="credit-card" class="w-4 h-4 mr-3"></i>
                        Payments
                    </button>

                    <button class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600" type="reset" onclick="location.reload();" id="reset_btn"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reset </button>

                    {{--<button
                      class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                      type="submit"
                    >
                      <i data-feather="chevrons-up" class="w-4 h-4 mr-3"></i>
                      Update
                    </button>--}}
                    <button class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600" type="submit" > <i data-feather="save" class="w-4 h-4 mr-3"></i> <span id="invoice_save"> Save</span> </button>
                    <button
                        class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        type="button"
                    >
                        <i data-feather="printer" class="w-4 h-4 mr-3"></i>
                        Print
                    </button>
                    <button
                        id="generate_barcode"
                        class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        type="button"
                    >
                        <i data-feather="codesandbox" class="w-4 h-4 mr-3"></i>
                        QR Code
                    </button>

                    <button
                        class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        type="button"
                        onclick="openModalPur(event, 'update-model', 'ud_comment')"
                    >
                        <i data-feather="trash-2" class="w-4 h-4 mr-3"></i>
                        Delete
                    </button>

                </div>

            </div>









            <div class="flex-grow md:flex-1 ">

                <div class="flex items-center flex-wrap sm:flex-nowrap gap-3 justify-end">
                    <div class="flex flex-col gap-1 w-full max-w-[80px]">
                        <label for="total_pkt" class="text-gray-600 font-medium"
                        >Pkt Qty</label
                        >
                        <input
                            id="total_pkt"
                            name="total_pkt"
                            type="text"
                            placeholder="Qty"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="total-p" class="text-gray-600 font-medium"
                        >Total Pcs</label
                        >
                        <input
                            id="total_piec"
                            name="total_piec"
                            type="text"
                            placeholder="Total Pcs"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="amount" class="text-gray-600 font-medium"
                        >Amount</label
                        >
                        <input
                            id="total_amount"
                            name="total_amount"
                            type="text"
                            placeholder="Amount"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="total_less" class="text-gray-600 font-medium"
                        >Less</label
                        >
                        <input
                            id="total_less"
                            name="total_less"
                            type="text"
                            placeholder="Less"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="total_gamount" class="text-gray-600 font-medium"
                        >G Amount</label
                        >
                        <input
                            id="total_gamount"
                            name="total_gamount"
                            type="text"
                            placeholder="G amount"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                </div>
                <div class="flex items-center flex-wrap sm:flex-nowrap gap-3  justify-end">
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="inv_disc_perc" class="text-gray-600 font-medium"
                        >Inv Disc
                        </label>
                        <input
                            id="inv_disc_perc"
                            name="inv_disc_perc"
                            type="text"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"
                            oninput="calcTable()"

                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="total_disc" class="text-gray-600 font-medium"
                        >Disc</label
                        >
                        <input
                            id="total_disc"
                            name="total_disc"
                            type="text"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label
                            for="net_amount"
                            class="text-gray-600 font-medium"
                        >Net Amount</label
                        >
                        <input
                            id="net_amount"
                            name="net_amount"
                            type="text"
                            placeholder="Net Amount"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                </div>
                <div class="flex items-center justify-end flex-wrap sm:flex-nowrap gap-3">
                    {{--<div class="flex items-center flex-col gap-3 flex-grow md:flex-1 md:max-w-72">
                        hello<br>check<br>hello<br>check<br>hello<br>check<br>
                    </div>--}}
                    <div style="position:absolute; width: 300px; height: 130px; margin-right: 600px; margin-top: -20px;">
                        <div class="flex items-center justify-end gap-4 " style="margin-top: 10px;">
                            <div class="flex items-center gap-2">
                                <label for="cash" class="text-gray-600 text-xl"
                                >Cash</label
                                >
                                <input
                                    type="radio"
                                    name="payment_status"
                                    id="cash"
                                    value="Cash"
                                    class="accent-indigo-600 w-3 h-3"
                                />
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="credit" class="text-gray-600 text-xl">Credit</label>
                                <input
                                    type="radio"
                                    name="payment_status"
                                    id="credit"
                                    value="Credit"
                                    class="accent-indigo-600 w-3 h-3"
                                    checked
                                />
                            </div>
                        </div>
                        {{--2nd--}}
                        <div class="flex items-center justify-end gap-4" style="margin-top: 10px;">
                            <div class="flex items-center gap-2">
                                <label for="bulk_print" class="text-gray-600 text-xl"
                                >Print</label
                                >
                                <input
                                    type="radio"
                                    name="bulk_status"
                                    id="bulk_print"
                                    value="bulk_print"
                                    class="accent-indigo-600 w-3 h-3"
                                    checked
                                />
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="bulk_preview" class="text-gray-600 text-xl"
                                >Preview</label
                                >
                                <input
                                    type="radio"
                                    name="bulk_status"
                                    id="bulk_preview"
                                    value="bulk_preview"
                                    class="accent-indigo-600 w-3 h-3"

                                />
                            </div>
                        </div>
                        {{--3rd--}}
                        <div class="flex items-center justify-end gap-4" style="margin-top: 10px;">
                            <div class="flex items-center gap-2">
                                <label for="bulk_single" class="text-gray-600 text-xl"
                                >Single</label
                                >
                                <input
                                    type="radio"
                                    name="bulk_type"
                                    id="bulk_single"
                                    value="bulk_single"
                                    class="accent-indigo-600 w-3 h-3"
                                />
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="bulk_double" class="text-gray-600 text-xl"
                                >Double</label
                                >
                                <input
                                    type="radio"
                                    name="bulk_type"
                                    id="bulk_double"
                                    value="bulk_double"
                                    class="accent-indigo-600 w-3 h-3"
                                    checked
                                />
                            </div>
                        </div>
                    </div>
                    {{--<div class="bg-gray-100 p-6 rounded-lg shadow-md grid grid-cols-3 gap-4">
                        <div class="bg-blue-500 text-white p-4 rounded">Column 1</div>
                        <div class="bg-green-500 text-white p-4 rounded">Column 2</div>
                        <div class="bg-red-500 text-white p-4 rounded">Column 3</div>
                    </div>--}}




                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="freight" class="text-gray-600 font-medium"
                        >Margin</label
                        >
                        <input
                            oninput="calcTable()"
                            id="total_margin"
                            name="total_margin"
                            type="number"
                            placeholder="Margin"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="freight" class="text-gray-600 font-medium"
                        >Freight</label
                        >
                        <input
                            oninput="calcTable()"
                            id="freight"
                            name="freight"
                            type="number"
                            placeholder="Freight"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label
                            for="paid_amount"
                            class="text-gray-600 font-medium"
                        >Paid Amount</label
                        >
                        <input
                            oninput="calcTable()"
                            id="paid_amount"
                            name="paid_amount"
                            type="text"
                            placeholder="Paid Amount"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

                        />
                    </div>
                </div>
                <div class="flex items-center justify-end flex-wrap sm:flex-nowrap gap-3">

                    <div>



                    </div>


                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label for="total_less2" class="text-gray-600 font-medium"
                        >Total Less</label
                        >
                        <input
                            id="total_less2"
                            name="total_less2"
                            type="text"
                            placeholder="Total Less"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">

                        <label
                            for="total_profit2"
                            class="text-gray-600 font-medium"
                        >Total Profit</label
                        >
                        <input
                            id="total_profit2"
                            name="total_profit2"
                            type="text"
                            placeholder="Total Profit"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />
                    </div>
                    <div class="flex flex-col gap-1 w-full max-w-[187px]">
                        <label
                            for="total_amount2"
                            class="text-gray-600 font-medium"
                        >Total Amount</label
                        >
                        <input
                            id="total_amount2"
                            name="total_amount2"
                            type="number"
                            placeholder="Total Amount"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            required
                            readonly
                        />

                    </div>


                </div>

            </div>
        </div>
    </div>

    <div
    id="payment-method-model"
    class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0"
    >
    <div
      class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
      style="scrollbar-width: none"
    >
      <div id="modal-content" class="text-gray-700">

            <h3 style="font-size: 18px;font-weight: bold;">Payment Method</h3><br>
            <hr><br>

           <!-- Nav Pills to select payment method -->
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active lbl_stl_2 payment-method" aria-current="page" href="#" data-payment-method="cash">Cash</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lbl_stl_2 payment-method" aria-current="page" href="#" data-payment-method="bank">Bank</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link lbl_stl_2 payment-method" href="#" data-payment-method="cheque">Cheque</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link lbl_stl_2 payment-method" href="#" data-payment-method="bank_transfer">Bank Transfer</a>
                  </li>
                </ul>

                <hr>

                <!-- Payment Method Form Fields -->
                <div class="payment-fields">
                    <!-- Cash Fields (displayed by default) -->
                    <div class="row input-bx payment-field cash mt-2" style="display: block;">
                        <div class="col-md-10">
                          <label for="">Amount</label>
                            <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md" type="text" id="cash_amount" name="cash_amount" placeholder="Amount">
                        </div>
                        <div class="col-md-10 mt-2">
                          <label for="">Remarks</label>
                            <textarea class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  name="cash_remarks" id="cash_remarks" cols="30" rows="4" placeholder="Remarks"></textarea>
                        </div>
                    </div>

                    <!-- Bank Fields (hidden by default) -->
                    <div class="row input-bx payment-field bank mt-2" style="display: none;">
                        <div class="col-md-10">
                            <label for="">Bank</label>
                            <select class="c_selectize" id="bank" name="bank">
                                <option value="">Select Bank</option>
                                @foreach($banks as $item)
                                  <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-10 mt-2">
                          <label for="">Account Title</label>
                          <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="bank_account_title" name="bank_account_title" placeholder="Amount">
                      </div>

                      <div class="col-md-10 mt-2">
                        <label for="">Account Number</label>
                        <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="bank_account_number" name="bank_account_number" placeholder="Amount">
                      </div>

                        <div class="col-md-10 mt-2">
                            <label for="">Amount</label>
                            <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="bank_amount" name="bank_amount" placeholder="Amount">
                        </div>
                        <div class="col-md-10 mt-2">
                        <label for="">Remarks</label>
                        <textarea class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  name="bank_remarks" id="bank_remarks" cols="30" rows="2" placeholder="Remarks"></textarea>
                    </div>
                    </div>

                    <!-- Cheque Fields (hidden by default) -->
                    <div class="row input-bx payment-field cheque mt-2" style="display: none;">
                        <div class="col-md-10">
                          <label for="">Bank</label>
                          <select class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1.5 rounded-md" id="cheque_bank" name="cheque_bank">
                              <option value="">Select Bank</option>
                              <option value="Meezan Bank">Meezan Bank</option>
                          </select>
                        </div>
                        <div class="col-md-10 mt-2">
                            <label for="">Amount</label>
                            <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="cheque_amount" name="cheque_amount" placeholder="Amount">
                        </div>
                        <div class="col-md-10 mt-2">
                            <label for="">Cheque Date</label>
                            <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  class="mt-2 text-custome" type="date" id="cheque_date" name="cheque_date">
                        </div>
                        <div class="col-md-10 mt-2">
                          <label for="">Remarks</label>
                        <textarea class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  name="cheque_remarks" id="cheque_remarks" cols="30" rows="2" placeholder="Remarks"></textarea>
                    </div>
                    </div>



                    <div class="row input-bx payment-field bank_transfer mt-2" style="display: none;">
                      <div class="col-md-10">
                        <label for="">From</label>
                        <select class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1.5 rounded-md" id="bt_from" name="bt_from">
                            <option value="">Select Bank</option>
                            <option value="Meezan Bank">Meezan Bank</option>
                        </select>
                      </div>

                      <div class="col-md-10 mt-2">
                        <label for="">To</label>
                        <select class="c_selectize" id="bt_to" name="bt_to">
                            <option value="">Select Bank</option>
                            @foreach($banks as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                      </div>


                      <div class="col-md-10 mt-2">
                          <label for="">Account Title</label>
                          <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="bt_account_title" name="bt_account_title" placeholder="Amount">
                      </div>

                      <div class="col-md-10 mt-2">
                        <label for="">Account Number</label>
                        <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="bt_account_number" name="bt_account_number" placeholder="Amount">
                      </div>

                      <div class="col-md-10 mt-2">
                          <label for="">Amount</label>
                          <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="bt_amount" name="bt_amount" placeholder="Amount">
                      </div>

                      <div class="col-md-10 mt-2">
                          <label for="">Remarks</label>
                          <textarea class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  name="bt_remarks" id="bt_remarks" cols="30" rows="2" placeholder="Remarks"></textarea>
                      </div>
                  </div>

                </div>
                <hr>
                <div class="row input-bx mt-3 justify-content-end">
                    <div class="col-md-6">
                        <label style="font-weight: bolder;font-size: 15px" for="">Total Amount</label>
                        <input class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"  type="text" id="payment_total_amount" name="payment_total_amount" placeholder="Total Amount" readonly>
                    </div>

      </div>

      </div>
      <div class="flex items-center gap-3 justify-end text-sm mt-14">
        <button
          class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
          onclick="closeModal(event, 'payment-method-model')"
          type="button"
        >
          Close
        </button>
        <button
          class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          id="insert_payment_method"
          type="button"
        >
          Save
        </button>
      </div>
    </div>
    </div>

    <div
      class="my-4 flex items-center gap-2 justify-end bg-white p-3 px-4 rounded-lg shadow-sm"
    >

    </div>

  </form>
</div>

</div>
</div>

<div
id="item-search-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[1300px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <div class="d-flex">
      <h3 class="text-gray-600 text-xl font-medium mb-6">Item Search</h3>
      <div class="popup_close">
        <i class="fas fa-close" onclick="closeModal(event, 'item-search-model')"></i>
      </div>
    </div>
    <from class="block mb-7 space-y-5">
      <div class="flex flex-col gap-1">
        <label for="search-item" class="text-gray-600 font-medium"
          >Search</label
        >
        <input
          type="text"
          id="search_item"
          placeholder="e.g, garments"
          class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md search-input"
        />
      </div>
      <div class="flex items-end gap-3 flex-wrap sm:flex-nowrap">
        <div class="flex flex-col gap-1 flex-grow md:flex-1 w-100">
          <label for="barcode-2" class="text-gray-600 font-medium"
            >BarCode</label
          >
          <select
            name="search_barcode"
            id="search_barcode"
            data-search="barcode"
            class="w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 rounded-md search-input"

          >
            <option value="">Select</option>
            @foreach($search_barcodes as $item)
                <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex flex-col gap-1 flex-grow lg:flex-1 w-150">
          <label for="pic" class="text-gray-600 font-medium">PIC</label>
          <select
          name="search_pic"
          id="search_pic"
          class="w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 rounded-md search-input"
          data-search="item_code"

        >
          <option value="">Select</option>
          @foreach($search_pic as $item)
              <option value="{{ $item }}">{{ $item }}</option>
          @endforeach
        </select>

        </div>
        <div class="flex flex-col gap-1 flex-grow lg:flex-1 w-300">
          <label for="search_define_item" class="text-gray-600 font-medium"
            >Select Item</label
          >
          <select
            name="search_define_item"
            id="search_define_item"
            class="w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 rounded-md search-input"
            data-search="define_item_id"

          >
            <option value="">Select</option>
            @foreach($search_define_items as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex flex-col gap-1 flex-grow lg:flex-1 w-100">
          <label for="search_define_size" class="text-gray-600 font-medium"
            >Select Size</label
          >
          <select
            name="search_define_size"
            id="search_define_size"
            class="w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 rounded-md search-input"
            data-search="define_size_id"

          >
            <option value="">Select</option>
            @foreach($search_define_sizes as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex flex-col gap-1 flex-grow lg:flex-1 w-300">
          <label for="search_party" class="text-gray-600 font-medium"
            >Select Party</label
          >
          <select
            name="search_party"
            id="search_party"
            class="w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 rounded-md search-input"
            data-search="party_id"

          >
            <option value="">Select</option>
            @foreach($parties as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex flex-col gap-1 flex-grow lg:flex-1 w-100">
          <label for="p-rate-2" class="text-gray-600 font-medium"
            >P Rate</label
          >
              <select
              name="search_purchase_rate"
              id="search_purchase_rate"
              class="w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 rounded-md search-input"
              data-search="purchase_rate"

            >
            <option value="">Select</option>
              @foreach($search_purchase_rate as $item)
                  <option value="{{ $item }}">{{ $item }}</option>
              @endforeach
            </select>


        </div>
        <div class="flex gap-2 flex-grow lg:flex-1">
          <button
            class="flex items-center px-4 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
            onclick="reset_search()"
          >
            Reset
          </button>
        </div>
      </div>
    </from>
    <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end overflow-x-auto pb-3">
      <div class="flex-grow flex-shrink-0">
        <table class="table-auto w-full border-collapse border text-sm search_items">
          <thead class="bg-gray-50 text-gray-600 font-medium">
            <tr>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Sr #
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Barcode
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                PIC
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Item
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Size
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Party
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                P Rate
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                S Rate
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Desc
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                P Disc
              </th>
                <th class="border border-gray-200 px-4 py-2 text-left">
                    Margin
                </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                P Less
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                C Less
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                WholeSale P
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                P Rate %
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                R Rate
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                R Less
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                R Disc
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                R Profit
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                W Saleman Com
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                RS Comm
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Min Level
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Max Level
              </th>
              <th class="border border-gray-200 px-4 py-2 text-left">
                Status
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $key => $item)
                <tr>
                    <td class="border border-gray-200 px-4 py-2">{{ $key + 1 }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->barcode }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->item_code }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->define_item->name }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->define_size->name }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ optional($item->party)->name }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->purchase_rate }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->sale_rate }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->description }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->party_discount }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->margin_field }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->party_less }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->customer_less }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->wholesale_profit }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->retail_sale_rate_p }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->retail_less }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->retail_discount }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->retail_profit }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->w_sale_man_commension }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->r_sale_man_commension }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->min_level }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $item->max_level }}</td>
                    <td class="border border-gray-200 px-4 py-2">
                        @if($item->status == "true")
                            <span class="text-green-600 font-semibold">Active</span>
                        @else
                            <span class="text-red-600 font-semibold">Inactive</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

        </table>
      </div>
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'item-search-model')"
    >
      Close
    </button>
  </div>
</div>
</div>


<div
id="choose-item-model-1"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Define Item</h3>
    <div class="flex flex-col gap-1">
      <label id="item" class="text-gray-600 font-medium">Item</label>
      <input
        id="popup_item"
        placeholder="e.g, bevrly hills"
        class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-2 rounded-md"
        type="text"
      />
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'choose-item-model-1','define_size_id')"
    >
      Close
    </button>
    <button
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
      id="insert_item"
    >
      Save
    </button>
  </div>
</div>
</div>

<div
id="choose-item-model-2"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Define Size</h3>
    <div class="flex flex-col gap-1">
      <label id="size" class="text-gray-600 font-medium">Size</label>
      <input
        placeholder="enter size"
        class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-2 rounded-md"
        type="text"
        id="popup_size"
      />
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'choose-item-model-2','purchase_rate')"
    >
      Close
    </button>
    <button
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
      id="insert_size"
    >
      Save
    </button>
  </div>
</div>
</div>

<div
id="barcode-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">BarCode</h3>
    <div
      id="r-barcode"
      class="flex items-center justify-center gap-4 flex-col transition-colors hover:bg-indigo-50 w-full p-2 py-10 border-2 border-dashed border-indigo-300 rounded-xl"
    >

      @include("admin.inc.barcode")

      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <label for="q-single-2" class="text-gray-600">Single</label>
          <input
            type="radio"
            name="barcode_opt"

            id="q-single-2"
            value="single"
            class="accent-indigo-600 w-3 h-3"
          />
        </div>
        <div class="flex items-center gap-2">
          <label for="q-double-2" class="text-gray-600">Double</label>
          <input
            type="radio"
            name="barcode_opt"
            id="q-double-2"
            value="double"
            class="accent-indigo-600 w-3 h-3"
            checked=""
          />
        </div>
      </div>
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'barcode-model')"
    >
      Close
    </button>
    <button
      id="print_barcode"
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      Print
    </button>
  </div>
</div>
</div>



<div
id="retail-barcode-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Retail BarCode</h3>
    <div
      id="r-barcode"
      class="flex items-center justify-center gap-4 flex-col transition-colors hover:bg-indigo-50 w-full p-2 py-10 border-2 border-dashed border-indigo-300 rounded-xl"
    >

      @include("admin.inc.retail-barcode")

      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <label for="r-q-single-2" class="text-gray-600">Single</label>
          <input
            type="radio"
            name="retail_barcode_opt"

            id="r-q-single-2"
            value="single"
            class="accent-indigo-600 w-3 h-3"
          />
        </div>
        <div class="flex items-center gap-2">
          <label for="r-q-double-2" class="text-gray-600">Double</label>
          <input
            type="radio"
            name="retail_barcode_opt"
            id="r-q-double-2"
            value="double"
            class="accent-indigo-600 w-3 h-3"
            checked=""
          />
        </div>
      </div>
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'retail-barcode-model')"
    >
      Close
    </button>
    <button
      id="print_retail_barcode"
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      Print
    </button>
  </div>
</div>
</div>


<div
id="barcode-bulk-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">BarCode</h3>
    <div
      id="r-barcode"
      class="flex items-center justify-center gap-4 flex-col transition-colors hover:bg-indigo-50 w-full p-2 py-10 border-2 border-dashed border-indigo-300 rounded-xl"
    >

      <div id="barcode_wrapper"></div>


    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'barcode-bulk-model')"
    >
      Close
    </button>
    <button
      id="print_bulk_barcode"
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      Print
    </button>
  </div>
</div>
</div>





@endsection


@section('scripts')

<script src="{{ asset('assets/js/mult-select.min.js') }}"></script>

<script>
jQuery(document).ready(function() {
    jQuery('#retail_sale_rate').on('change', function() {
        var val = parseInt(jQuery(this).val());

       /* if (!isNaN(val)) {
            var rounded = 0;

            if (val < 100) {
                // Round to nearest 10
                rounded = Math.ceil(val / 10) * 10;
            } else {
                // Round to nearest 100
                rounded = Math.ceil(val / 100) * 100;
            }

            jQuery(this).val(rounded);
        }*/
    });
});
</script>

{{--<script>
jQuery(document).ready(function () {

    function getItemDetails(itemId) {
        return new Promise(function (resolve, reject) {
            jQuery.ajax({
                url: "{{ route('get.item.details') }}",
                method: "GET",
                data: { id: itemId },
                success: function (response) {
                    resolve(response);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching item:', error);
                    reject(error);
                }
            });
        });
    }

    function generateBarcodeHTML2(item, size, index) {

      let html = '';



        switch (size) {
            case "size_1":
                html += `
                <div class="barcode-image-section size_1 bq-inner-box">
                    <div class="barcode-item-wrapper">
                        <p class="barcode-item-description">
                            <span class="barcode_name">${item.name}</span> (${item.size})
                        </p>
                        <span class="barcode-image-main barcode-image-size">
                            <img src="{{ asset('assets/img/barcode_1.png') }}" class="barcode-img">
                            <span class="barcode-image-desc-left">
                                <h3 id="barcode_ptc">${item.code}</h3>
                            </span>
                            <span class="barcode-image-desc-right">
                                <h3>NNG <span>${item.sale_rate}</span></h3>
                            </span>
                            <span class="barcode-image-desc-bottom">
                                <h3>${item.barcode}</h3>
                            </span>
                        </span>
                    </div>
                </div>`;
                break;
            case "size_2":
                html += `
                <div class="qr-image-section size_2 bq-inner-box">
                    <div class="qr-item">
                        <p class="qr-description">
                            <span>${item.name}</span> (${item.size})
                        </p>
                        <h3 class="qr-code-text" id="barcode_ptc">${item.code}</h3>
                        <h3 class="qr-price">
                            <strong>NNG <span>${item.sale_rate}</span></strong>
                        </h3>
                        <img src="{{ asset('assets/img/qrcode_1.png') }}" class="qr-img">
                        <h3 class="qr-barcode">${item.barcode}</h3>
                    </div>
                </div>`;
                 break;
            case "size_3":
                html += `
               <div class="barcode-image-section size_3 bq-inner-box">
<div class="barcode-item">
  <p class="barcode-description">
    <span id="barcode_item">${item.name}</span>
    (<span id="barcode_size">${item.size}</span>)
  </p>

  <span class="barcode-image-main">
    <img src="{{ asset('assets/img/barcode_2.png') }}" alt="barcode" class="barcode-img">

    <span class="barcode-image-desc-left">
      <h3 id="barcode_ptc">${item.code}</h3>
    </span>

    <span class="barcode-image-desc-right">
      <h3 id="barcode_price">NNG <span id="barcode_sale_rate">${item.sale_rate}</span></h3>
    </span>

    <span class="barcode-image-desc-bottom">
      <h3 id="barcode_barcode">${item.barcode}</h3>
    </span>
  </span>
</div>
</div>`;
 break;
 case "size_4":
                html += `
               <div class="qr-image-section size_4 bq-inner-box">
<div class="qr-item">
  <p class="qr-title">
    <span id="barcode_item">${item.name}</span>
    (<span id="barocde_size">${item.size}</span>)
  </p>

  <h3 class="qr-code" id="barcode_ptc">${item.code}</h3>

  <h3 class="qr-price">
    <strong>NNG <br><span id="barcode_sale_rate">${item.sale_rate}</span></strong>
  </h3>

  <img src="{{ asset('assets/img/qrcode_2.png') }}" alt="qr" class="qr-image">

  <h3 class="qr-barcode" id="barcode_barcode">${item.barcode}</h3>
</div>
</div>`;


                break;
            // Add size_3 and size_4 if needed
        }

        return html;
    }


    function generateBarcodeHTML(item, size) {
        let html = '';
        switch (size) {
            case "size_1":
                html = `
                <div class="barcode-image-section size_1 bq-inner-box">
                    <div class="barcode-item-wrapper">
                        <p class="barcode-item-description">
                            <span class="barcode_name">${item.name}</span> (${item.size})
                        </p>
                        <span class="barcode-image-main barcode-image-size">
                            <img src="{{ asset('assets/img/barcode_1.png') }}" class="barcode-img">
                            <span class="barcode-image-desc-left">
                                <h3 id="barcode_ptc">${item.code}</h3>
                            </span>
                            <span class="barcode-image-desc-right">
                                <h3>NNG <span>${item.sale_rate}</span></h3>
                            </span>
                            <span class="barcode-image-desc-bottom">
                                <h3>${item.barcode}</h3>
                            </span>
                        </span>
                    </div>
                </div>`;
                break;
            case "size_2":
                html = `
                <div class="qr-image-section size_2 bq-inner-box">
                    <div class="qr-item">
                        <p class="qr-description">
                            <span>${item.name}</span> (${item.size})
                        </p>
                        <h3 class="qr-code-text" id="barcode_ptc">${item.code}</h3>
                        <h3 class="qr-price">
                            <strong>NNG <span>${item.sale_rate}</span></strong>
                        </h3>
                        <img src="{{ asset('assets/img/qrcode_1.png') }}" class="qr-img">
                        <h3 class="qr-barcode">${item.barcode}</h3>
                    </div>
                </div>`;
            case "size_3":
                html = `
               <div class="barcode-image-section size_3 bq-inner-box">
<div class="barcode-item">
  <p class="barcode-description">
    <span id="barcode_item">${item.name}</span>
    (<span id="barcode_size">${item.size}</span>)
  </p>

  <span class="barcode-image-main">
    <img src="{{ asset('assets/img/barcode_2.png') }}" alt="barcode" class="barcode-img">

    <span class="barcode-image-desc-left">
      <h3 id="barcode_ptc">${item.code}</h3>
    </span>

    <span class="barcode-image-desc-right">
      <h3 id="barcode_price">NNG <span id="barcode_sale_rate">${item.sale_rate}</span></h3>
    </span>

    <span class="barcode-image-desc-bottom">
      <h3 id="barcode_barcode">${item.barcode}</h3>
    </span>
  </span>
</div>
</div>`;
 case "size_4":
                html = `
               <div class="qr-image-section size_4 bq-inner-box">
<div class="qr-item">
  <p class="qr-title">
    <span id="barcode_item">${item.name}</span>
    (<span id="barocde_size">${item.size}</span>)
  </p>

  <h3 class="qr-code" id="barcode_ptc">${item.code}</h3>

  <h3 class="qr-price">
    <strong>NNG <br><span id="barcode_sale_rate">${item.sale_rate}</span></strong>
  </h3>

  <img src="{{ asset('assets/img/qrcode_2.png') }}" alt="qr" class="qr-image">

  <h3 class="qr-barcode" id="barcode_barcode">${item.barcode}</h3>
</div>
</div>`;


                break;
            // Add size_3 and size_4 if needed
        }

        return html;
    }

    async function renderBarcodes(itemIds, itemQtys) {
        let size = "{{ $setting->barcode }}";
        jQuery('#barcode_wrapper').html(''); // Clear
        showLoader(); // ⬅️ Show global loader
        var bulk_type = jQuery('input[name="bulk_type"]:checked').val();

        for (let index = 0; index < itemIds.length; index++) {
            let itemId = itemIds[index];
            let qty = parseInt(itemQtys[index]);

            let item = await getItemDetails(itemId); // Waits for item details in order


        if(bulk_type == "bulk_double"){

           for (let i = 0; i < qty; i += 2) {
                let html = `<div style="margin-left: 0.1cm; margin-top: 0.01cm; display: flex; gap: 0.3cm;">`;

                html += generateBarcodeHTML2(item, size, i);

                // Duplicate the item logic if the second exists
                if (i + 1 < qty) {
                    html += generateBarcodeHTML2(item, size, i + 1);
                }

                html += `</div>`;

                jQuery('#barcode_wrapper').append(html);
            }

        }else{

            for (let i = 0; i < qty; i++) {


                let html = generateBarcodeHTML2(item, size,i);
                jQuery('#barcode_wrapper').append(html);
            }
        }

        }

            hideLoader(); // ⬅️ Hide loader after all done

        if(jQuery('input[name="bulk_status"]:checked').val() == "bulk_print"){
            $("#print_bulk_barcode").click();
        }else{
            openModal(event, 'barcode-bulk-model');
        }

    }


    // Example trigger
    jQuery('#generate_barcode').on('click', function () {
        let itemIds = [];
        let itemQtys = [];

        jQuery('.item-id').each(function () {
            itemIds.push(jQuery(this).val());
        });

        jQuery('.item-qty').each(function () {
            itemQtys.push(jQuery(this).val());
        });

        console.log("---");
        console.log(itemIds);
        console.log(itemQtys);

        renderBarcodes(itemIds, itemQtys);
    });
});



    jQuery('#print_bulk_barcode').on('click', function () {

          var option = 'double'
          var $content = jQuery('#barcode_wrapper');

          if (!option || $content.length === 0) {
              alert("Please make sure a barcode option is selected and content exists.");
              return;
          }

          var printWindow = window.open('', '_blank');
          printWindow.document.write('<html><head><title>Print Barcode</title>');

          // Include external stylesheet
          printWindow.document.write('<link rel="stylesheet" href="{{ asset('assets/css/barcode.css?v=4') }}" type="text/css">');
          printWindow.document.write('<style>body{margin:0;padding:0;font-family:sans-serif;}.qr-item{ margin-left: 0px !important; }.qr-title { margin-top: 0px;}blockquote, dl, dd, h1, h2, h3, h4, h5, h6, hr, figure, p, pre { margin: 0;}</style>');
          printWindow.document.write('</head><body>');

          if (option === 'single') {
              printWindow.document.write($content.prop('outerHTML'));
          } else if (option === 'double') {
              var html = $content.prop('outerHTML');
              printWindow.document.write(html);
          }

          printWindow.document.write('</body></html>');
          printWindow.document.close();
          printWindow.focus();

          // Delay printing slightly to ensure styles are loaded
          setTimeout(function() {
              printWindow.print();
              // Don't close it automatically
              // printWindow.close();
          }, 500);

  });
</script>--}}

<script>

    jQuery(document).ready(function () {

        function getItemDetails(itemId) {
            return new Promise(function (resolve, reject) {
                jQuery.ajax({
                    url: "{{ route('get.item.details.pur') }}",
                    method: "GET",
                    data: { id: itemId },
                    success: function (response) {
                        resolve(response);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching item:', error);
                        reject(error);
                    }
                });
            });
        }

        function generateBarcodeHTML2(item, size, index) {
            let html = '';
            switch (size) {
                case "size_1":
                    html += `
                <div class="barcode-image-section size_1 bq-inner-box">
                    <div class="barcode-item-wrapper">
                        <p class="barcode-item-description">
                            <span class="barcode_name">${item.name}</span> (${item.size})
                        </p>
                        <span class="barcode-image-main barcode-image-size">

                             <img src="{{ asset('assets/img/barcode_1.png') }}" class="barcode-img">
                            <span class="barcode-image-desc-left">
                                <h3 id="barcode_ptc">${item.code}</h3>
                            </span>
                            <span class="barcode-image-desc-right">
                                <h3>NNG <span>${item.sale_rate}</span></h3>
                            </span>
                            <span class="barcode-image-desc-bottom">
                                <h3>${item.barcode}</h3>
                            </span>
                        </span>
                    </div>
                </div>`;
                    break;
                case "size_2":
                    /*<img src="" class="qr-img">*/

                    html += `
                <div class="qr-image-section size_2 bq-inner-box">
                    <div class="qr-item">
                        <p class="qr-description">
                            <span>${item.item_name}</span> (${item.size})
                        </p>
                        <h3 class="qr-code-text" id="barcode_ptc">${item.barcode}</h3>
                        <h3 class="qr-price">
                            <strong>NNG <span>${item.sale_rate}</span></strong>
                        </h3>
                        <img src="{{ asset('assets/img/qrcode_1.png') }}" class="qr-img">
                        <h3 class="qr-barcode">${item.barcode}</h3>
                    </div>
                </div>`;
                    break;
                case "size_3":
                    html += `
               <div class="barcode-image-section size_3 bq-inner-box">
<div class="barcode-item">
  <p class="barcode-description">
    <span id="barcode_item">${item.name}</span>
    (<span id="barcode_size">${item.size}</span>)
  </p>

  <span class="barcode-image-main">
    <img src="{{ asset('assets/img/barcode_2.png') }}" alt="barcode" class="barcode-img">

    <span class="barcode-image-desc-left">
      <h3 id="barcode_ptc">${item.code}</h3>
    </span>

    <span class="barcode-image-desc-right">
      <h3 id="barcode_price">NNG <span id="barcode_sale_rate">${item.sale_rate}</span></h3>
    </span>

    <span class="barcode-image-desc-bottom">
      <h3 id="barcode_barcode">${item.barcode}</h3>
    </span>
  </span>
</div>
</div>`;
                    break;
                case "size_4":
                    let qrId = "qr_" + item.barcode;
                    let str = item.item_name;
                    let parts = str.split("-");
                    let name = parts[1] + "-" + parts[2];
                    //console.log(name);
                    html += `
               <div class="qr-image-section size_4 bq-inner-box">
<div class="qr-item">
  <p class="qr-title">
    <span id="barcode_item">${name}</span>
    (<span id="barocde_size">${item.size}</span>)
  </p>

  <h3 class="qr-code" id="barcode_ptc">${item.code}</h3>





<h3 class="qr-price">
    <strong>NNG <br><span id="barcode_sale_rate">${item.sale_rate}</span></strong>
  </h3>

<span id="${qrId}" class="qr-img" ></span>

  <h3 class="qr-barcode" id="barcode_barcode">${item.barcode}</h3>


</div>
</div>`;

                    break;
            }

            return html;
        }


        function generateBarcodeHTML(item, size) {
            let html = '';
            switch (size) {
                case "size_1":
                    html = `
                <div class="barcode-image-section size_1 bq-inner-box">
                    <div class="barcode-item-wrapper">
                        <p class="barcode-item-description">
                            <span class="barcode_name">${item.name}</span> (${item.size})
                        </p>
                        <span class="barcode-image-main barcode-image-size">
                            <img src="{{ asset('assets/img/barcode_1.png') }}" class="barcode-img">
                            <span class="barcode-image-desc-left">
                                <h3 id="barcode_ptc">${item.code}</h3>
                            </span>
                            <span class="barcode-image-desc-right">
                                <h3>NNG <span>${item.sale_rate}</span></h3>
                            </span>
                            <span class="barcode-image-desc-bottom">
                                <h3>${item.barcode}</h3>
                            </span>
                        </span>
                    </div>
                </div>`;
                    break;
                case "size_2":
                    html = `
                <div class="qr-image-section size_2 bq-inner-box">
                    <div class="qr-item">
                        <p class="qr-description">
                            <span>${item.name}</span> (${item.size})
                        </p>
                        <h3 class="qr-code-text" id="barcode_ptc">${item.code}</h3>
                        <h3 class="qr-price">
                            <strong>NNG <span>${item.sale_rate}</span></strong>
                        </h3>
                        <img src="{{ asset('assets/img/qrcode_1.png') }}" class="qr-img">
                        <h3 class="qr-barcode">${item.barcode}</h3>
                    </div>
                </div>`;
                case "size_3":
                    html = `
               <div class="barcode-image-section size_3 bq-inner-box">
<div class="barcode-item">
  <p class="barcode-description">
    <span id="barcode_item">${item.name}</span>
    (<span id="barcode_size">${item.size}</span>)
  </p>

  <span class="barcode-image-main">
    <img src="{{ asset('assets/img/barcode_2.png') }}" alt="barcode" class="barcode-img">

    <span class="barcode-image-desc-left">
      <h3 id="barcode_ptc">${item.code}</h3>
    </span>

    <span class="barcode-image-desc-right">
      <h3 id="barcode_price">NNG <span id="barcode_sale_rate">${item.sale_rate}</span></h3>
    </span>

    <span class="barcode-image-desc-bottom">
      <h3 id="barcode_barcode">${item.barcode}</h3>
    </span>
  </span>
</div>
</div>`;
                case "size_4":
                    html = `
               <div class="qr-image-section size_4 bq-inner-box">
<div class="qr-item">
  <p class="qr-title">
    <span id="barcode_item">${item.name}</span>
    (<span id="barocde_size">${item.size}</span>)
  </p>

  <h3 class="qr-code" id="barcode_ptc">${item.code}</h3>

  <h3 class="qr-price">
    <strong>NNG <br><span id="barcode_sale_rate">${item.sale_rate}</span></strong>
  </h3>

  <img src="{{ asset('assets/img/qrcode_2.png') }}" alt="qr" class="qr-image">

  <h3 class="qr-barcode" id="barcode_barcode">${item.barcode}</h3>
</div>
</div>`;


                    break;
                // Add size_3 and size_4 if needed
            }

            return html;
        }

        async function renderBarcodes(itemIds, itemQtys) {
            let size = "{{ $setting->barcode }}";
            jQuery('#barcode_wrapper').html(''); // Clear
            showLoader(); // ⬅️ Show global loader
            var bulk_type = jQuery('input[name="bulk_type"]:checked').val();

            for (let index = 0; index < itemIds.length; index++) {
                let itemId = itemIds[index];
                let qty = parseInt(itemQtys[index]);

                let item = await getItemDetails(itemId); // Waits for item details in order


                if(bulk_type == "bulk_double"){

                    for (let i = 0; i < qty; i += 2) {
                        let html = `<div style="margin-left: 0.1cm; margin-top: 0.01cm; display: flex; gap: 0.3cm;">`;

                        html += generateBarcodeHTML2(item, size, i);

                        // Duplicate the item logic if the second exists
                        if (i + 1 < qty) {
                            html += generateBarcodeHTML2(item, size, i + 1);
                        }

                        html += `</div>`;

                        jQuery('#barcode_wrapper').append(html);


                    }

                }else{

                    for (let i = 0; i < qty; i++) {


                        let html = generateBarcodeHTML2(item, size,i);
                        jQuery('#barcode_wrapper').append(html);
                    }
                }

            }

            hideLoader(); // ⬅️ Hide loader after all done

            if(jQuery('input[name="bulk_status"]:checked').val() == "bulk_print"){
                $("#print_bulk_barcode").click();
            }else{
                openModal(event, 'barcode-bulk-model');
            }

        }


        // Example trigger
        jQuery('#generate_barcode').on('click', function () {
            let itemIds = [];
            let itemQtys = [];

            jQuery('.item-id').each(function () {
                itemIds.push(jQuery(this).val());
            });

            jQuery('.item-qty').each(function () {
                itemQtys.push(jQuery(this).val());
            });

            console.log("---");
            console.log(itemIds);
            console.log(itemQtys);

            renderBarcodes(itemIds, itemQtys);
        });
    });



    jQuery('#print_bulk_barcode').on('click', function () {

        var option = 'double'
        var $content = jQuery('#barcode_wrapper');

        if (!option || $content.length === 0) {
            alert("Please make sure a barcode option is selected and content exists.");
            return;
        }
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Barcode</title>');

        printWindow.document.write('<link rel="stylesheet" href="{{ asset('assets/css/barcode.css?v=4') }}" type="text/css">');
        printWindow.document.write('<style>body{margin:0px, 0px, 0px, 8px;padding:0;font-family:sans-serif;}.qr-item{ margin-left: 0px !important; }.qr-title { margin-top: 0px;}blockquote, dl, dd, h1, h2, h3, h4, h5, h6, hr, figure, p, pre { margin: 0;}.qr-img {position: absolute;margin-top: -47px;margin-left: 55px;}.size_4 .qr-barcode{position: absolute !important;left: 70% !important;bottom: 35px !important;font-weight: bolder !important;font-size: 13px !important;margin-bottom: 0 !important;writing-mode: vertical-lr !important;transform: rotate(180deg) !important;} </style>');

        printWindow.document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"><\/script>');

        printWindow.document.write('</head><body>');

        if (option === 'single') {
            printWindow.document.write($content.prop('outerHTML'));
        } else if (option === 'double') {
            var html = $content.prop('outerHTML');
            printWindow.document.write(html);
        }
        printWindow.document.write(`
                <script>
                     window.onload = function() {
                        document.querySelectorAll(".qr-img").forEach(function(div) {
                        let text = div.closest(".qr-item").querySelector(".qr-barcode").innerText;
                        new QRCode(div, { text: text, width: 40, height: 40 });
                        });
                    };
                <\/script>
            `);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();

        setTimeout(function() {
            printWindow.print();
        }, 500);

    });

</script>


<!-- html2canvas required by jsPDF html() -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- jsPDF with html plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>




<script>
  jQuery(document).ready(function() {

// jQuery('#print_barcode').on('click', function () {
//     const option = jQuery('input[name="barcode_opt"]:checked').val() || 'single';
//     const $original = jQuery('.bq-inner-box');

//     var width,height;

//     @if($setting->barcode == "size_1" || $setting->barcode == "size_2")
//         width = 2;
//         height= 1;
//     @else
//         width = 1.5;
//         height= 1;
//     @endif

//     if ($original.length === 0) {
//         alert("Please make sure content exists.");
//         return;
//     }

//     // Correct margin and layout only for 'double'
//     let $wrapper;
//     if (option === 'double') {
//         $wrapper = $('<div>').css({
//             marginLeft: '0.1cm',
//             marginTop: '0.01cm',
//             display: 'flex',
//             gap: '0.3cm'
//         });
//         $wrapper.append($original.clone(), $original.clone());

//         width = width*2;

//     } else {
//         $wrapper = $('<div>').append($original.clone());
//     }

//     // Append and print
//     $wrapper.appendTo('body').printThis({
//         importCSS: true,
//         importStyle: true,
//         loadCSS: "{{ asset('assets/css/barcode.css?v=4') }}",
//         pageTitle: "Print Barcode",
//         afterPrint: function () {
//             $wrapper.remove();
//         },
//         printDelay: 500,
//         header: `
//           <style>
//             @page { size: ${width}in ${height}in; margin: 0; }
//             body { margin: 0; padding: 0; font-family: sans-serif; }
//           </style>
//         `
//     });
// });



      jQuery('#print_barcode').on('click', function() {
          var option = jQuery('input[name="barcode_opt"]:checked').val();
          var $content = jQuery('.bq-inner-box');

            // Dynamic size in inches
            var widthInInches = 3.10;
            var heightInInches = 1.10;

          if (!option || $content.length === 0) {
              alert("Please make sure a barcode option is selected and content exists.");
              return;
          }

          var printWindow = window.open('', '_blank');
          printWindow.document.write('<html><head><title>Print Barcode</title>');

          // Include external stylesheet
          printWindow.document.write('<link rel="stylesheet" href="{{ asset('assets/css/barcode.css?v=4') }}" type="text/css">');
          printWindow.document.write('<style> @page { size: 3.10in 1.1in portrait; margin: 0; }body{margin:0;padding:0;font-family:sans-serif;}.qr-item{ margin-left: 0px !important; }.qr-title { margin-top: 0px;}blockquote, dl, dd, h1, h2, h3, h4, h5, h6, hr, figure, p, pre { margin: 0;}</style>');
          printWindow.document.write('</head><body>');

          if (option === 'single') {
              printWindow.document.write($content.prop('outerHTML'));
          } else if (option === 'double') {
              var html =
                  '<div style="margin-left: 0.1cm; margin-top: 0.01cm; display: flex; gap: 0.3cm;">' +
                  $content.prop('outerHTML') +
                  $content.prop('outerHTML') +
                  '</div>';
              printWindow.document.write(html);
          }

          printWindow.document.write('</body></html>');
          printWindow.document.close();
          printWindow.focus();

          // Delay printing slightly to ensure styles are loaded
          setTimeout(function() {
              printWindow.print();
              // Don't close it automatically
              // printWindow.close();
          }, 500);
      });


        jQuery('#print_retail_barcode').on('click', function() {
          var option = jQuery('input[name="retail_barcode_opt"]:checked').val();
          var $content = jQuery('.r-bq-inner-box');

          if (!option || $content.length === 0) {
              alert("Please make sure a barcode option is selected and content exists.");
              return;
          }

          var printWindow = window.open('', '_blank');
          printWindow.document.write('<html><head><title>Print Barcode</title>');

          // Include external stylesheet
          printWindow.document.write('<link rel="stylesheet" href="{{ asset('assets/css/barcode.css?v=4') }}" type="text/css">');
          printWindow.document.write('<style>body{margin:0;padding:0;font-family:sans-serif;}.qr-item{ margin-left: 0px !important; }.qr-title { margin-top: 0px;}blockquote, dl, dd, h1, h2, h3, h4, h5, h6, hr, figure, p, pre { margin: 0;}</style>');
          printWindow.document.write('</head><body>');

          if (option === 'single') {
              printWindow.document.write($content.prop('outerHTML'));
          } else if (option === 'double') {
              var html =
                  '<div style="margin-left: 0.1cm; margin-top: 0.01cm; display: flex; gap: 0.3cm;">' +
                  $content.prop('outerHTML') +
                  $content.prop('outerHTML') +
                  '</div>';
              printWindow.document.write(html);
          }

          printWindow.document.write('</body></html>');
          printWindow.document.close();
          printWindow.focus();

          // Delay printing slightly to ensure styles are loaded
          setTimeout(function() {
              printWindow.print();
              // Don't close it automatically
              // printWindow.close();
          }, 500);
      });


  });
  </script>




<script>

var party_discount_total = 0;


function changeBarcode(){
        $("#barcode_item").text($("#define_item_id")[0].selectize.getItem($("#define_item_id").val()).text());
        $("#barcode_size").text($("#define_size_id")[0].selectize.getItem($("#define_size_id").val()).text());

        $("#barcode_ptc").text($("#item_code")[0].selectize.getItem($("#item_code").val()).text());

        $("#barcode_barcode").text($("#barcode").val());
        $("#barcode_sale_rate").text($("#sale_rate").val());


        $("#r_barcode_item").text($("#define_item_id")[0].selectize.getItem($("#define_item_id").val()).text());
        $("#r_barcode_size").text($("#define_size_id")[0].selectize.getItem($("#define_size_id").val()).text());

        $("#r_barcode_ptc").text($("#item_code")[0].selectize.getItem($("#item_code").val()).text());

        $("#r_barcode_barcode").text($("#barcode").val());
        //$("#r_barcode_sale_rate").text($("#sale_rate").val());
        //changeWholeSale();

        // $("#barcode_item2").text($("#item option:selected").text());

        // if($("#party_item_code").val() != ""){
        //     $("#barcode_ptc2").text($("#party_item_code option:selected").text());
        // }else{
        //     $("#barcode_ptc2").text("");
        // }

        // $("#barcode_barcode2").text($("#barcode").val());
        // $("#barcode_size2").text($("#size option:selected").text());
}



$(document).ready(function () {
    $('#item-search-model select').selectize();
});

jQuery('input[type="radio"][name="status"]').on('change', function() {
  calculateTotalPieces();
});


jQuery(document).ready(function() {
    jQuery('#cash_amount, #bank_amount, #cheque_amount, #bt_amount').on('input', function() {
        var cash = parseFloat(jQuery('#cash_amount').val()) || 0;
        var bank = parseFloat(jQuery('#bank_amount').val()) || 0;
        var cheque = parseFloat(jQuery('#cheque_amount').val()) || 0;
        var bt_amount = parseFloat(jQuery('#bt_amount').val()) || 0;

        var total = cash + bank + cheque + bt_amount;
        jQuery('#payment_total_amount').val(total.toFixed(3));


        changeBarcode();
    });

    jQuery('#insert_payment_method').on('click', function() {
        var totalAmount = jQuery('#payment_total_amount').val() || 0;
        jQuery('#paid_amount').val(totalAmount);
        calcTable();
        closeModal(event, 'payment-method-model')
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Get all nav links and payment fields
    let paymentLinks = document.querySelectorAll(".payment-method");
    let paymentFields = document.querySelectorAll(".payment-field");

    // Function to show selected payment method
    function showPaymentMethod(method) {
        // Hide all payment fields
        paymentFields.forEach(field => field.style.display = "none");

        // Show selected payment field
        let selectedField = document.querySelector(`.payment-field.${method}`);
        if (selectedField) {
            selectedField.style.display = "block";
        }

        // Remove 'active' class from all tabs
        paymentLinks.forEach(link => link.classList.remove("active"));

        // Add 'active' class to the clicked tab
        document.querySelector(`[data-payment-method="${method}"]`).classList.add("active");
    }

    // Add click event to each payment method tab
    paymentLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            let method = this.getAttribute("data-payment-method");
            showPaymentMethod(method);
        });
    });

    // Initialize by showing the default active tab
    let defaultMethod = document.querySelector(".payment-method.active").getAttribute("data-payment-method");
    showPaymentMethod(defaultMethod);
});


$(document).ready(function () {

    function item_search(currentField){
      let searchParams = {
            search_item: $('#search_item').val(),
            search_barcode: $('#search_barcode')[0].selectize.getValue() || '',
            search_pic: $('#search_pic')[0].selectize.getValue() || '',
            search_define_item: $('#search_define_item')[0].selectize.getValue() || '',
            search_define_size: $('#search_define_size')[0].selectize.getValue() || '',
            search_party: $('#search_party')[0].selectize.getValue() || '',
            search_purchase_rate: $('#search_purchase_rate')[0].selectize.getValue() || '',
            search_column: currentField.data("search"),
            search_value: currentField.val()
        };

        $.ajax({
            url: "{{ route('items.search') }}", // Define this route in Laravel
            method: "GET",
            data: searchParams,
            success: function (response) {
              loadTable(response.items);


              var dropdown_data = response.dropdown_data;

              // Get all non-empty data-search values
              var nonEmptySearches = [];

              $("select.search-input").each(function () {
                  var selectizeInstance = $(this)[0].selectize;
                  if (selectizeInstance && selectizeInstance.getValue()) {
                      nonEmptySearches.push($(this).attr("data-search"));
                  }
              });


              $("select.search-input").each(function () {
                  if (!nonEmptySearches.includes($(this).attr("data-search"))) {
                    if ($(this).attr("data-search") !== undefined) {

                      console.log($(this).attr("data-search"));
                      updateDropdown($(this), dropdown_data[$(this).attr("data-search")]);

                      // return;
                    }
                  }
              });

            }

        });
    }


    $('input.search-input, select.search-input').on('input', function () {

        let currentField = $(this);
        item_search(currentField);

        changeBarcode();

    });


    function updateDropdown($dropdown, data) {
    let selectizeInstance = $dropdown[0].selectize;


    if (!selectizeInstance) return; // Ensure Selectize is initialized

    let selectedValues = selectizeInstance.getValue(); // Store selected values

    selectizeInstance.clearOptions(); // Remove all existing options except selected ones

    if (data && data.length > 0) {
        data.forEach(item => {
            selectizeInstance.addOption({ value: item.id, text: item.name });
        });

        // Ensure Selectize has rendered the options before restoring values
        selectizeInstance.refreshOptions(false);

        // Remove only non-existing selected values
        // selectedValues = selectedValues.filter(value => selectizeInstance.options[value]);

        // Restore selected values that still exist
        if(selectedValues != ""){
          $dropdown[0].selectize.setValue(selectedValues, true);
        }

    }

}

    function loadTable(items) {
            let tableBody = $('.search_items tbody');
            tableBody.empty(); // Clear previous results

            if (items.length === 0) {
                tableBody.append('<tr><td colspan="16" class="text-center text-gray-500 py-4">No items found</td></tr>');
                return;
            }

            $.each(items, function (index, item) {
                let row = `
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">${index + 1}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.barcode}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.item_code}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.define_item.name}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.define_size.name}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.party ? item.party.name : 'N/A'}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.purchase_rate}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.sale_rate}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.description}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.party_discount}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.margin_field}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.party_less}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.customer_less}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.wholesale_profit}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.retail_sale_rate_p}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.retail_sale_rate}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.retail_less}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.retail_discount}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.retail_profit}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.w_sale_man_commension}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.r_sale_man_commension}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.min_level}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.max_level}</td>
                        <td class="border border-gray-200 px-4 py-2">${item.status === "true" ? '<span class="text-green-600 font-semibold">Active</span>' : '<span class="text-red-600 font-semibold">Inactive</span>'}</td>
                    </tr>
                `;
                tableBody.append(row);
            });
        }


    });

$(".c-field").on("input", function() {
    this.value = this.value.replace(/[^0-9+\-*/().\s]/g, "");
});

jQuery(document).ready(function() {
    jQuery(document).on("keydown", function(event) {
        if (event.which === 13) { // Enter key
            event.preventDefault(); // Prevent default form submission

            var focusable = jQuery("button#list_data, input:not([type='radio']), select, textarea, [tabindex]:not([tabindex='-1'])")
                .filter(":visible:not([disabled]):not([readonly])"); // Get all focusable elements

            var activeElement = jQuery(document.activeElement); // Get the currently focused element
            var index = focusable.index(activeElement);

            if (activeElement.is("#id")) {
                jQuery("#packet_qty").focus();
                return;
            }

            // var itemCodeSelectize = $("#item_code")[0].selectize;

            // if (activeElement.is(itemCodeSelectize.$control_input)) {
            //     jQuery("#packet_qty").focus();
            //     return;
            // }

            if (activeElement.hasClass("c-field")) {
                var expression = activeElement.val().trim();


                // Check if the input contains only valid mathematical characters
                if (/^[\d+\-*/().\s]+$/.test(expression)) {
                    try {
                        var result = eval(expression); // Evaluate the expression
                        if (!isNaN(result)) {
                            activeElement.val(result); // Replace input with the calculated value
                            calcProfit();
                            changeWholeSale();
                        }
                    } catch (error) {
                        console.error("Invalid expression", error);
                    }
                }
            }

            if (index > -1) {
                var nextIndex = index + 1;

                // Skip specific IDs
                while (nextIndex < focusable.length && jQuery(focusable[nextIndex]).is("#barcode, #description, #party_discount, #party_less, #customer_less, #profit, #total_pieces, input[type='radio'],#reset_btn,#save_btn,#print_btn")) {
                    nextIndex++;
                }

                // If reached end or next focusable is the list_data button, focus on list_data
                focusable.eq(nextIndex).focus();
            }
        }
    });
});




jQuery(document).ready(function() {

  $("#retail_sale_rate_p").trigger("input");
  $("#party_name")[0].selectize.focus();

});


$(".c_selectize").selectize({
    create: true,
    maxItems: 1,
});

let isSyncing = false;

function syncPartyId(source, targetId) {
    //window.alert(targetId);
  if (isSyncing) return;
    isSyncing = true;
    const target = document.getElementById(targetId);
    //window.alert(target.tagName);
    if(target.tagName === "SELECT"){
      $("#"+targetId)[0].selectize.setValue(source.value);
      $("#party_name2")[0].selectize.setValue(source.value);
      document.getElementById('party_id2').value = source.value;
    }else{
      target.value = source.value;
      $("#party_name2")[0].selectize.setValue(source.value);
        document.getElementById('party_id2').value = source.value;
    }

    if(source.value != ""){
      get_item_codes(source.value);
        get_id_party(source.value);
        //window.alert(targetId+'2');


        //target.value = source.value;

    }
    isSyncing = false;
}
function syncPartyId2(source, targetId) {
    //window.alert(targetId);
    if (isSyncing) return;
    isSyncing = true;
    const target = document.getElementById(targetId);
    //window.alert(target.tagName);
    if(target.tagName === "SELECT"){
        $("#"+targetId)[0].selectize.setValue(source.value);
    }else{
        target.value = source.value;
    }
    if(source.value != ""){
        get_item_codes2(source.value);

    }
    isSyncing = false;
}
function reset_search(){
      $('#search_item').val('');
      $('#search_barcode')[0].selectize.clear();
      $('#search_pic')[0].selectize.clear();
      $('#search_define_item')[0].selectize.clear();
      $('#search_define_size')[0].selectize.clear();
      $('#search_party')[0].selectize.clear();
      $('#search_purchase_rate')[0].selectize.clear();
      $("#search_item").trigger("input");
}

var retail_sale_rate_p = <?php echo $setting->retail_sale_rate  ?> ;

function reset_item(){
        jQuery.get("{{ route('item.latest_id') }}", function(data) {
            var get_latest_id = parseInt(data) + 1;
            $("#id").val(get_latest_id);
            $("#barcode").val(get_latest_id);
        });
        $("#party_id").val("");
        $("#party_name")[0].selectize.setValue("");
        $("#party_name")[0].selectize.setValue("");
        $("#party_name")[0].selectize.setValue("");
        $("#define_item_id")[0].selectize.setValue("");
        $("#item_code")[0].selectize.setValue("");
        $("#define_size_id")[0].selectize.setValue("");
        $('#profit').val('');
        $('#party_discount').val('');
        $('#margin_field').val('0');
        $('#description').val('');
        $('#purchase_rate').val('');
        $('#sale_rate').val('');
        $('#party_less').val('');
        $('#customer_less').val('');
        $('#wholesale_profit').val('');
        $('#packet_qty').val('');
        $('#pieces_in_packet').val('');
        $('#total_pieces').val('');
        $('#retail_sale_rate').val('');
        $('#retail_less').val('');
        $('#retail_discount').val('');
        $('#min_level').val('');
        $('#max_level').val('');
        $('#w_sale_man_commension').val('');
        $('#r_sale_man_commension').val('');
        $("#party_name")[0].selectize.focus();
        $("#date").val('<?php echo date("Y-m-d"); ?>');
        $('#item_code')[0].selectize.clearOptions();
        $("#save").text("Save");

        $('#retail_less').val('');
        $('#retail_discount').val('');
        $('#retail_profit').val('');
        $('#min_level').val('');
        $('#max_level').val('');
        $('#w_sale_man_commension').val('');
        $('#r_sale_man_commension').val('');
        $("#popup_item").val('');
        $("#popup_size").val('');

        $('#retail_sale_rate_p').val(retail_sale_rate_p).trigger("input");

        $('#active').prop('checked', true);
        $('#id')[0].style.setProperty('border-color', '#aaa', 'important');
        $('#barcode')[0].style.setProperty('border-color', '#aaa', 'important');
        $('#description')[0].style.setProperty('border-color', '#aaa', 'important');

        changeBarcode();
    }

function reset_item_list(){
    jQuery.get("{{ route('item.latest_id') }}", function(data) {
        var get_latest_id = parseInt(data) + 1;
        $("#id").val(get_latest_id);
        $("#barcode").val(get_latest_id);
    });
    /*var partyId = $("#party_id").val();
    get_item_codes(partyId);*/
    //$("#party_id").val("");
    //$("#party_name")[0].selectize.setValue("");
    //$("#party_name")[0].selectize.setValue("");
    //$("#party_name")[0].selectize.setValue("");
    $("#define_item_id")[0].selectize.setValue("");
    $("#item_code")[0].selectize.setValue("");
    var partyId = $("#party_id").val();
    get_item_codes(partyId);
    $("#define_size_id")[0].selectize.setValue("");
    $('#profit').val('');
    //$('#party_discount').val('');
    $('#margin_field').val('0');
    $('#description').val('');
    $('#purchase_rate').val('');
    $('#sale_rate').val('');
    //$('#party_less').val('');
    $('#customer_less').val('');
    $('#wholesale_profit').val('');
    $('#packet_qty').val('');
    $('#pieces_in_packet').val('');
    $('#total_pieces').val('');
    $('#retail_sale_rate').val('');
    $('#retail_less').val('');
    $('#retail_discount').val('');
    $('#min_level').val('');
    $('#max_level').val('');
    $('#w_sale_man_commension').val('');
    $('#r_sale_man_commension').val('');
    $("#item_code")[0].selectize.focus();
    $("#date").val('<?php echo date("Y-m-d"); ?>');
    $('#item_code')[0].selectize.clearOptions();
    $("#save").text("Save");

    $('#retail_less').val('');
    $('#retail_discount').val('');
    $('#retail_profit').val('');
    $('#min_level').val('');
    $('#max_level').val('');
    $('#w_sale_man_commension').val('');
    $('#r_sale_man_commension').val('');
    $("#popup_item").val('');
    $("#popup_size").val('');

    $('#retail_sale_rate_p').val(retail_sale_rate_p).trigger("input");

    $('#active').prop('checked', true);
    $('#id')[0].style.setProperty('border-color', '#aaa', 'important');
    $('#barcode')[0].style.setProperty('border-color', '#aaa', 'important');
    $('#description')[0].style.setProperty('border-color', '#aaa', 'important');

    changeBarcode();
}

function calculateTotalPieces() {
      var packetQtyInput = document.getElementById("packet_qty");
      var piecesInPacketInput = document.getElementById("pieces_in_packet");
      var totalPiecesInput = document.getElementById("total_pieces");
      var packetQty = parseInt(packetQtyInput.value);
      var piecesInPacket = parseInt(piecesInPacketInput.value);
      var totalPieces = packetQty * piecesInPacket;

      if (!isNaN(piecesInPacket) && $('input[name="status"]:checked').val() == "active") {
          $("#list_data").removeClass("disabled");
      } else {
          $("#list_data").addClass("disabled");
      }

      if (!isNaN(totalPieces)) {
          totalPiecesInput.value = totalPieces;
      } else {
          totalPiecesInput.value = "";
      }
      generateDescription();
}

function calcProfit(){
    var purchase_rate = $("#purchase_rate").val();
    var sale_rate = $("#sale_rate").val();
    var margin_field = parseInt($("#margin_field").val());
    var profit_perc = ((sale_rate - purchase_rate) / purchase_rate) * 100;
    var profit_val = sale_rate - purchase_rate;
    var party_discount = parseInt($("#party_discount").val());
    var party_less = parseInt($("#party_less").val());
    var customer_less = parseInt($("#customer_less").val());
    var w_sale_man_commension = parseInt($("#w_sale_man_commension").val());

    //window.alert(margin_field);
    /*if (!isNaN(margin_field)) {
        profit_perc += margin_field;
        profit_val += (margin_field / 100) * purchase_rate;
    }*/
    if (!isNaN(party_discount)) {
        profit_perc += party_discount;
        profit_val += (party_discount / 100) * purchase_rate;
    }
    if (!isNaN(party_less)) {
        profit_val += party_less;
        profit_perc += (party_less / purchase_rate) * 100;
    }
    if (!isNaN(customer_less)) {
        profit_val -= customer_less;
        profit_perc -= (customer_less / purchase_rate) * 100;
    }
    if (!isNaN(w_sale_man_commension)) {
        profit_val -= w_sale_man_commension;
        profit_perc -= (w_sale_man_commension / purchase_rate) * 100 ;
    }


    var profit = profit_perc.toFixed(3) + "% | " + parseInt(profit_val);

    if(sale_rate != ""){
        $("#profit").val(profit);
    }
    generateDescription();
}

function changeWholeSale(){
    var salerate = parseFloat($("#sale_rate").val());
    var retail_sale_rate_p = parseInt($("#retail_sale_rate_p").val()); //retail sale rate %age
    var retail_sale_rate = parseFloat($("#retail_sale_rate").val()); //retail sale rate by value
    var retail_salrate = parseFloat(salerate) + (Math.round(salerate * retail_sale_rate_p) / 100);
    //console.log(retail_sale_rate_p);
    //console.log(retail_sale_rate);
    //console.log(retail_salrate);
    // $("#retail_sale_rate").val(retail_salrate);
   // console.log(retail_salrate);
    var total_profit = retail_salrate - salerate;
    var retail_less = parseInt($("#retail_less").val());
    var retail_discount = parseInt($("#retail_discount").val());
    var r_sale_man_commension = parseInt($("#r_sale_man_commension").val());
    var retail_p_n = retail_sale_rate_p;
    var retail_n = total_profit;
    //console.log(retail_n);

    if (!isNaN(retail_less)) {
        retail_n -= retail_less;
        retail_p_n -= (retail_less / salerate) * 100;
    }

    if (!isNaN(retail_discount)) {
        retail_n -= retail_discount;
        retail_p_n -= (retail_discount / salerate) * 100;
    }

    if (!isNaN(r_sale_man_commension)) {
        retail_n -= r_sale_man_commension;
        retail_p_n -= (r_sale_man_commension / salerate) * 100;
    }
    var show_value = retail_n;
    if (!isNaN(retail_sale_rate)) {
        retail_n = retail_n + retail_sale_rate;
    }

    // $("#retail_sale_rate").val(salerate + retail_n);
    //+ show_value+ "+" + retail_sale_rate +" | "
    if(retail_sale_rate > 0){
        var per = retail_sale_rate/salerate * 100
        var value = retail_sale_rate ;
    }else{
        var value = 0;
        var per = 0;
    }
    retail_p_n = parseFloat(retail_p_n) + per;

    if(Number.isNaN(retail_p_n)){
        retail_p_n = 0;
    }
    if(Number.isNaN(retail_n)){
        retail_n = 0;
    }
    if(Number.isNaN(salerate)){
        salerate = 0;
    }


    var tretail_profit = retail_p_n.toFixed(3) + "% | " + retail_n.toFixed(3) +"=" + (parseFloat(retail_n) + parseFloat(salerate)).toFixed(3);
    var valu = "=" + parseInt(retail_n + salerate);
    const innerDiv = document.createElement('div');
    innerDiv.style.float = "right";
    innerDiv.textContent = valu;
    $("#r_barcode_sale_rate").text(parseInt(retail_n + salerate));
    $("#retail_profit_text").html(retail_p_n.toFixed(3) + "% | " + parseInt(retail_n));
    $("#retail_profit_text").append(innerDiv);



    $("#retail_profit").val(parseInt(retail_n + salerate));
    generateDescription();
}
function changeWholeSale_for_id(){
    var salerate = parseFloat($("#sale_rate").val());
    var retail_sale_rate_p = parseInt($("#retail_sale_rate_p").val()); //retail sale rate %age
    var retail_sale_rate = parseFloat($("#retail_sale_rate").val()); //retail sale rate by value
    var retail_salrate = parseFloat(salerate) + (Math.round(salerate * retail_sale_rate_p) / 100);
    // $("#retail_sale_rate").val(retail_salrate);
    var total_profit = retail_salrate - salerate;
    var retail_less = parseInt($("#retail_less").val());
    var retail_discount = parseInt($("#retail_discount").val());
    var r_sale_man_commension = parseInt($("#r_sale_man_commension").val());
    var retail_p_n = retail_sale_rate_p;
    var retail_n = total_profit;

    if (!isNaN(retail_less)) {
        retail_n -= retail_less;
        retail_p_n -= (retail_less / salerate) * 100;
    }

    if (!isNaN(retail_discount)) {
        retail_n -= retail_discount;
        retail_p_n -= (retail_discount / salerate) * 100;
    }

    if (!isNaN(r_sale_man_commension)) {
        retail_n -= r_sale_man_commension;
        retail_p_n -= (r_sale_man_commension / salerate) * 100;
    }
    var show_value = retail_n;
    if (!isNaN(retail_sale_rate)) {
        retail_n = retail_n + retail_sale_rate;
    }

    // $("#retail_sale_rate").val(salerate + retail_n);
    //+ show_value+ "+" + retail_sale_rate +" | "
    if(retail_sale_rate > 0){
        var per = retail_sale_rate/salerate * 100
        var value = retail_sale_rate ;
    }else{
        var value = 0;
        var per = 0;
    }
    retail_p_n = parseFloat(retail_p_n) + per;

    if(Number.isNaN(retail_p_n)){
        retail_p_n = 0;
    }
    if(Number.isNaN(retail_n)){
        retail_n = 0;
    }
    if(Number.isNaN(salerate)){
        salerate = 0;
    }


    var tretail_profit = retail_p_n.toFixed(3) + "% | " + retail_n.toFixed(3) +"=" + (parseFloat(retail_n) + parseFloat(salerate)).toFixed(3);

    var valu = "=" + parseInt(retail_n + salerate);
    const innerDiv = document.createElement('div');
    innerDiv.style.float = "right";
    innerDiv.textContent = valu;
    $("#r_barcode_sale_rate").text(parseInt(retail_n + salerate));
    $("#retail_profit_text").html(retail_p_n.toFixed(3) + "% | " + parseInt(retail_n));
    $("#retail_profit_text").append(innerDiv);



    $("#retail_profit").val(parseInt(retail_n + salerate));
    //generateDescription();
}
function get_item_codes2(party_id,item_id = ""){
    var url = "{{ route('ajax.get_item_codes', ':party_id2') }}".replace(':party_id2', party_id);

}


function get_item_codes(party_id,item_id = ""){
    var url = "{{ route('ajax.get_item_codes', ':party_id') }}".replace(':party_id', party_id);
    $.get(url, function (response) {
        var dropdown = $('#item_code')[0].selectize;
        dropdown.clear(); // ✅ Clear current selection
        dropdown.clearOptions();
        if (response) {
            response.forEach(function (code) {
                dropdown.addOption({ value: code, text: code });
            });
            if(item_id != ""){
                $("#item_code")[0].selectize.setValue(item_id, true);

                $("#barcode_ptc").text($("#item_code")[0].selectize.options[item_id]?.text || '');

                $("#r_barcode_ptc").text($("#item_code")[0].selectize.options[item_id]?.text || '');

            }
        } else {
            console.error("No item codes found.");
        }
    }).fail(function (xhr, status, error) {
        console.error("Error fetching item codes:", error);
    });
}
$(document).ready(function() {
    $('#form').on('submit', function(e) {
        e.preventDefault();
        submitForm(new FormData(this));
    });
});

function submitForm(formData) {
    $("#save").text("Please wait...").attr("disabled", true);

    return $.ajax({
        url: "{{ route('item.post') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false
    }).then(function(response) { // ✅ Using `then()` instead of `done()`

        console.log(response);
        $("#save").attr("disabled", false).text("Save");

        if (response.result === "item_code_exist") {
            showError('Item code already exists!');
            return $.Deferred().reject().promise(); // ✅ Stop execution
        }

        if (response.result === "description_exist") {
            $("#id").val(response.id).trigger("input").focus();
            showError('Description already exists on id # ' + response.id);
            return $.Deferred().reject().promise(); // ✅ Stop execution
        }

        showSuccess('Item Added Successfully!', function() {
            jQuery("#id").attr("max", function(_, currentMax) {
                return parseInt(currentMax) + 1;
            });
            reset_item();
        });

        return $.Deferred().resolve().promise(); // ✅ Allow `done()` to execute
    }).fail(function(xhr) {
        console.error("AJAX error:", xhr);
        return $.Deferred().reject().promise(); // ✅ Ensure failure stops execution
    });
}
function submitFormList(formData) {
    $("#save").text("Please wait...").attr("disabled", true);

    return $.ajax({
        url: "{{ route('item.post') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false
    }).then(function(response) { // ✅ Using `then()` instead of `done()`
        $("#save").attr("disabled", false).text("Save");

        if (response.result === "item_code_exist") {
            showError('Item code already exists!');
            return $.Deferred().reject().promise(); // ✅ Stop execution
        }

        if (response.result === "description_exist") {
            $("#id").val(response.id).trigger("input").focus();
            showError('Description already exists on id # ' + response.id);
            return $.Deferred().reject().promise(); // ✅ Stop execution
        }

        showSuccess('Item Added Successfully!', function() {
            jQuery("#id").attr("max", function(_, currentMax) {
                return parseInt(currentMax) + 1;
            });
            reset_item_list();
        });

        return $.Deferred().resolve().promise(); // ✅ Allow `done()` to execute
    }).fail(function(xhr) {
        console.error("AJAX error:", xhr);
        return $.Deferred().reject().promise(); // ✅ Ensure failure stops execution
    });
}


function showError(message) {
    toastr.error(message, 'Error!');
}

function showSuccess(message, callback) {
    toastr.success(message, 'Success', { timeOut: 600, onHidden: callback });
}



$('#invoice_form').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    // Ensure selectize fields are included
    jQuery('.c_selectize').each(function() {
        let name = jQuery(this).attr('name');
        let value = jQuery(this).val(); // Get the selected value(s)

        if (value) {
            if (Array.isArray(value)) {
                value.forEach(val => formData.append(name, val));
            } else {
                formData.append(name, value);
            }
        }
    });


    $("#invoice_save").text("Please wait...");
    $("#invoice_save").attr("disabled", true);

    $.ajax({
        url: "{{ route('item.invoice.post') }}",
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            //console.log(response);
            $("#invoice_save").text("Reloading");
            $("#invoice_save").attr("disabled", false);
            toastr.success('Invoice Added Successfully!', 'Success', {
                timeOut: 600,
                onHidden: function() {
                    location.reload();
                }
            });
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorHtml = '<ul>';
            $.each(errors, function(key, value) {
                errorHtml += '<li>' + value[0] + '</li>';
            });
            errorHtml += '</ul>';
            $('#response').html(errorHtml);
        }
    });
});


function get_id_item(value,type) {
    var name = value;

    $.ajax({
        url: "{{ route('ajax.item.search.id') }}",
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            value: value,
            type: type
        },
        success: function(response) {
            if (response) {
                var data = response;

                if (Object.keys(data).length > 0) {

                    if(type == "item_code"){
                        $("#packet_qty").focus();
                    }

                    if (data.status == 'inactive') {
                        $('#inactive').prop('checked', true);
                        $('#id')[0].style.setProperty('border-color', 'red', 'important');
                        $('#barcode')[0].style.setProperty('border-color', 'red', 'important');
                        $('#description')[0].style.setProperty('border-color', 'red', 'important');
                        $("#list_data").addClass("disabled");
                    } else {
                        $('#active').prop('checked', true);
                        $('#id')[0].style.setProperty('border-color', '#aaa', 'important');
                        $('#barcode')[0].style.setProperty('border-color', '#aaa', 'important');
                        $('#description')[0].style.setProperty('border-color', '#aaa', 'important');
                    }

                    $('#barcode').val(data.barcode);
                    $('#date').val(data.date);
                    $('#party_id').val(data.party_id);
                    $('#party_id2').val(data.party_id);
                    // $("#party_name")[0].selectize.off("change");
                    $("#party_name")[0].selectize.setValue(data.party_id, true);
                    $("#party_name2")[0].selectize.setValue(data.party_id, true);
                    // $("#party_name")[0].selectize.on('change', function() {});
                    // $("#define_item_id")[0].selectize.off("change");
                    $("#define_item_id")[0].selectize.setValue(data.define_item_id, true);
                    // $("#define_item_id")[0].selectize.on('change', function() {});
                    // $("#define_size_id")[0].selectize.off("change");
                    $("#define_size_id")[0].selectize.setValue(data.define_size_id, true);
                    // $("#define_size_id")[0].selectize.on('change', function() {});

                    if(type == "id"){
                        get_item_codes(data.party_id,data.item_code);
                    }else{
                        $("#id").val(data.id);
                    }
                    $('#description').val(data.description);
                    $('#purchase_rate').val(data.purchase_rate);
                    $('#sale_rate').val(data.sale_rate);
                    $('#party_discount').val(data.party_discount);
                    $('#margin_field').val(data.margin_field);
                    $('#party_less').val(data.party_less);
                    $('#customer_less').val(data.customer_less);
                    $('#profit').val(data.wholesale_profit);
                    $('#retail_sale_rate_p').val(data.retail_sale_rate_p);
                    $('#retail_sale_rate').val(data.retail_sale_rate);
                    $('#retail_less').val(data.retail_less);
                    $('#retail_discount').val(data.retail_discount);
                    //$('#retail_profit').val(data.retail_profit);
                    $('#min_level').val(data.min_level);
                    $('#max_level').val(data.max_level);
                    $('#w_sale_man_commension').val(data.w_sale_man_commension);
                    $('#r_sale_man_commension').val(data.r_sale_man_commension);
                    $("#save").text("Update");


                    // $("#barcode_ptc").text($("#item_code")[0].selectize.options[data.item_code]?.text || '');
                    $("#barcode_item").text($("#define_item_id")[0].selectize.options[data.define_item_id]?.text || '');
                    $("#barcode_size").text($("#define_size_id")[0].selectize.options[data.define_size_id]?.text || '');
                    $("#barcode_barcode").text(data.barcode);
                    $("#barcode_sale_rate").text(data.sale_rate);

                    // $("#r_barcode_ptc").text($("#item_code")[0].selectize.options[data.item_code]?.text || '');
                    $("#r_barcode_item").text($("#define_item_id")[0].selectize.options[data.define_item_id]?.text || '');
                    $("#r_barcode_size").text($("#define_size_id")[0].selectize.options[data.define_size_id]?.text || '');
                    $("#r_barcode_barcode").text(data.barcode);


                    changeWholeSale_for_id();

                    // console.log($("#item_code")[0].selectize.options[data.item_code]?.text);


                }else{
                    // reset_item();
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });

    //  changeBarcode();
}

var party_less = [];

function get_id_party(value) {
    //window.alert(value);
    var name = value;
    $.ajax({
        url: "{{ route('ajax.party.search.id') }}",
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            value: value,
        },
        success: function(response) {
            if (response) {
                var data = response;
                $("#party_discount").val(data.discount);
                party_less = data.party_less;
                if (Array.isArray(party_less) && party_less.length > 0) {
                  set_less();
                }else{
                  $("#party_less").val("");
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function get_invoice(value) {
    $.ajax({
        url: "{{ route('ajax.item_invoice.search') }}",
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            value: value,
        },
        success: function(response) {
            //console.log(response);
            if (response) {
                var data = response;

                if (Object.keys(data).length > 0) {
                    $("#invoice_save").text("Update");
                }else{
                    $("#invoice_save").text("Save");
                }
                $("#party_name2")[0].selectize.setValue(data.party_id);
                $('#party_id2').val(data.party_id);
                $('#current_date').val(data.date);
                $('#vr_no').val(data.vr_no);
                $('#party_inv_date').val(data.party_inv_date);
                $('#party_inv_no').val(data.party_inv_no);
                $('#bilty_no').val(data.bilty_no);
                $('#remarks').val(data.remarks || '');
                $('#total_pkt').val(data.pkt_qty);
                $('#total_piec').val(data.total_pcs);
                $('#total_amount').val(data.amount);
                $('#total_gamount').val(data.g_amount);
                $('#inv_disc_perc').val(data.inv_disc_perc);
                $('#net_amount').val(data.net_amount);
                $('#freight').val(data.freight);
                $('#paid_amount').val(data.paid_amount);

                $('#total_amount2').val(data.total_amount);
                $('#cash_amount').val(data.cash_amount);
                $('#cash_remarks').val(data.cash_remarks);
                $("#bank")[0].selectize.setValue(data.bank);
                $('#bank_account_title').val(data.bank_account_title);
                $('#bank_account_number').val(data.bank_account_number);
                $('#bank_amount').val(data.bank_amount);
                $('#bank_remarks').val(data.bank_remarks);
                $('#cheque_bank').val(data.cheque_bank);
                $('#cheque_amount').val(data.cheque_amount);
                $('#cheque_date').val(data.cheque_date);
                $('#cheque_remarks').val(data.cheque_remarks);
                $('#bt_from').val(data.bt_from);
                $("#bt_to")[0].selectize.setValue(data.bt_to);
                $('#bt_account_title').val(data.bt_account_title);
                $('#bt_account_number').val(data.bt_account_number);
                $('#bt_amount').val(data.bt_amount);
                $('#bt_remarks').val(data.bt_remarks);
                $('#payment_total_amount').val(data.payment_total_amount);

                $('input[name="payment_status"][value="' + data.payment_status + '"]').prop('checked', true);
                $('#godown').val(data.godown_id);
                $(".main-table tbody").empty();
                var items = data.item_invoice_lists;
                var t_less = 0;
                var t_disc = 0;
                var grand_tot = 0;
                for (var i = 0; i < items.length; i++) {
                    var row = items[i];
                    var party_discount = row.item?.party_discount;
                    var barcode = row.barcode;
                    var partyItemCode = row.item_code;
                    var description = row.description;
                    var godown = data.godown.name;
                    var packetQty = row.packet_qty;
                    var piecesInPacket = row.pieces_in_packet;
                    var totalPieces = row.total_pieces;
                    var purchaseRate = row.purchase_rate;
                    var partyLess = row.party_less;
                    var margin_field = row.margin_field;
                    var table_id = i + 1;
                    var wholesale_profit = row.wholesale_profit;
                    //var parts = wholesale_profit.split(" | ");

                    var less = (((purchaseRate * party_discount) / 100) * totalPieces) + (partyLess * totalPieces);
                    var party_less_total = (partyLess * totalPieces);
                    var party_total_discount = (((purchaseRate * party_discount) / 100) * totalPieces);

                    var id = row.id;
                    party_discount_total = party_discount;
                    //console.log(row.total_less);
                    //console.log(row.amount);
                    //console.log(row.total_less/row.amount);

                    var perAgeDis = (row.total_less/row.amount) *100;
                    perAgeDis = perAgeDis.toFixed(3);

                    var less_tables = row.less_per_pcs;
                    var disc_tables = row.discount_per_pcs;
                    var total_pcs = row.total_pcs;
                    var gt_less = 0;
                    var gt_disc = 0;
                    if(less_tables !== ''){
                        var gt_less = total_pcs * less_tables;
                    }
                    if(disc_tables !== ''){
                        var gt_disc = total_pcs * disc_tables;
                    }
                    t_less +=gt_less;
                    t_disc +=gt_disc;
                    var g_total = gt_less + gt_disc;
                    grand_tot += g_total;

                    var t_amrgin = margin_field * row.total_pcs;
                    //console.log(g_total);
                    var newRow =
    "<tr>" +
    "<input type='hidden' name='invoice_party_less_total[]' value='" + (row.party_less_total ?? '') + "' />" +
    "<input type='hidden' name='invoice_party_total_discount[]' value='" + (row.party_total_discount ?? '') + "' />" +
    "<input type='hidden' name='invoice_party_discount[]' value='" + (row.party_discount ?? '') + "' />" +
    "<input type='hidden' name='invoice_margin_field[]' value='" + (row.margin_field ?? '') + "' />" +
    "<input type='hidden' name='item_id[]' value='" + (row.id ?? '') + "' class='item-id' />" +
    "<input type='hidden' name='invoice_party_less_per_pcs[]' value='" + (row.less_per_pcs ?? '') + "' class='party_less_post' />" +
    "<input type='hidden' name='invoice_packet_qty[]' value='" + (row.packet_qty ?? '') + "' class='item-qty' />" +
    "<input type='hidden' name='invoice_barcode[]' value='" + (row.barcode ?? '') + "' />" +
    "<input type='hidden' name='invoice_party_item_code[]' value='" + (row.party_item_code ?? '') + "' />" +
    "<input type='hidden' name='invoice_description[]' value='" + (row.description ?? '') + "' />" +
    "<input type='hidden' name='invoice_godown[]' value='" + (row.godown ?? '') + "' />" +
    "<input type='hidden' name='invoice_pieces_in_packet[]' value='" + (row.pieces_in_packet ?? '') + "' />" +
    "<input type='hidden' name='invoice_total_pcs[]' value='" + (row.total_pcs ?? '') + "' />" +
    "<input type='hidden' name='invoice_purchase_rate[]' value='" + (row.purchase_rate ?? '') + "' />" +
    "<input type='hidden' name='invoice_amount[]' value='" + (row.amount ?? '') + "' />" +
    "<input type='hidden' name='invoice_discount_per_pcs[]' value='" + (row.discount_per_pcs ?? '') + "' />" +
    "<input type='hidden' name='invoice_l_rate[]' value='" + (row.l_rate ?? '') + "' />" +
    "<input type='hidden' name='invoice_gross_amount[]' value='" + (row.gross_amount ?? '') + "' />" +
    "<input type='hidden' name='invoice_total_less[]' value='" + (g_total.toFixed(2) ?? '') + "' />" +
    "<input type='hidden' name='invoice_total_dis_percent[]' value='" + (perAgeDis ?? '') + "' />" +

    // Visible columns
    "<td class='table_id'>" + (table_id ?? '-') + "</td>" +
    "<td>" + (row.barcode ?? '-') + "</td>" +
    "<td>" + (row.party_item_code ?? '-') + "</td>" +
    "<td>" + (row.description ?? '-') + "</td>" +
    "<td>" + (row.godown ?? '-') + "</td>" +
    "<td class='pkt_table'>" + (row.packet_qty ?? '-') + "</td>" +
    "<td>" + (row.pieces_in_packet ?? '-') + "</td>" +
    "<td class='piec_table'>" + (row.total_pcs ?? '-') + "</td>" +
    "<td>" + (row.purchase_rate ?? '-') + "</td>" +
    "<td class='amount_table'>" + (row.amount ?? '-') + "</td>" +
    "<td class='less_table'>" + (row.less_per_pcs ?? '-') + "</td>" +
    "<td class='disc_table'>" + (row.discount_per_pcs ?? '-') + "</td>" +
    "<td>" + (row.l_rate ?? '-') + "</td>" +
    "<td class='gamount_table'>" + (row.gross_amount ?? '-') + "</td>" +
    "<td class='tmargin_table'>" + (margin_field ?? '-') + "</td>" +
    "<td class='total_margin_table'>" + (t_amrgin ?? '-') + "</td>" +
    "<td class='total_less_table'>" + (g_total.toFixed(2) ?? '-') + "</td>" +
    "<td class='total_less_discount'>" + (perAgeDis ?? '-') + "</td>" +
    "<td><i onclick='deleteItemRow(this)' class='fas fa-trash text-danger del-icon'></i></td>" +
    "</tr>";


                    $(".main-table tbody").append(newRow);
                }
                var t_amount = data.amount;
                var g_per = (t_disc/t_amount) * 100;
                $('#total_less').val(t_less);
                $('#total_disc').val(g_per.toFixed(2) + '% |' +t_disc.toFixed(2));
                var grand_less = t_less + t_disc;
                var grand_per = grand_less/t_amount * 100;
                $('#total_less2').val(grand_per.toFixed(2) + '% |' +grand_less.toFixed(2));
               /* var t_am =  parseInt($("#total_less").val()) + sum + inv_disc_perc;
                var grand_amount = t_am - freight;
                var t_profit = grand_amount/t_amount * 100;
                $("#total_profit2").val(t_profit.toFixed(3) + "% | " + grand_amount);*/
                calcTable();
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function set_less(){
    let purchaseRate = parseFloat($("#purchase_rate").val());
    let lessValue = '';
    for (let i = 0; i < party_less.length; i++) {
        let range = party_less[i];
        if (purchaseRate >= range.from && purchaseRate <= range.to) {
            lessValue = range.less;
            break;
        }
    }
    $('#party_less').val(lessValue);
}

jQuery('#purchase_rate').on('input', function() {
    set_less();
    calcProfit();
});

jQuery('#sale_rate').on('input', function() {
    calcProfit();
    changeWholeSale();
});

jQuery('#define_item_id, #define_size_id, #party_name').on('change', function() {
    generateDescription();
});

/**/

jQuery('#item_code').on('change', function() {
    var item_code = $("#item_code")[0].selectize.getItem($("#item_code")[0].selectize.getValue()).text();
    var party_id = document.getElementById('party_id').value;
    if(item_code != "" && party_id != ''){
        get_id_item_party(item_code, party_id);
        generateDescription();
    }
});

function get_id_item_party(item_code, party_id) {
    var name = item_code;
    //console.log(item_code, party_id);
    $.ajax({
        url: "{{ route('ajax.item.search.id.party') }}",
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            item_code: item_code,
            party_id: party_id
        },
        success: function(response) {
            ///console.log(response);
            if (response) {
                var data = response;

                if (Object.keys(data).length > 0) {

                    $("#packet_qty").focus();


                    if (data.status == 'inactive') {
                        $('#inactive').prop('checked', true);
                        $('#id')[0].style.setProperty('border-color', 'red', 'important');
                        $('#barcode')[0].style.setProperty('border-color', 'red', 'important');
                        $('#description')[0].style.setProperty('border-color', 'red', 'important');
                        $("#list_data").addClass("disabled");
                    } else {
                        $('#active').prop('checked', true);
                        $('#id')[0].style.setProperty('border-color', '#aaa', 'important');
                        $('#barcode')[0].style.setProperty('border-color', '#aaa', 'important');
                        $('#description')[0].style.setProperty('border-color', '#aaa', 'important');
                    }

                    $('#barcode').val(data.barcode);
                    $('#date').val(data.date);
                    $('#party_id').val(data.party_id);
                    $("#party_name")[0].selectize.setValue(data.party_id, true);
                    $("#define_item_id")[0].selectize.setValue(data.define_item_id, true);
                    $("#define_size_id")[0].selectize.setValue(data.define_size_id, true);


                    $("#id").val(data.id);

                    $('#description').val(data.description);
                    $('#purchase_rate').val(data.purchase_rate);
                    $('#sale_rate').val(data.sale_rate);
                    $('#party_discount').val(data.party_discount);
                    $('#party_less').val(data.party_less);
                    $('#customer_less').val(data.customer_less);
                    $('#margin_field').val(data.margin_field);
                    $('#profit').val(data.wholesale_profit);
                    $('#retail_sale_rate_p').val(data.retail_sale_rate_p);
                    $('#retail_sale_rate').val(data.retail_sale_rate);
                    $('#retail_less').val(data.retail_less);
                    $('#retail_discount').val(data.retail_discount);
                    $('#retail_profit').val(data.retail_profit);
                    $('#min_level').val(data.min_level);
                    $('#max_level').val(data.max_level);
                   /* $('#packet_qty').val(data.packet_qty);
                    $('#pieces_in_packet').val(data.pieces_in_packet);
                    $('#total_pieces').val(data.total_pieces);*/
                    $('#w_sale_man_commension').val(data.w_sale_man_commension);
                    $('#r_sale_man_commension').val(data.r_sale_man_commension);
                    $("#save").text("Update");


                    // $("#barcode_ptc").text($("#item_code")[0].selectize.options[data.item_code]?.text || '');
                    $("#barcode_item").text($("#define_item_id")[0].selectize.options[data.define_item_id]?.text || '');
                    $("#barcode_size").text($("#define_size_id")[0].selectize.options[data.define_size_id]?.text || '');
                    $("#barcode_barcode").text(data.barcode);
                    $("#barcode_sale_rate").text(data.sale_rate);

                    // $("#r_barcode_ptc").text($("#item_code")[0].selectize.options[data.item_code]?.text || '');
                    $("#r_barcode_item").text($("#define_item_id")[0].selectize.options[data.define_item_id]?.text || '');
                    $("#r_barcode_size").text($("#define_size_id")[0].selectize.options[data.define_size_id]?.text || '');
                    $("#r_barcode_barcode").text(data.barcode);
                    //$("#r_barcode_sale_rate").text(data.retail_sale_rate);

                    // console.log($("#item_code")[0].selectize.options[data.item_code]?.text);
                    //changeWholeSale();

                }else{
                    // reset_item();
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });

    //  changeBarcode();
}

jQuery('#retail_sale_rate_p, #retail_sale_rate, #retail_less,#retail_discount,#r_sale_man_commension').on('input', function() {
      changeWholeSale();
});

function generateDescription() {
    var partyItemCode = $("#item_code")[0].selectize.getItem($("#item_code")[0].selectize.getValue()).text();
    var item = $("#define_item_id")[0].selectize.getItem($("#define_item_id")[0].selectize.getValue()).text();
    var size = $("#define_size_id")[0].selectize.getItem($("#define_size_id")[0].selectize.getValue()).text();
    var partyId = $("#party_id").val();

    var sale_rate = document.getElementById("sale_rate").value;
    var whole_sale = document.getElementById("w_sale_man_commension").value;
    var retail_sale = document.getElementById("r_sale_man_commension").value;
    var description = `${partyItemCode}-${item}-${size}-${partyId}-`;

    for (var i = 0; i < sale_rate.length; i++) {
        var digit = parseInt(sale_rate[i]);

        if (digit === 0) {
            description += "Z";
        } else if (digit === 1) {
            description += "O";
        } else if (digit === 2) {
            description += "T";
        } else if (digit == 3) {
            description += "TH";
        } else if (digit == 4) {
            description += "F";
        } else if (digit == 5) {
            description += "FI";
        } else if (digit == 6) {
            description += "S";
        } else if (digit == 7) {
            description += "SE";
        } else if (digit == 8) {
            description += "E";
        } else if (digit == 9) {
            description += "N";
        } else if (digit == 10) {
            description += "OZ";
        }
    }

    description += `-${whole_sale ? '$' : ''}-${retail_sale ? 'R$' : ''}`;
    document.getElementById("description").value = description;

    changeBarcode();
}

jQuery('#list_data').on('click', function() {
    let formData = new FormData($('#form')[0]); // Get form data

    submitFormList(formData).done(function() {
        list_data(); // ✅ Only runs if no errors
    }).fail(function() {
        console.log("Execution stopped due to validation error.");
    });
});


function list_data() {


      var party_discount = $("#party_discount").val();
      if (parseInt(party_discount) > 0) {
          party_discount_total = party_discount;
      }
      var barcode = $("#barcode").val();
      var partyItemCode = $("#item_code")[0].selectize.getItem($("#item_code")[0].selectize.getValue()).text();
      var description = $("#description").val();
      var godown = $("#godown option:selected").text();
      var packetQty = $("#packet_qty").val();
      var piecesInPacket = $("#pieces_in_packet").val();
      var totalPieces = $("#total_pieces").val();
      var purchaseRate = $("#purchase_rate").val();
      var partyLess = $("#party_less").val();
      var marginField = parseInt($("#margin_field").val());
      var barcode = $("#barcode").val();
      var lastText = $(".table_id").last().text().trim();
      var table_id = lastText ? parseInt(lastText, 10) + 1 : 1;


      if(isNaN(marginField)){
          marginField = 0;
      }
      var wholesale_profit = $("#profit").val();

      var parts = wholesale_profit.split(" | ");

      var less = (((purchaseRate * party_discount) / 100) * totalPieces) + (partyLess * totalPieces);

    var less_tables = partyLess;
    var disc_tables = party_discount;
    var total_pcs = totalPieces;
    var gt_less = 0;
    var gt_disc = 0;
    if(less_tables !== ''){
        var gt_less = total_pcs * less_tables;
    }
    if(disc_tables !== ''){
        var gt_disc = total_pcs * disc_tables;
    }
    var g_total = gt_less + gt_disc;

      var party_less_total = (partyLess * totalPieces);
      var party_total_discount = (((purchaseRate * party_discount) / 100) * totalPieces);
        var t_amount = (purchaseRate * totalPieces).toFixed(3);
      var per = less/t_amount * 100;
      per = per.toFixed(3);
      var id = $("#id").val();

      var t_margin = marginField * totalPieces;
    var no = 1;
      var newRow = "<tr id='row_"+no+++"'>" +
          "<input type='hidden' name='invoice_party_less_total[]' value='" + party_less_total + "' />" +
          "<input type='hidden' name='invoice_margin_field_total[]' value='" + marginField + "' />" +
          "<input type='hidden' name='invoice_party_total_discount[]' value='" + party_total_discount + "' />" +
          "<input type='hidden' name='invoice_party_discount[]' value='" + party_discount + "' />" +
          "<input type='hidden' name='item_id[]' value='" + id + "' />" +

          "<td class='table_id'>" + table_id + "<input type='hidden' name='invoice_table_id[]' value='" + table_id + "' /></td>" +
          "<td>" + barcode + "<input type='hidden' name='invoice_barcode[]' value='" + barcode + "' /></td>" +
          "<td>" + partyItemCode + "<input type='hidden' name='invoice_party_item_code[]' value='" + partyItemCode + "' /></td>" +
          "<td>" + description + "<input type='hidden' name='invoice_description[]' value='" + description + "' /></td>" +
          "<td>" + godown + "<input type='hidden' name='invoice_godown[]' value='" + godown + "' /></td>" +
          "<td class='pkt_table'>" + packetQty + "<input type='hidden' name='invoice_packet_qty[]' value='" + packetQty + "' /></td>" +
          "<td>" + piecesInPacket + "<input type='hidden' name='invoice_pieces_in_packet[]' value='" + piecesInPacket + "' /></td>" +
          "<td class='piec_table'>" + totalPieces + "<input type='hidden' name='invoice_total_pcs[]' value='" + totalPieces + "' /></td>" +
          "<td>" + purchaseRate + "<input type='hidden' name='invoice_purchase_rate[]' value='" + purchaseRate + "' /></td>" +

          "<td class='amount_table'>" + (purchaseRate * totalPieces).toFixed(3) +
          "<input type='hidden' name='invoice_amount[]' value='" + (purchaseRate * totalPieces).toFixed(3) + "' /></td>" +

          "<td class='less_table'>" + partyLess +
          "<input type='hidden' name='invoice_less_per_pcs[]' value='" + partyLess + "' /></td>" +

          "<td class='disc_table'>" + ((purchaseRate * party_discount) / 100).toFixed(3) +
          "<input type='hidden' name='invoice_discount_per_pcs[]' value='" + ((purchaseRate * party_discount) / 100).toFixed(3) + "' /></td>" +

          "<td>" + ((purchaseRate - (purchaseRate * party_discount) / 100) - partyLess).toFixed(3) +
          "<input type='hidden' name='invoice_l_rate[]' value='" + ((purchaseRate - (purchaseRate * party_discount) / 100) - partyLess).toFixed(3) + "' /></td>" +

          "<td class='gamount_table'>" + (((purchaseRate - (purchaseRate * party_discount) / 100) - partyLess) * totalPieces).toFixed(3) +
          "<input type='hidden' name='invoice_gross_amount[]' value='" + (((purchaseRate - (purchaseRate * party_discount) / 100) - partyLess) * totalPieces).toFixed(3) + "' /></td>" +

          "<td class='margin_table'>" + marginField + "<input type='hidden' name='invoice_margin[]' value='" + marginField + "' /></td>" +
          "<td class='total_margin_table'>" + t_margin + "<input type='hidden' name='invoice_total_margin[]' value='" + t_margin + "' /></td>" +
          "<td class='total_less_table'>" + less + "<input type='hidden' name='invoice_total_less[]' value='" + g_total + "' /></td>" +
          "<td class='total_less_discount'>" + per+ "<input type='hidden' name='invoice_total_dis_percent[]' value='" + per + "' /></td>" +

          "<td><i onclick='deleteItemRow(this)' class='fas fa-trash text-danger del-icon'></i></td>" +
          "</tr>";


      $(".main-table tbody").append(newRow);

      var tableWrapper = $(".table-wrapper");
      $('html, body').animate({
          scrollTop: tableWrapper.offset().top
      }, 100);

      setTimeout(function() {
          $('html, body').animate({
              scrollTop: 0
          }, 1000);
      }, 2000);

      calcTable();
    //reset_item_list();

      $("#list_data").addClass("disabled");

      return true;
}


function calcTable() {
    var sum = 0;
    $('.pkt_table').each(function() {
        sum += parseFloat($(this).text());
    });

    $("#total_pkt").val(sum);

    var total_piec = 0;
    $('.piec_table').each(function() {
        total_piec += parseFloat($(this).text());
    });
    var total_margin = 0;
    $('.total_margin_table').each(function() {
        total_margin += parseFloat($(this).text());
    });

    $("#total_piec").val(total_piec);

    var total_amount = 0;
    $('.amount_table').each(function() {
        total_amount += parseFloat($(this).text());
    });

    $("#total_amount").val(total_amount);

    gamount = 0;
    $('.gamount_table').each(function() {
        gamount += parseFloat($(this).text());
    });

    sum = 0;
    $('input[name="party_less_total"]').each(function() {
        var inputValue = parseFloat($(this).val());
        if (!isNaN(inputValue)) {
            sum += inputValue;
        }
    });

    var total_less_discount = 0;
    $('.total_less_discount').each(function() {
        total_less_discount += parseFloat($(this).text());
    });


    /*var total_less = 0;
    $('.less_table').each(function() {
        var valuu = parseFloat($(this).text());
        if(isNaN(valuu)){
            valuu =0;
        }
        total_less += valuu;
    });*/


    var sum = 0;
    var total_less = 0;
    var percentage = 0;
    let rows = document.querySelectorAll(".main-table tr");
    var rowCount = $('.main-table tr').length;
    for(var i = 1; i<rowCount; i++){
        let dis = rows[i].querySelector(".disc_table");
        var dis_text = dis.textContent.trim();
        if(dis_text != '0.00' || dis_text != 0.00){
            let disc_table = rows[i].querySelector(".disc_table").textContent.trim();
            let piec_table = rows[i].querySelector(".piec_table").textContent.trim();

            var t_value = parseFloat(piec_table) * parseFloat(disc_table);
            let amount = rows[i].querySelector(".amount_table").textContent.trim();
            sum +=parseFloat(t_value);
        }
        let less = rows[i].querySelector(".less_table");
        var less_text = parseFloat(less.textContent.trim());

        if(isNaN(less_text)){
            var tot_value = 0;

        }else{
            let less_table = rows[i].querySelector(".less_table").textContent.trim();
            let piec_table = rows[i].querySelector(".piec_table").textContent.trim();
            var tot_value = parseFloat(piec_table) * parseFloat(less_table);

        }
        total_less +=parseFloat(tot_value);


    }
    $("#total_margin").val(total_margin);
    $("#total_less").val(total_less.toFixed(2));


    if(sum != 0){
        var total_disc = (((sum / total_amount) * 100));
    }else{
        var total_disc = 0;
    }

    //window.alert(total_disc);


    $("#total_disc").val(total_disc.toFixed(2) + "% |  " + sum.toFixed(2));
    $("#total_gamount").val($("#total_amount").val() - $("#total_less").val());

    var net_amount = $("#total_gamount").val() - sum;
    $("#net_amount").val(net_amount);




    var freight = parseInt($("#freight").val());
    var inv_disc_perc = parseInt($("#inv_disc_perc").val());
    var paid_amount = parseInt($("#paid_amount").val());

    if(isNaN(inv_disc_perc)){
        inv_disc_perc = 0;
    }
    if(isNaN(freight)){
        freight = 0;
    }
    net_amount = net_amount + freight;

    if(!isNaN(inv_disc_perc)){
      net_amount = net_amount - inv_disc_perc;
    }

    if(!isNaN(paid_amount)){
      net_amount = net_amount - paid_amount;
    }

    if(!isNaN(net_amount)){
      $("#total_amount2").val(net_amount);
    }
    if(total_less != 0){
        if(isNaN(total_less)){
            total_less = 0;
        }
        var t_amount = parseInt($("#total_amount").val());
        var t_less_per = t_am/t_amount *100;
        var valuee = t_less_per.toFixed(3);
    }else{
        var valuee = 0;
    }
    var t_amount = parseInt($("#total_amount").val());
    var t_am =  parseInt($("#total_less").val()) + sum + inv_disc_perc;
    valuee = t_am/t_amount * 100;

    $("#total_less2").val(valuee.toFixed(3) + "% | " + t_am);
    var grand_amount = t_am - freight + total_margin;
    var t_profit = grand_amount/t_amount * 100;
    $("#total_profit2").val(t_profit.toFixed(3) + "% | " + grand_amount);

}

function deleteItemRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
    calcTable();
}



$("#insert_item").on("click", function(e) {
    e.preventDefault();
    var popup_item = $("#popup_item").val();

    if (popup_item == "") {
        toastr.error('Fields are required!', 'Error');
        return;
    }

    $("#insert_item").attr("disabled", true);
    $("#insert_item").text("Please Wait...");

    $.ajax({
        url: "{{ route('ajax.insert_define_item') }}",
        type: "POST",
        data: {
            '_token': '{{csrf_token()}}',
            name: popup_item
        },
        success: function(data) {
            if (data.result === "success") {
                toastr.success('Item Added Successfully!', 'Success');

                $("#define_item_id")[0].selectize.addOption({
                    value: data.id,
                    text: popup_item
                });

                $("#define_item_id")[0].selectize.setValue(data.id);
                closeModal(event, 'choose-item-model-1');
                $("#define_size_id")[0].selectize.focus();

            } else {
                toastr.error('Item Already Exist!', 'Error')
            }

            $("#insert_item").attr("disabled", false);
            $("#insert_item").text("Save");
        }
    });
});

$("#insert_size").on("click", function(e) {
    e.preventDefault();
    var popup_size = $("#popup_size").val();

    if (popup_size == "") {
        toastr.error('Fields are required!', 'Error');
        return;
    }

    $("#insert_size").attr("disabled", true);
    $("#insert_size").text("Please Wait...");

    $.ajax({
        url: "{{ route('ajax.insert_define_size') }}",
        type: "POST",
        data: {
            '_token': '{{csrf_token()}}',
            name: popup_size
        },
        success: function(data) {
            if (data.result === "success") {
                toastr.success('Size Added Successfully!', 'Success');

                $("#define_size_id")[0].selectize.addOption({
                    value: data.id,
                    text: popup_size
                });

                $("#define_size_id")[0].selectize.setValue(data.id);
                closeModal(event, 'choose-item-model-2');
                $("#purchase_rate").focus();

            } else {
                toastr.error('Item Already Exist!', 'Error')
            }

            $("#insert_size").attr("disabled", false);
            $("#insert_size").text("Save");
        }
    });
});

</script>

@endsection
