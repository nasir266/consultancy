
@extends('layouts.master')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .table-scrollbar {
            max-height: 250px; /* enough for about 5 rows */
            overflow-y: auto;
            border: 1px solid #ddd;
        }
        #loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            border: 8px solid #f3f3f3; /* Light gray */
            border-top: 8px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }


    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/mult-select.css?v=2') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/barcode.css?v=4x') }}">
@endsection
@section('title','Sale Invoice')

@section('content')
    <div id="loader" style="display: none;">
        <div class="spinner"></div>
    </div>
    <div class="pt-0 p-2.5 md:px-6 text-[13px] lg:text-base">
        <div class="flex items-center mb-2">
            <div class="w-1 h-7 bg-blue-600 mr-3"></div>
            <div class="w-1 h-7 bg-gradient-to-b from-blue-500 to-purple-600 mt-1 mr-2 rounded" style="height: 100%; width: 8px; background-color: #4f46e5; color: #4f46e5;"> 1</div>
            <h2 class="text-2xl font-bold text-gray-900">Sale Invoice</h2>
        </div>
        <form action="#" class="" id="invoice_form">
            @csrf

            <div class="bg-white rounded-xl px-5 py-2 block">
                <div class="flex items-center flex-wrap gap-3 max-w-[100%]" style="width: 90%">

                    <div class="flex-1">
                        <label
                            for="item-id"
                            class="text-gray-600 font-medium block mb-1"
                        >Current Date</label
                        >
                        <input
                            id="current_date"
                            type="date"
                            name="current_date"
                            value="{{date('Y-m-d')}}"
                            class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                        />
                    </div>
                    <div class="flex-1">
                        <label
                            for="bill"
                            class="block text-gray-600 font-medium mb-1"
                        >Bill #</label
                        >
                        <input
                            type="number"
                            id="bill_no"
                            name="bill_no"
                            value="{{ $bill_no }}"
                            oninput="get_invoice(this.value, 'bill_no')"
                            min="1"
                            max="{{ $bill_no }}"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                            required
                        />
                    </div>
                    <div class="flex-1">
                        <label for="vr" class="block text-gray-600 font-medium mb-1"
                        >Vr #</label
                        >
                        <input
                            id="vr_no"
                            name="vr_no"
                            type="number"
                            oninput="get_invoice(this.value, 'vr_no')"
                            value="{{$vr_no}}"
                            max="{{$vr_no}}"
                            min="1"
                            class=" border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                            placeholder="Vr #"
                        />
                    </div>


                    <div class="flex gap-2.5 items-center" style="margin-top: 22px;">
                        <button
                            type="button"
                            class="px-4 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        >
                            Purchase
                        </button>
                        <button
                            type="button"
                            onclick="openModal(event, 'item-search-model')"
                            class="px-4 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        >
                            Item Search
                        </button>
                        <a
                            target="_blank"
                            href="../party"
                            class="block px-4 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        >
                            Add Party
                        </a>
                    </div>
                </div>

            </div>



            <div class="flex flex-wrap items-end gap-4"></div>
            <div class="bg-white rounded-xl px-5 py-2 block mt-2">
                <div class=" max-w-[100%]" style="width: 85%">
                    <div class="flex items-center gap-4">
                        <div class="w-[70px]">
                            <label for="id" class="block text-gray-600 font-medium mb-1"
                            >ID</label
                            >
                            <input
                                id="party_id"
                                name="party_id"
                                type="number"
                                oninput="syncPartyId(this, 'party_name')"
                                class=" border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md"
                                placeholder="ID"
                            />
                        </div>
                        <div class="" style="width: 780px">
                            <label
                                for="s-part"
                                class="block text-gray-600 font-medium mb-1"
                            >Party Name</label
                            >
                            {{-- --}}
                            <select onchange="syncPartyId(this, 'party_id')" class="selectize-input-sp" name="party_name" id="party_name">
                                <option value="">Search</option>
                                @foreach($search as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="flex-1">
                            <label
                                for="party_number"
                                class="block text-gray-600 font-medium mb-1"
                            >Phone</label
                            >
                            {{-- --}}
                            <select onchange="syncPartyId(this, 'party_id')" class="selectize-input-sp" name="party_number" id="party_number">
                                <option value="">Search</option>
                                @foreach($search as $item)
                                    <option value="{{ $item->id }}"> {{ $item->mobile }}@foreach($item->party_mobiles as $m_item) {{ ", "  . $m_item->mobile}} @endforeach</option>
                                @endforeach
                            </select>

                        </div>

                    </div>

                    {{--<div>
                      <label
                        for="address"
                        class="block text-gray-600 font-medium mb-1"
                        >Address</label
                      >
                      <input
                        id="address"
                        name="address"
                        type="text"
                        class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                        placeholder="Address"
                      />
                    </div>--}}
                    <div class="flex items-center gap-3 flex-wrap">
                        <div  style="width: 250px">
                            <label for="area" class="block text-gray-600 font-medium mb-1">Area</label>
                            <input
                                id="area"
                                name="area"
                                type="text"
                                class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                                placeholder="Area"
                            />
                        </div>
                        <div class="flex-1" >
                            <label for="address" class="block text-gray-600 font-medium mb-1"
                            >Address</label
                            >
                            <input
                                id="address"
                                name="address"
                                type="text"
                                class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                                placeholder="Address"
                            />
                        </div>
                        <div style="width: 250px">
                            <label for="city" class="block text-gray-600 font-medium mb-1"
                            >City</label
                            >
                            <input
                                id="city"
                                name="city"
                                type="text"
                                class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                                placeholder="City"
                            />
                        </div>


                    </div>
                    <div class="flex items-center gap-3 flex-wrap">

                        <div style="width: 250px">
                            <label
                                for="salesman"
                                class="block text-gray-600 font-medium mb-1"
                            >Salesman</label
                            >
                            <select
                                name="salesman"
                                id="salesman"
                                class="selectize-input-sp"
                            >
                                <option value="" >Salesman</option>
                                @foreach($salesmans as $salesman)
                                    <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="width: 250px">
                            <label
                                for="salesman"
                                class="block text-gray-600 font-medium mb-1"
                            >Checker</label
                            >
                            <select
                                name="checker"
                                id="checker"
                                class="selectize-input-sp"
                            >
                                <option value="">Checker</option>
                                @foreach($salesmans as $salesman)
                                    <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="width: 250px">
                            <label for="city" class="block text-gray-600 font-medium mb-1"
                            >Written By</label
                            >
                            <select
                                name="written by"
                                id="written by"
                                class="selectize-input-sp"
                            >
                                <option value="">Written By</option>
                                @foreach($salesmans as $salesman)
                                    <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="width: 250px;">
                            <label
                                for="godown-s"
                                class="block text-gray-600 font-medium mb-1"
                            >Godown</label
                            >
                            <select
                                name="godown"
                                id="godown"
                                class="goddown-s border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                            >
                                <option value="" selected disabled>Select Godown</option>
                                @foreach($godown as $item)
                                    <option @if($item->default_status == "true") selected @endif value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="remark" class="block text-gray-600 font-medium mb-1"
                            >Remark</label
                            >
                            <input
                                id="remarks"
                                name="remarks"
                                type="text"
                                class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                                placeholder="Remark"
                            />
                        </div>
                        <div class="w-full max-w-[200px]">
                            <label for="search" class="block text-gray-600 font-medium mb-1"
                            >Search</label
                            >
                            <input
                                id="search"
                                type="text"
                                class="no-arrows border w-full border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md"
                                placeholder="Search"
                            />
                        </div>
                    </div>


                </div>
            </div>

            <div class="bg-white rounded-xl px-5 py-1 block mt-2 mb-2">
                <div class="flex flex-wrap items-center gap-1.5 mb-4">
                    <div class="w-full max-w-[100px]">
                        <label
                            for="rbarcode"
                            class="block text-gray-600 font-medium mb-1"
                        >Barcode</label
                        >
                        <input
                            id="rbarcode"
                            name="rbarcode"
                            type="number"
                            min="1"
                            oninput="getItem(this.value)"
                            class="no-arrows border w-full border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md"
                            placeholder="Barcode"
                        />
                    </div>
                    <div class="w-full max-w-[100px]">
                        <label for="i-code" class="block text-gray-600 font-medium mb-1"
                        >Itemcode</label
                        >
                        <input
                            id="item_code"
                            name="item_code"
                            type="text"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            placeholder="Itemcode"
                            readonly
                        />
                    </div>
                    <div class="w-full max-w-[230px]">
                        <label
                            for="description"
                            class="block text-gray-600 font-medium mb-1"
                        >Description</label
                        >
                        <input
                            id="description"
                            name="description"
                            type="text"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                            placeholder="Description"
                            readonly
                        />
                        <input type="hidden" id="margin_hidden" name="margin_hidden">
                    </div>
                    <div class="w-full max-w-[100px]">
                        <label
                            for="pcs"
                            class="block text-gray-600 font-medium mb-1"
                        >Pcs</label
                        >
                        <input
                            id="pcs"
                            name="pcs"
                            type="number"
                            min="1"
                            onkeyup="calcPiceses()"
                            class="no-arrows border w-full border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md"
                            placeholder="Pcs"
                        />
                    </div>
                    <div class="w-full max-w-[90px]">
                        <label for="pRate" class="block text-gray-600 font-medium mb-1"
                        >S Rate</label
                        >
                        <input
                            id="sRate"
                            name="sRate"
                            type="number"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md dark-f"
                            placeholder="S Rate"
                            readonly
                        />
                    </div>
                    <div class="w-full max-w-[90px]">
                        <label
                            for="rAmount"
                            class="block text-gray-600 font-medium mb-1"
                        >Amount</label
                        >
                        <input
                            id="rAmount"
                            name="rAmount"
                            type="number"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md dark-f"
                            placeholder="Amount"
                            readonly
                            style="font-size: 14px"
                        />
                    </div>
                    <div class="w-full max-w-[90px]">
                        <label for="less" class="block text-gray-600 font-medium mb-1"
                        >Less</label
                        >
                        <input
                            id="rLess"
                            name="rLess"
                            type="number"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md dark-f"
                            placeholder="Less"
                            readonly
                        />
                    </div>
                    <div class="w-full max-w-[90px]">
                        <label for="rDics" class="block text-gray-600 font-medium mb-1"
                        >Dics %</label
                        >
                        <input
                            id="rDics"
                            name="rDics"
                            type="number"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md dark-f"
                            placeholder="Dics %"
                            readonly
                            {{--onblur="add_row_in_table()"--}}
                        />
                    </div>
                    <div class="w-full max-w-[90px]">
                        <label for="lRate" class="block text-gray-600 font-medium mb-1"
                        >L Rate</label
                        >
                        <input
                            id="lRate"
                            name="lRate"
                            type="number"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md dark-f"
                            placeholder="L Rate"
                            readonly
                        />
                    </div>
                    <div class="w-full max-w-[100px]">
                        <label
                            for="gAmount"
                            class="block text-gray-600 font-medium mb-1"
                        >G Amount</label
                        >
                        <input
                            id="gAmount"
                            name="gAmount"
                            type="number"
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-2 py-1 rounded-md dark-f"
                            placeholder="G Amount"
                            readonly
                            style="font-size: 14px;"
                        />
                    </div>
                    <div class="form-check mt-5">
                        <input class="form-check-input" type="checkbox" name="auto" id="auto">
                        <label class="form-check-label" for="auto">
                            Auto
                        </label>
                    </div>


                </div>
                {{-- </div>


                     <div class="bg-white rounded-xl px-5 py-2 block mt-2">--}}

                <div class="flex gap-3 flex-wrap items-end overflow-x-auto pb-3">
                    {{--chat--}}
                    <div
                        class="flex-grow flex-shrink-0 main-table table-wrapper"
                        style="max-height:250px; overflow-y:auto; border:1px solid #ccc;  direction:rtl; height: 250px;"
                        id="tableContainer"

                    >
                        <table
                            class="table-auto w-full border-collapse border text-sm table-scrollbar"
                            id="myTable"
                            style="direction:ltr; width:100%;"
                        >
                            <thead
                                class="bg-gray-50 text-gray-600 font-medium"
                                style="position:sticky; top:0; background:#f8f9fa; z-index:2;"
                            >
                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-left">Sr #</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Barcode</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">P Item Code</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Description</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Godown</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Pcs</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">S Rate</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Amount</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Less / pcs</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Dis / pcs</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">L Rate</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">G Amount</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Less</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Dis %</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Action</th>
                            </tr>
                            </thead>

                            <tbody id="searchTable">

                            </tbody>
                        </table>
                    </div>



                    {{--chat--}}

                </div>
                {{-- </div>
                   <div class="bg-white rounded-xl px-5 py-2 block mt-2">--}}
                <div class="flex gap-5 flex-wrap mt-4">
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
                                <span class="text-xs font-medium text-indigo-400 underline"
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
                                    class="block text-xs font-medium text-indigo-400 underline"
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

                                <span class="block text-xs font-medium text-indigo-400 w-20 underline">
            Bin
        </span>

                                <!-- Counter Badge -->
                                <span class="absolute -top-2 -right-2 bg-indigo-400 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg" style="position: absolute; margin-top: -57px; margin-left: 67px; " id="bin-counter">0</span>
                            </button>

                            <button
                                class="flex items-center justify-center gap-2 flex-col w-20 cursor-pointer transition-colors hover:bg-indigo-50 h-20 p-2 border-2 border-dashed border-indigo-300 rounded-xl relative"
                                type="button"
                                onclick="openModal(event, 'comment-model')"
                                style="width: 70px;"
                            >
                                <i class="fa-solid fa-comment text-1xl text-indigo-400"></i>

                                <span class="block text-xs font-medium text-indigo-400 underline">
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

                            <button class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600" type="reset" onclick="location.reload();" > <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reset </button>

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
                                <i data-feather="codesandbox" class="w-4 h-4 mr-3"></i>
                                QR Code
                            </button>

                            <button
                                class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                                type="button"
                                onclick="openModal(event, 'update-model')"
                            >
                                <i data-feather="trash-2" class="w-4 h-4 mr-3"></i>
                                Delete
                            </button>

                        </div>

                    </div>









                    <div class="flex-grow md:flex-1 ">

                        <div class="flex items-center flex-wrap sm:flex-nowrap gap-3 justify-end">

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

                                    </div>
                                </div>
                                {{--3rd--}}
                                <div class="flex items-center justify-end gap-4" style="margin-top: 10px;">


                                </div>
                            </div>
                            {{--<div class="bg-gray-100 p-6 rounded-lg shadow-md grid grid-cols-3 gap-4">
                                <div class="bg-blue-500 text-white p-4 rounded">Column 1</div>
                                <div class="bg-green-500 text-white p-4 rounded">Column 2</div>
                                <div class="bg-red-500 text-white p-4 rounded">Column 3</div>
                            </div>--}}




                            <div class="flex flex-col gap-1 w-full max-w-[187px]">
                                <label for="freight" class="text-gray-600 font-medium"
                                >Freight</label
                                >
                                <input
                                    oninput="calcTable()"
                                    id="total_margin"
                                    name="total_margin"
                                    type="number"
                                    placeholder="Freight"
                                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                                    required
                                    readonly
                                />
                            </div>
                            <div class="flex flex-col gap-1 w-full max-w-[187px]">
                                <label for="paid_amount" class="text-gray-600 font-medium"
                                >Paid Amount</label
                                >
                                <input
                                    oninput="calcTable()"
                                    id="paid_amount"
                                    name="paid_amount"
                                    type="number"
                                    placeholder="Paid Amount"
                                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

                                />
                            </div>
                            <div class="flex flex-col gap-1 w-full max-w-[187px]">
                                <label
                                    for="total_less2"
                                    class="text-gray-600 font-medium"
                                >Total Less</label
                                >
                                <input
                                    oninput="calcTable()"
                                    id="total_less2"
                                    name="total_less2"
                                    type="text"
                                    placeholder="Total Less"
                                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md c-field"

                                />
                            </div>
                        </div>
                        <div class="flex items-center justify-end flex-wrap sm:flex-nowrap gap-3">

                            <div>



                            </div>


                            <div class="flex flex-col gap-1 w-full max-w-[187px]">
                                <label for="total_profit2" class="text-gray-600 font-medium"
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
                                    type="text"
                                    placeholder="Total Amount"
                                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                                    required
                                    readonly
                                />
                            </div>
                            <div class="flex flex-col gap-1 w-full max-w-[187px]">
                                <label
                                    for="previous_balance"
                                    class="text-gray-600 font-medium"
                                >Previous Balance</label
                                >
                                <input
                                    id="previous_balance"
                                    name="previous_balance"
                                    type="number"
                                    placeholder="Previous Balance"
                                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                                    required
                                    readonly
                                />

                            </div>

                            <div class="flex flex-col gap-1 w-full max-w-[187px]">
                                <label
                                    for="total_balance"
                                    class="text-gray-600 font-medium"
                                >Total Balance</label
                                >
                                <input
                                    id="total_balance"
                                    name="total_balance"
                                    type="number"
                                    placeholder="Total Balance"
                                    class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md dark-f"
                                    required
                                    readonly
                                />

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            {{--<div class="mt-8 flex items-center gap-2 justify-end">
              <div class="flex items-center flex-wrap gap-3"></div>
            </div>--}}
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
                            >S Rate</label
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
        id="bin-model"
        class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
    >
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-[1300px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
            style="scrollbar-width: none"
        >
            <div id="modal-content" class="text-gray-700">
                <div class="d-flex">
                    <h3 class="text-gray-600 text-xl font-medium mb-6">Bin Item</h3>
                    <div class="popup_close">
                        <i class="fas fa-close" onclick="closeModal(event, 'bin-model')"></i>
                    </div>
                </div>

                <div class="flex gap-3 flex-wrap sm:flex-nowrap items-end overflow-x-auto pb-3">
                    <div class="flex-grow flex-shrink-0">
                        <table class="table-auto w-full border-collapse border text-sm bin-table">
                            <thead class="bg-gray-50 text-gray-600 font-medium">

                            <tr>
                                <th class="border border-gray-200 px-4 py-2 text-left">Sr #</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Barcode</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">P Item Code</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Description</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Godown</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Pcs in Pkt</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Pcs</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">S Rate</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Amount</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Less / pcs</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Dis / pcs</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">L Rate</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">G Amount</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Less</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Total Dis %</th>
                                <th class="border border-gray-200 px-4 py-2 text-left">Action</th>
                            </tr>

                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 justify-end text-sm mt-14">
                <button
                    class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                    onclick="closeModal(event, 'bin-model')"
                >
                    Close
                </button>
            </div>
        </div>
    </div>



    {{--delete and update model--}}
    <div
        id="update-model"
        class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
    >
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-[700px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
            style="scrollbar-width: none"
        >
            <form  class="block mb-7 space-y-5" id="comment_form"  method="POST">
                <div class="text-gray-700">

                    <div class="d-flex">
                        <h3 class="text-gray-600 text-xl font-medium mb-6">Comment Model</h3>
                        <div class="popup_close">
                            <i class="fas fa-close" onclick="closeModal(event, 'update-model')"></i>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="search-item" class="text-gray-600 font-medium"
                        >Comment</label
                        >
                        @csrf
                        <input type="hidden" name="ud_check" id="ud_check" value="">
                        <input type="hidden" name="ud_invoice_id" id="ud_invoice_id" value="">
                        <input type="hidden" name="ud_invoice" value="purchase_invoice">
                        <input type="hidden" name="ud_type" id="ud_type" value="delete">
                        <textarea
                            class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md search-input"
                            name="ud_comment"
                            id="ud_comment"
                            rows="6"
                        ></textarea>

                    </div>


                </div>
                <div class="flex items-center gap-3 justify-end text-sm mt-14">

                    <button
                        class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                        type="submit"
                    >
                        <i data-feather="save" class="w-4 h-4 mr-3"></i>
                        <span id="comment_save"> Save</span>
                    </button>

                    <button
                        class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                        type="button"
                        onclick="closeModal(event, 'comment-model')"
                    >
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div
        id="comment-model"
        class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
    >
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-[700px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
            style="scrollbar-width: none"
        >
            <form  class="block mb-7 space-y-5" id="comment_form"  method="POST">
                <div class="text-gray-700">

                    <div class="d-flex">
                        <h3 class="text-gray-600 text-xl font-medium mb-6">History</h3>
                        <div class="popup_close">
                            <i class="fas fa-close" onclick="closeModal(event, 'comment-model')"></i>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1" >
                        <div class="overflow-x-auto shadow-md rounded-lg bg-white">
                            <table class="min-w-full text-sm text-left text-gray-700" style="width: 100%">
                                <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
                                <tr>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3" width="60%">Comment</th>
                                    <th class="px-4 py-3">Added By</th>
                                    <th class="px-4 py-3">Type</th>
                                </tr>
                                </thead>
                                <tbody id="invoiceItemsBody"></tbody>
                            </table>
                        </div>


                    </div>


                </div>

            </form>
        </div>
    </div>


    {{--payment method model--}}

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
                            <select class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md" {{--class="c_selectize"--}} id="bank" name="bank">
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
                            <select class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md" {{--class="c_selectize"--}} id="bt_to" name="bt_to">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        const input = document.getElementById('search');
        const table = document.getElementById('searchTable');
        const rows = table.getElementsByTagName('tr');

        input.addEventListener('keyup', function () {

            const filter = input.value.toLowerCase();

            for (let i = 0; i < rows.length; i++) { // start from 1 to skip header
                //console.log('ff');
                const nameCell = rows[i].getElementsByTagName('td')[1]; // column index 0 (Name)

                if (nameCell) {
                    const text = nameCell.textContent || nameCell.innerText;
                    rows[i].style.display = text.toLowerCase().includes(filter) ? '' : 'none';
                }
            }
        });
    </script>
    <script>
        // ensure meta tag exists: <meta name="csrf-token" content="{{ csrf_token() }}">




        $('#comment_form').on('submit', function(e) {
            e.preventDefault();

            var ud_check = $('#ud_check').val();   // <-- FIXED

            if (ud_check == 'update') {
                save_invoice();
            }

            $("#comment_save").attr("disabled", true);

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('addComment') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    console.log(response);
                    $("#comment_save").text("Reloading");
                    $("#comment_save").attr("disabled", false);

                    $("#up_comment").val('');
                    closeModal(event, 'update-model');

                    toastr.success('Comment Added Successfully!', 'Success', {
                        timeOut: 600,
                        onHidden: function() {
                            location.reload();
                        }
                    });
                },

                error: function(xhr) {
                    $("#comment_save").attr("disabled", false);

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<ul>';

                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });

                        errorHtml += '</ul>';
                        $('#response').html(errorHtml);
                    }
                }
            });
        });


    </script>

    <script>

        jQuery(document).ready(function() {
            $("#party_name")[0].selectize.focus();

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.which === 13) {
                    e.preventDefault();

                    //var activeEl = document.activeElement;
                    var activeEl = jQuery(document.activeElement);
                    var form = activeEl[0].form; // access raw DOM element using [0]

                    // 1️⃣ Special case: jump from #party_name → #salesman
                    if (activeEl.attr('id') === 'party_name-selectized') {
                        //window.alert(activeEl.attr('id'));
                        $("#salesman")[0].selectize.focus();
                        //document.getElementById('salesman').focus();
                        return;
                    }
                    if (activeEl.attr('id') === 'pcs') {
                        $("#rbarcode").focus();
                        return;
                    }

                    if (activeEl.attr('id') === 'remarks') {
                        $("#rbarcode").focus();
                        return;
                    }

                    // 2️⃣ Get all visible & focusable fields in the form
                    /*var focusable = $(form)
                        .find("a, button, input, select, textarea, [tabindex]:not([tabindex='-1'])")
                        .filter(":visible:not([disabled]):not([readonly])");*/
                    var focusable = jQuery("a, button, input, select, textarea, [tabindex]:not([tabindex='-1'])")
                        .filter(":visible:not([disabled]):not([readonly])");

                    var index = focusable.index($(activeEl));

                    if (index > -1) {
                        var nextIndex = index + 1;

                        // 3️⃣ If last field reached, submit the form
                        if (nextIndex >= focusable.length) {
                            form.submit(); // or trigger custom validation
                        } else {
                            focusable.eq(nextIndex).focus();
                        }
                    }
                }
            });

        });

    </script>

    <script>

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
            $("#salesman")[0].selectize.setValue("");
            $("#salesman")[0].selectize.setValue("");
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
            //$('#item_code')[0].selectize.clearOptions();
            $("#save").text("Save");

            $('.main-table tbody').empty();
            $('.bin-table tbody').empty();



            $('#active').prop('checked', true);
            /*$('#id')[0].style.setProperty('border-color', '#aaa', 'important');
            $('#barcode')[0].style.setProperty('border-color', '#aaa', 'important');
            $('#description')[0].style.setProperty('border-color', '#aaa', 'important');*/

        }
        /*search item*/
        $(document).ready(function () {

            function item_search(currentField){
                let searchParams = {
                    search_item: $('#search_item').val(),
                    //search_barcode: $('#search_barcode')[0].selectize.getValue() || '',
                    //search_pic: $('#search_pic')[0].selectize.getValue() || '',
                    //search_define_item: $('#search_define_item')[0].selectize.getValue() || '',
                    // search_define_size: $('#search_define_size')[0].selectize.getValue() || '',
                    //search_party: $('#search_party')[0].selectize.getValue() || '',
                    //search_purchase_rate: $('#search_purchase_rate')[0].selectize.getValue() || '',
                    //search_column: currentField.data("search"),
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
    </script>

    <script>
        function syncPartyId(source, targetId) {
            /*if (isSyncing) return; // Prevent re-triggering
            isSyncing = true;*/
            const target = document.getElementById(targetId);
            if(target.tagName === "SELECT"){
                $("#"+targetId)[0].selectize.setValue(source.value);
                $("#party_number")[0].selectize.setValue(source.value);
                $("#party_name")[0].selectize.setValue(source.value);
            }else{
                target.value = source.value;
                $("#party_number")[0].selectize.setValue(source.value);
                $("#party_name")[0].selectize.setValue(source.value);
            }
            get_id_party(source.value);
            isSyncing = false;
        }
        function calcPiceses(){
            var pcs = $('#pcs').val();
            var sRate = $('#sRate').val();
            var lRate = $('#lRate').val();
            var party_less = $('#rLess').val();
            var party_discount = $('#rDics').val();
            if(isNaN(pcs)){
                pcs = 0;
            }
            if(isNaN(sRate)){
                sRate = 0;
            }
            //window.alert(party_less);
            if(isNaN(party_less)){
                party_less = 0;
            }
            if(isNaN(party_discount)){
                party_discount = 0;
            }
            if(isNaN(lRate)){
                lRate = 0;
            }

            var amount = sRate * pcs;
            var grand_amount =  pcs * lRate;

            $('#rAmount').val(amount);
            $('#gAmount').val(grand_amount);
        }

        function getItem(barcode){
            $('#loader').show();
            $.ajax({
                url: '{{'getItem/'}}'+barcode,
                type: 'GET',
                date:{
                    barcode: barcode
                },
                success: function (response) {

                    if (response) {
                        var data = response;

                        if(Object.keys(data).length > 0){
                            //console.log(response);
                            //console.log(data.item_code);
                            $('#item_code').val(data.item_code);
                            //window.alert(data.item_code);
                            $('#description').val(data.description);
                            $('#margin_hidden').val(data.margin_field);

                            $('#sRate').val(data.sale_rate);
                            var sale_rate = data.sale_rate;
                            if(isNaN(sale_rate)){
                                sale_rate = 0;
                            }
                            var party_less = data.party_less;
                            if(isNaN(party_less)){
                                party_less = 0;
                            }
                            var party_discount = data.party_discount;
                            if(isNaN(party_discount)){
                                party_discount = 0;
                            }

                            var per = (sale_rate/100) * party_discount;
                            //console.log(t_pcs);

                            var l_rate = sale_rate - (party_less + per);
                            l_rate = parseFloat(l_rate).toFixed(2);
                            //window.alert(l_rate);

                            $('#rDics').val(data.party_discount);
                            $('#rLess').val(party_less);
                            $('#lRate').val(l_rate);

                            $('#loader').hide();

                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        document.getElementById("pcs").addEventListener("keydown", function(event) {
            // Check if the key pressed is Enter
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent form submission (optional)
                add_row_in_table(); // Call your function
                //$('#rbarcode').focus();
                // console.log($('#rbarcode').length);

            }
        });
        function add_row_in_table(){
            //$('#rbarcode').focus();
            var rbarcode = $('#rbarcode').val();
            var item_code = $('#item_code').val();
            var description = $('#description').val();
            var godown = $('#godown').val() || 0;
            if(godown != 0){
                var godown_name  = $('#godown option:selected').text();
            }else{
                var godown_name  = '-';
            }
            //var godown_name  = $('#godown option:selected').text() || '-';
            var pcs = Number($('#pcs').val()) || 0;
            var sRate = Number($('#sRate').val()) || 0;
            var rAmount = Number($('#rAmount').val()) || 0;
            var rDics = Number($('#rDics').val()) || 0;
            var rLess = Number($('#rLess').val()) || 0;
            var margin_hidden = Number($('#margin_hidden').val()) || 0;
            var gt_less = 0;
            var gt_disc = 0;

            var perDiscAmount = rAmount/100 * rDics;

            if(margin_hidden === ''){
                margin_hidden = 0;
            }


            if(rLess == null || isNaN(rLess)){
                rLess = 0;
            }
            gt_less = pcs * rLess;

            if(isNaN(rDics)){
                rDics = 0;
            }
            var rDics_val = sRate/100 * rDics;
            rDics_val = parseFloat(rDics_val).toFixed(2);
            if(rDics_val == null || isNaN(rDics_val)){
                rDics_val = 0;
            }

            var lRate = sRate - (parseFloat(rLess) + parseFloat(rDics_val));
            lRate = parseFloat(lRate).toFixed(2);
            gt_disc = pcs * rDics_val;
            var t_margin = margin_hidden * pcs;
            var g_total = gt_less + gt_disc;

            var perAgeDis = (g_total/rAmount) *100;
            perAgeDis = perAgeDis.toFixed(2);

            var gAmount = lRate * pcs;
            gAmount = parseFloat(gAmount).toFixed(2);
            var totalRows = document.querySelectorAll('#myTable tr').length;
            //window.alert(rbarcode);
            var table_id = totalRows;
            if(rbarcode !== ''){
                var newRow =
                    "<tr>" +
                    "<input type='hidden' name='invoice_party_less_total[]' value='" + (g_total ?? '') + "' />" +
                    "<input type='hidden' name='invoice_less_per_pcs[]' id='itableLess2-"+table_id+"' value='" + rLess + "' /></td>" +
                    "<input type='hidden' name='invoice_party_total_discount[]' value='" + (perDiscAmount ?? '') + "' />" +
                    "<input type='hidden' name='invoice_party_discount[]' value='" + (rDics ?? '') + "' />" +
                    /*marin field*/"<input type='hidden' name='invoice_margin_field[]' value='" + ( '') + "' />" +
                    "<input type='hidden' name='item_id[]' value='" + (item_code ?? '') + "' class='item-id' />" +
                    "<input type='hidden' name='invoice_party_less_per_pcs[]' id='itableLess-"+table_id+"' value='" + (rLess ?? '') + "' class='party_less_post' />" +
                    "<input type='hidden' name='invoice_barcode[]' value='" + (rbarcode ?? '') + "' />" +
                    "<input type='hidden' name='invoice_party_item_code[]' value='" + (item_code ?? '') + "' />" +
                    "<input type='hidden' name='invoice_description[]' value='" + (description ?? '') + "' />" +
                    "<input type='hidden' name='invoice_godown[]' value='" + ( godown_name) + "' />" +
                    "<input type='hidden' name='invoice_total_pcs[]'  id='itablePcs-"+table_id+"' value='" + (pcs ?? '') + "' />" +
                    "<input type='hidden' name='invoice_purchase_rate[]' id='itablesRate-"+table_id+"' value='" + (sRate ?? '') + "' />" +
                    "<input type='hidden' name='invoice_amount[]' id='itableAmount-"+table_id+"' value='" + (rAmount ?? '') + "' />" +
                    "<input type='hidden' name='invoice_discount_per_pcs[]' id='itableDisc-"+table_id+"' value='" + (rDics_val ?? '') + "' />" +
                    "<input type='hidden' name='invoice_l_rate[]' id='itablelRate-"+table_id+"' value='" + (lRate ?? '') + "' />" +
                    "<input type='hidden' name='invoice_gross_amount[]' id='itablegAmount-"+table_id+"' value='" + (gAmount ?? '') + "' />" +
                    "<input type='hidden' name='invoice_total_less[]' id='itableTotalLess-"+table_id+"' value='" + (g_total.toFixed(2) ?? '') + "' />" +
                    "<input type='hidden' name='invoice_total_dis_percent[]' id='itableTotalDisc-"+table_id+"' value='" + (perAgeDis ?? '') + "' />" +

                    // Visible columns
                    "<td class='table_id'>" + (table_id ?? '-') + "</td>" +
                    "<td>" + (rbarcode ?? '-') + "</td>" +
                    "<td>" + (item_code ?? '-') + "</td>" +
                    "<td>" + (description ?? '-') + "</td>" +
                    "<td>" + ( godown_name) + "</td>" +
                    "<td class='pcs_table' contenteditable='true' id='pcs-"+table_id+"' oninput='calcPiceses()'>" + (pcs ?? '-') + "</td>" +
                    "<td id='tablesRate-"+table_id+"'>" + (sRate ?? '-') + "</td>" +
                    "<td class='amount_table' id='tableAmount-"+table_id+"'>" + (rAmount ?? '-') + "</td>" +
                    "<td class='less_table' id='tableLess-"+table_id+"'>" + (rLess ?? '-') + "</td>" +
                    "<td class='disc_table' id='tableDisc-"+table_id+"'>" + (rDics ?? '-') + "</td>" +
                    "<td id='tablelRate-"+table_id+"'>" + (lRate ?? '-') + "</td>" +
                    "<td class='gamount_table' id='tablegAmount-"+table_id+"'>" + (gAmount ?? '-') + "</td>" +
                    "<td class='total_less_table' id='tableTotalLess-"+table_id+"'>" + (g_total.toFixed(2) ?? '-') + "</td>" +
                    "<td class='total_less_discount' id='tableTotalDisc-"+table_id+"'>" + (perAgeDis ?? '-') + "</td>" +

                    "<td><i onclick='deleteItemRow(this)' class='fas fa-trash text-danger del-icon'></i></td>" +
                    "</tr>";


                $(".main-table tbody").append(newRow);

                calcTable();
                $('#rbarcode').val('');
                $('#item_code').val('');
                $('#description').val('');
                $('#pcs').val('');
                $('#sRate').val('');
                $('#rAmount').val('');
                $('#rDics').val('');
                $('#rLess').val('');
                $('#lRate').val('');
                $('#gAmount').val('');


                const tableContainer = document.getElementById('tableContainer');
                tableContainer.scrollTop = tableContainer.scrollHeight;
            }else{
                window.alert('barcode empty!');
            }


        }
        function tableCalc(th){
            var str = th.id;
            let parts = str.split('-');
            let rowNo = parts[1];
            var tableQty = document.getElementById('tableQty-'+rowNo).innerHTML;
            var tableLess = document.getElementById('tableLess-'+rowNo).innerHTML;
            var tablepRate = document.getElementById('tablepRate-'+rowNo).innerHTML;
            var tableDisc = document.getElementById('tableDisc-'+rowNo).innerHTML;

            if (typeof tableQty !== 'number' && isNaN(tableQty)) {
                tableQty = 0;
            }
            if (typeof tableLess !== 'number' && isNaN(tableLess)) {
                tableLess = 0;
            }
            if (typeof tablePkt !== 'number' && isNaN(tablePkt)) {
                tablePkt = 0;
            }
            if (typeof tablepRate !== 'number' && isNaN(tablepRate)) {
                tablepRate = 0;
            }
            if (typeof tableDisc !== 'number' && isNaN(tableDisc)) {
                tableDisc = 0;
            }

            var totalPcs = tableQty*tablePkt;
            //window.alert(totalPcs);
            var amount = totalPcs * tablepRate;
            var lRate = tablepRate - (parseInt(tableLess) + parseInt(tableDisc));
            lRate = parseFloat(lRate).toFixed(2);
            if(isNaN(lRate)){
                lRate = 0;
            }
            document.getElementById('itableQty-'+rowNo).value = tableQty;
            document.getElementById('itablePkt-'+rowNo).value = tablePkt;
            //document.getElementById('tableLess-'+rowNo).innerHTML = tableLess;
            document.getElementById('itableLess-'+rowNo).value = tableLess;

            document.getElementById('pcs_table-'+rowNo).innerHTML = totalPcs;
            document.getElementById('itablePcs-'+rowNo).value = totalPcs;

            document.getElementById('tableAmount-'+rowNo).innerHTML = amount;
            document.getElementById('itableAmount-'+rowNo).value = amount;

            /*document.getElementById('tablelRate-'+rowNo).innerHTML = lRate;
            document.getElementById('itablelRate-'+rowNo).value = lRate;*/

            document.getElementById('itablelRate-'+rowNo).value = tablepRate - (tableLess + tableDisc);
            document.getElementById('tablelRate-'+rowNo).innerHTML = tablepRate - (tableLess + tableDisc);

            document.getElementById('tablegAmount-'+rowNo).innerHTML = amount - ((totalPcs * tableLess) + (totalPcs * tableDisc));
            document.getElementById('itablegAmount-'+rowNo).value = amount - ((totalPcs * tableLess) + (totalPcs * tableDisc));

            document.getElementById('tableTotalLess-'+rowNo).innerHTML = (totalPcs * tableLess) + (totalPcs * tableDisc);
            document.getElementById('itableTotalLess-'+rowNo).value = (totalPcs * tableLess) + (totalPcs * tableDisc);

            document.getElementById('tableTotalDisc-'+rowNo).innerHTML = ((totalPcs * tableLess) + (totalPcs * tableDisc))/amount * 100;
            document.getElementById('itableTotalDisc-'+rowNo).value = ((totalPcs * tableLess) + (totalPcs * tableDisc))/amount * 100;
            calcTable();

        }
        function deleteItemRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            calcTable();
            updateSerials();
        }
        function updateSerials() {
            const table = document.getElementById("searchTable");
            const rows = table.rows;

            // skip header row
            for (let i = 0; i < rows.length; i++) {
                var c = i;
                rows[i].cells[0].innerText = ++c; // reset serial
            }

            // also reset serial counter
            serial = rows.length;
        }
        function disableAllExceptOne(formId, exceptId) {
            // Get form
            let form = document.getElementById(formId);

            // Get all input/select/textarea inside the form
            let fields = form.querySelectorAll("input, select, textarea, button");

            fields.forEach(function(field) {
                // Disable all except the target field
                if (field.id !== exceptId) {
                    field.disabled = true;
                    field.style.border = "2px solid red";
                    field.style.backgroundColor = '#ddd';
                } else {
                    field.disabled = false;
                    field.style.border = "";
                    field.style.backgroundColor = '';
                }
            });
        }
        function enableInvoiceForm(form_id) {
            let form = document.getElementById(form_id);

            let fields = form.querySelectorAll("input, select, textarea, button");

            fields.forEach(function(field) {
                field.disabled = false;
                field.style.border = "";
                field.style.backgroundColor = '';
            });
        }
        function get_invoice(value, type) {
            var pass_value = value;
            var pass_type = type;
            //window.alert(pass_type);
            $.ajax({
                url: "{{ route('ajax.sale_invoice.search') }}",
                type: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    value: value,
                    type: type,
                },
                success: function(response) {
                    //window.alert(response);
                    console.log(response);
                    if (response) {
                        var data = (response);
                        /*if (response.comments.length > 0) {
                            var row = '';
                            var comment_counter = 0;
                            response.comments.forEach(function(c) {
                                //console.log("Comment:", c.comment);
                                const dateOnly = new Date(c.created_at).toLocaleDateString();
                                row += `
                                    <tr>
                                    <td class="px-4 py-3">${dateOnly}</td>
                                    <td class="px-4 py-3" width="70%">${c.comment}</td>
                                    <td class="px-4 py-3">${c.user_name}</td>
                                    <td class="px-4 py-3">${c.type}</td>
                                    </tr>

                                    `;
                                comment_counter++;
                            });
                            $('#invoiceItemsBody').html(row);
                            $('#comment-counter').html(comment_counter);

                        } else {
                            console.log("No comments found");
                        }*/
                        //console.log(data);

                        if (Object.keys(data).length > 0) {

                            /*if(data.invoice.status === 1){
                                disableAllExceptOne('invoice_form', 'bill_no');
                            }else{
                                enableInvoiceForm('invoice_form');
                            }*/

                            $("#invoice_save").text("Update");
                        }else{
                            $("#invoice_save").text("Save");
                        }
                        //window.alert(data.invoice.godown.name);
                        get_id_party(data.party_id);
                        $('#party_id').val(data.party_id);
                        $("#party_name")[0].selectize.setValue(data.party_id);
                        $('#ud_invoice_id').val(data.id);
                        $("#salesman")[0].selectize.setValue(data.salesman);
                        $('#current_date').val(data.date);
                        $('#bill_no').val(data.bill_no);
                        $('#bilty_no').val(data.bilty_no);
                        $('#party_inv_no').val(data.party_inv_no);
                        $('#vr_no').val(data.vr_no);
                        $('#godown').val(data.godown_id);
                        $('#party_inv_date').val(data.party_inv_date);
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
                        $('#bank_account_title').val(data.bank_account_title);
                        $('#bank_account_number').val(data.bank_account_number);
                        $('#bank_amount').val(data.bank_amount);
                        $('#bank_remarks').val(data.bank_remarks);
                        $('#cheque_bank').val(data.cheque_bank);
                        $('#cheque_amount').val(data.cheque_amount);
                        $('#cheque_date').val(data.cheque_date);
                        $('#cheque_remarks').val(data.cheque_remarks);
                        $('#bt_from').val(data.bt_from);
                        //$("#bt_to")[0].selectize.setValue(data.bt_to);
                        $('#bt_account_title').val(data.bt_account_title);
                        $('#bt_account_number').val(data.bt_account_number);
                        $('#bt_amount').val(data.bt_amount);
                        $('#bt_remarks').val(data.bt_remarks);
                        $('#payment_total_amount').val(data.payment_total_amount);

                        $('input[name="payment_status"][value="' + data.payment_status + '"]').prop('checked', true);
                        //$('#godown').val(data.godown_id);
                        $(".main-table tbody").empty();
                        var items = data.sale_invoice_lists;
                        var t_less = 0;
                        var t_disc = 0;
                        var grand_tot = 0;
                        $(".bin-table tbody").empty();

                        var bin_counter = 0;
                        for (var i = 0; i < items.length; i++) {
                            var row = items[i];
                            //console.log(row);
                            if(row.party_discount === null){
                                var dis = 0;
                            }else{
                                var dis = row.party_discount;
                            }
                            if(data.godown !== null){
                                var godown = data.godown.name;
                            }else{
                                var godown = '';
                            }
                            var party_discount =dis;
                            var barcode = row.barcode;
                            var partyItemCode = row.item_code;
                            var description = row.description;
                            var godown = godown;
                            var packetQty = row.packet_qty;
                            var piecesInPacket = row.pieces_in_packet;
                            var totalPieces = row.total_pieces;
                            var inv_disc_perc = row.inv_disc_perc;
                            var purchaseRate = row.purchase_rate;
                            var partyLess = row.party_less;
                            var margin_field = margin = row.item?.margin_field;
                            //window.alert(margin_field);
                            var table_id = i + 1;
                            /*var wholesale_profit = row.wholesale_profit;
                            var parts = wholesale_profit.split(" | ");*/
                            if(party_discount === ''){
                                party_discount = 0;
                            }
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
                            if(isNaN(perAgeDis)){
                                perAgeDis = 0.00;
                            }

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
                            //window.alert(margin_field);
                            if(isNaN(t_amrgin)){
                                t_amrgin = 0.00;
                            }
                            var row_id = row.id;
                            if(row.status != 1){
                                if(row.status == 2){
                                    var sty = "style='background-color: #C6D2FF;'";
                                }else{
                                    var sty = "style='background-color: #FFFFFF;'";
                                }
                                //window.alert(row.sale_rate);
                                var newRow =
                                    "<tr "+sty+">" +
                                    "<input type='hidden' name='invoice_party_less_total[]' id='tableLess-"+table_id+"' value='" + (row.party_less_total ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_party_total_discount[]' value='" + (row.party_total_discount ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_party_discount[]' value='" + (row.party_discount ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_margin_field[]' value='" + (row.margin_field ?? '') + "' />" +
                                    "<input type='hidden' name='item_id[]' value='" + (row.item_id ?? '') + "' class='item-id' />" +
                                    "<input type='hidden' name='invoice_party_less_per_pcs[]' id='itableLess-"+table_id+"' value='" + (row.less_per_pcs ?? '') + "' class='party_less_post' />" +
                                    "<input type='hidden' name='invoice_packet_qty[]' id='itableQty-"+table_id+"' value='" + (row.packet_qty ?? '') + "' class='item-qty' />" +
                                    "<input type='hidden' name='invoice_barcode[]' value='" + (row.barcode ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_party_item_code[]' value='" + (row.party_item_code ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_description[]' value='" + (row.description ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_godown[]' value='" + (row.godown ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_pieces_in_packet[]' id='itablePkt-"+table_id+"' value='" + (row.pieces_in_packet ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_total_pcs[]' id='itablePcs-"+table_id+"' value='" + (row.total_pcs ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_purchase_rate[]' value='" + (row.purchase_rate ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_amount[]' id='itableAmount-"+table_id+"' value='" + (row.amount ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_discount_per_pcs[]' id='itableDisc-"+table_id+"' value='" + (row.discount_per_pcs ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_l_rate[]' id='itablelRate-"+table_id+"' value='" + (row.l_rate ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_gross_amount[]' id='itablegAmount-"+table_id+"' value='" + (row.gross_amount ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_margin[]' value='" + (row.margin ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_total_margin[]' value='" + (row.total_margin ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_total_less[]' id='itableTotalLess-"+table_id+"' value='" + (g_total.toFixed(2) ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_total_less[]' id='itableTotalLess-"+table_id+"' value='" + (g_total.toFixed(2) ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_total_dis_percent[]' id='itableTotalDisc-"+table_id+"' value='" + (perAgeDis ?? '') + "' />" +

                                    // Visible columns
                                    "<td class='table_id'>" + (table_id ?? '-') + "</td>" +
                                    "<td>" + (row.barcode ?? '-') + "</td>" +
                                    "<td>" + (row.party_item_code ?? '-') + "</td>" +
                                    "<td>" + (row.description ?? '-') + "</td>" +
                                    "<td>" + (row.godown ?? '-') + "</td>" +
                                    "<td class='pcs_table' id='tablePcs-"+table_id+"'>" + (row.total_pcs ?? '-') + "</td>" +
                                    "<td id='tablesRate-"+table_id+"'>" + (row.sale_rate ?? '-') + "</td>" +
                                    "<td class='amount_table'  id='tableAmount-"+table_id+"'>" + (row.amount ?? '-') + "</td>" +
                                    "<td class='less_table' id='tableTotalLess-"+table_id+"'>" + (row.less_per_pcs ?? '-') + "</td>" +
                                    "<td class='disc_table'  id='tableDisc-"+table_id+"'>" + (row.discount_per_pcs ?? '-') + "</td>" +
                                    "<td id='tablelRate-"+table_id+"'>" + (row.l_rate ?? '-') + "</td>" +
                                    "<td class='gamount_table' id='tablegAmount-"+table_id+"'>" + (row.gross_amount ?? '-') + "</td>" +
                                    "<td class='total_less_table' id='tableTotalLess-"+table_id+"'>" + (g_total.toFixed(2) ?? '-') + "</td>" +
                                    "<td class='total_disc_table' id='tableTotalDisc-"+table_id+"'>" + (g_total.toFixed(3) ?? '-') + "</td>" +
                                    "<td><i onclick='delete_row(this, "+row_id+", "+pass_value+",  \"" + pass_type + "\")' class='fas fa-trash text-danger del-icon'></i></td>" +
                                    "</tr>";
                                $(".main-table tbody").append(newRow);
                            }else{
                                var bin_array = "<tr style='font-size: 15px; text-align: center;'>" +
                                    "<input type='hidden' name='invoice_party_less_total[]' value='" + (row.party_less_total ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_party_total_discount[]' value='" + (row.party_total_discount ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_party_discount[]' value='" + (row.party_discount ?? '') + "' />" +
                                    "<input type='hidden' name='invoice_margin_field[]' value='" + (row.margin_field ?? '') + "' />" +
                                    "<input type='hidden' name='item_id[]' value='" + (row.item_id ?? '') + "' class='item-id' />" +
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
                                    "<td contenteditable='true' id='tableQty-"+table_id+"' oninput='tableCalc(this)'>" + (row.packet_qty ?? '-') + "</td>" +
                                    "<td  contenteditable='true' id='tablePkt-"+table_id+"' oninput='tableCalc(this)'>" + (row.pieces_in_packet ?? '-') + "</td>" +
                                    "<td  id='tablePcs-"+table_id+"'>" + (row.total_pcs ?? '-') + "</td>" +
                                    "<td   id='tableAmount-"+table_id+"'>" + (row.amount ?? '-') + "</td>" +
                                    "<td  contenteditable='true' id='tableLess-"+table_id+"' oninput='tableCalc(this)'>" + (row.less_per_pcs ?? '-') + "</td>" +
                                    "<td   id='tableDisc-"+table_id+"'>" + (row.discount_per_pcs ?? '-') + "</td>" +
                                    "<td id='tablelRate-"+table_id+"'>" + (row.l_rate ?? '-') + "</td>" +
                                    "<td  id='tablegAmount-"+table_id+"'>" + (row.gross_amount ?? '-') + "</td>" +
                                    "<td  id='tableTotalLess-"+table_id+"'>" + (g_total.toFixed(2) ?? '-') + "</td>" +
                                    "<td  id='tableTotalDisc-"+table_id+"'>" + (perAgeDis ?? '-') + "</td>" +
                                    "<td><i onclick='recover_row(this, "+row_id+", "+pass_value+",  \"" + pass_type + "\")' class='fas fa-trash-restore text-danger del-icon'></i></td>" +
                                    "</tr>";
                                $(".bin-table tbody").append(bin_array);
                                bin_counter++;
                            }

                            const tableContainer = document.getElementById('tableContainer');
                            tableContainer.scrollTop = tableContainer.scrollHeight;

                            $('#bin-counter').html(bin_counter);
                        }


                        //window.alert(t_less);
                        /*var t_amount = data.amount;
                        var g_per = (t_disc/t_amount) * 100;
                        $('#total_less').val(t_less);
                        $('#total_disc').val(g_per.toFixed(2) + '% |' +t_disc.toFixed(2));
                        var grand_less = t_less + t_disc;
                        var grand_per = grand_less/t_amount * 100;
                        $('#total_less2').val(grand_per.toFixed(2) + '% |' +grand_less.toFixed(2));

                        var total_margin = 0;
                        $('.total_margin_table').each(function() {
                            total_margin += parseFloat($(this).text());
                        });

                        $("#total_margin").val(total_margin);

                        var freight = parseInt($("#freight").val());
                        if(isNaN(freight)){
                            freight = 0;
                        }
                        var grand_amount = grand_less - freight + total_margin;
                        //window.alert(grand_amount);
                        var t_profit = grand_amount/t_amount * 100;
                        $("#total_profit2").val(t_profit.toFixed(3) + "% | " + grand_amount);*/
                        calcTable();
                        var t_amount = data.amount;
                        var g_per = (t_disc/t_amount) * 100;
                        $('#total_less').val(t_less);
                        $('#total_disc').val(g_per.toFixed(2) + '% |' +t_disc.toFixed(2));
                        var grand_less = t_less + t_disc;
                        var grand_per = grand_less/t_amount * 100;
                        $('#total_less2').val(grand_per.toFixed(2) + '% |' +grand_less.toFixed(2));
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
        /*$('#invoice_form').on('submit', function(e) {
            let invoice_id = $("#invoice_id").val();
            e.preventDefault();
            let formData = new FormData(this);

            jQuery('.c_selectize').each(function() {
                let name = jQuery(this).attr('name');
                let value = jQuery(this).val();
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
                url: "{{ route('purchase.invoice.post') }}",
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
        });*/
        $("#invoice_form").on("submit", function(event) {
            event.preventDefault();
        });
        function save_invoice() {

            let form = $("#invoice_form")[0];
            let formData = new FormData(form);

            jQuery('.c_selectize').each(function() {
                let name = jQuery(this).attr('name');
                let value = jQuery(this).val();

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
                url: "{{ route('sale.invoice.post') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(response) {
                    console.log(response);
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
        }

        /*function save_invoice() {
            let form = $("#invoice_form")[0];
            let formData = new FormData(form);
            window.alert('ff');
            console.log(formData);

            jQuery('.c_selectize').each(function() {
                let name = jQuery(this).attr('name');
                let value = jQuery(this).val();
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
                url: "{{ route('purchase.invoice.post') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);

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
        }*/

        $("#invoice_save").on("click", function () {

            let invoice_id = $("#ud_invoice_id").val();  // hidden field
            console.log(invoice_id);
            if (!invoice_id) {
                save_invoice();
                return false;
            } else {
                $('#ud_check').val('update');
                $('#ud_type').val('update');
                openModal(event, 'update-model');
                return false;
            }
        });

        function delete_row(data, id, value, pass_type){
            $('#loader').show();
            $.ajax({
                url: "{{ route('ajax.purchase.delete') }}",
                type: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    deleteItemRow(data);
                    get_invoice(value, pass_type);
                    get_invoice(id, 'invoice_list');
                    $('#loader').hide();
                    console.log(response);
                }
            });

        }
        function recover_row(data, id, value, pass_type){
            $('#loader').show();
            $.ajax({
                url: "{{ route('ajax.purchase.recover') }}",
                type: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    id: id
                },
                success: function (response) {
                    //window.alert(value);
                    //window.alert(pass_type);
                    deleteItemRow(data);
                    get_invoice(value, pass_type);
                    $('#loader').hide();
                    //console.log(pass_type);
                }
            });

        }
        function get_id_party(value) {
            var name = value;
            //window.alert(value);
            $.ajax({
                url: "{{ route('sale.party.search.id') }}",
                type: 'POST',
                data: {
                    '_token': "{{ csrf_token() }}",
                    value: value,
                },
                success: function(response) {
                    console.log(response);
                    if (response) {
                        var data = response;

                        if (Object.keys(data).length > 0) {
                            $('#city').val(data.party.area.city.name);
                            $('#address').val(data.party.address);
                            $('#area').val(data.party.area.name);
                            $('#mobile').val(data.party.mobile);
                            //window.alert(data.amounts[0].net_amount);
                            var net = data.amounts[0].net_amount;
                            var paid = data.amounts[0].paid_amount;
                            if(isNaN(paid)){
                                paid = 0;
                            }
                            var previous = net - paid;
                            $('#previous_balance').val(previous);
                            $('#total_balance').val(data.amounts.net_amount);
                            //get_areas(data.area_id);
                        }
                    }

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function calcTable() {
            var total_piec = 0;
            $('.pcs_table').each(function() {
                total_piec += parseFloat($(this).text());
            });
            //window.alert(total_margin);
            $("#total_piec").val(total_piec);

            var total_amount = 0;
            $('.amount_table').each(function() {
                total_amount += parseFloat($(this).text());
            });
            //window.alert(total_amount);
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




            var sum = 0;
            var total_less = 0;
            var percentage = 0;
            let rows = document.querySelectorAll(".main-table tr");
            var rowCount = $('.main-table tr').length;
            for(var i = 1; i<rowCount; i++){
                let dis = rows[i].querySelector(".disc_table");
                var dis_text = dis.textContent.trim();
                if(dis_text != '0.00' || dis_text != 0.00){
                    let disc_table = parseFloat(document.getElementById("itableDisc-" + i).value) || 0;
                    let piec_table = rows[i].querySelector(".pcs_table").textContent.trim();

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
                    let piec_table = rows[i].querySelector(".pcs_table").textContent.trim();
                    var tot_value = parseFloat(piec_table) * parseFloat(less_table);

                }
                total_less +=parseFloat(tot_value);

                /*if(isNaN()){
                    var tot_value = 0;

                }else{

                    let piec_table = rows[i].querySelector(".pcs_table").textContent.trim();
                    var tot_value = parseFloat(piec_table) * parseFloat(less_table);
                }
                total_less +=parseFloat(tot_value);*/


            }
            $("#total_less").val(total_less.toFixed(2));


            if(sum != 0){
                var total_disc = (((sum / total_amount) * 100));
            }else{
                var total_disc = 0;
            }
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
            //window.alert(t_amount);
            $("#total_less2").val(valuee.toFixed(3) + "% | " + t_am);
            var grand_amount = t_am - freight;
            var t_profit = (grand_amount/t_amount) * 100;
            $("#total_profit2").val(t_profit.toFixed(3) + "% | " + grand_amount);
            var previous = parseFloat($("#previous_balance").val() || 0);
            var total_bal = net_amount + previous;
            $("#total_balance").val(total_bal.toFixed(2));
            // window.alert("Total Balance: " + total_bal.toFixed(2));
        }

        /*function calcTable() {
            var sum = 0;
            $('.pkt_table').each(function() {
                if(isNaN($(this).text()))
                {
                    sum += 0;
                }
                sum += parseFloat($(this).text());
            });

            $("#total_pkt").val(sum);

            var total_piec = 0;
            $('.piec_table').each(function() {
                total_piec += parseFloat($(this).text());
            });
            var total_margin = 0;
            $('.total_margin_table').each(function() {
                if($(this).text() !== '-'){
                    total_margin += parseFloat($(this).text());
                }

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


            /!*var total_less = 0;
            $('.less_table').each(function() {
                var valuu = parseFloat($(this).text());
                if(isNaN(valuu)){
                    valuu =0;
                }
                total_less += valuu;
            });*!/


            var lesss_sum = 0;
            var total_less = 0;
            var percentage = 0;
            let rows = document.querySelectorAll(".main-table tr");
            var rowCount = $('.main-table tr').length;
            for(var i = 1; i<rowCount; i++){
                let dis = rows[i].querySelector(".disc_table");
                var dis_text = dis.textContent.trim();
                //window.alert(dis_text);
                if(!isNaN(dis_text) && dis_text !== ''){
                    if(dis_text !== '0.00' || dis_text !== 0.00){
                        let disc_table = rows[i].querySelector(".disc_table").textContent.trim();
                        let piec_table = rows[i].querySelector(".piec_table").textContent.trim();

                        var t_value = parseFloat(piec_table) * parseFloat(disc_table);
                        let amount = rows[i].querySelector(".amount_table").textContent.trim();
                        lesss_sum +=parseFloat(t_value);
                    }
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
            //window.alert(lesss_sum);
            $("#total_margin").val(total_margin);
            $("#total_less").val(total_less.toFixed(2));

            if(isNaN(total_margin)){
                total_margin = 0;
            }


            if(isNaN(lesss_sum)){
                var total_disc = 0;
                //var sum = 0;
            }
            //window.alert(sum);
            var total_disc = (((lesss_sum / total_amount) * 100));

            //window.alert(total_disc);


            $("#total_disc").val(total_disc.toFixed(2) + "% |  " + lesss_sum.toFixed(2));
            $("#total_gamount").val($("#total_amount").val() - $("#total_less").val());

            var net_amount = $("#total_gamount").val() - lesss_sum;
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
                var valuee = t_less_per.toFixed(2);
            }else{
                var valuee = 0;
            }
            var t_amount = parseInt($("#total_amount").val());
            var t_am =  parseInt($("#total_less").val()) + sum + inv_disc_perc;
            valuee = t_am/t_amount * 100;

            $("#total_less2").val(valuee.toFixed(2) + "% | " + t_am);
            var grand_amount = t_am - freight + total_margin;
            var t_profit = grand_amount/t_amount * 100;
            $("#total_profit2").val(t_profit.toFixed(2) + "% | " + grand_amount);

        }*/



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
    </script>

@endsection


