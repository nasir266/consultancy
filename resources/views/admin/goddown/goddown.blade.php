@extends('layouts.master')

@section('title','Godown')

@section('content')

<div class="p-2.5 md:px-5 md:py-4 text-[13px] lg:text-base">
    <form action="{{route('addGoddown')}}" method="post" class="p-5 md:py-8 bg-white rounded-xl">
      <div class="space-y-5">
        <div class="space-y-3">
          <div class="max-w-[700px]">
              @if(session('success'))
                  <div class="alert alert-success">
                      <b>Successfully!</b> {{session('success')}}
                  </div>
              @elseif(session('error'))
                  <div class="alert alert-danger">
                      <b>Sorry!</b> {{session('error')}}
                  </div>
              @endif
            <label for="id" class="block text-gray-600 font-medium mb-1"
              >ID</label
            >
                  @csrf
            <input
              id="id"
              type="number"
              name="id"
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-5 py-2.5 rounded-md"
              placeholder="eg; 17"
              value="{{$last_id}}"
            />
          </div>
          <div class="max-w-[700px]">
            <label for="name" class="block text-gray-600 font-medium mb-1"
              >Godown Name</label
            >
            <input
              id="name"
              type="text"
              name="name"
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-5 py-2.5 rounded-md"
              placeholder="enter name"
            />
              <span style="color: red">{{$errors->first('name')}}</span>
          </div>
        </div>
        <div class="flex items-center flex-wrap gap-3">
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="submit"
          >
            <i data-feather="chevrons-up" class="w-4 h-4 mr-3"></i>
            Submit
          </button>
        </div>
      </div>
    </form>




    <div class="p-5 bg-white rounded-xl mt-4">
      <div class="flex gap-3 flex-wrap items-end overflow-x-auto pb-3" >
        <div class="flex-grow flex-shrink-0" id="mytable">
          <table class="table-auto w-full border-collapse border text-sm" >
              @if(session('delete'))
                  <div class="alert alert-success">
                      <b>Successfully!</b> {{session('delete')}}
                  </div>
              @endif
            <thead class="bg-gray-50 text-gray-500 font-normal" >
              <tr>
                <th class="border border-gray-200 px-4 py-3 text-left">
                  ID
                </th>
                <th class="border border-gray-200 px-4 py-3 text-left">
                  Godown Name
                </th>
                <th class="border border-gray-200 px-4 py-3 text-left">
                  Default
                </th>
                <th class="border border-gray-200 px-4 py-3 text-left">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody >
            @foreach($godowns AS $godown)
                <tr >
                    <td class="border border-gray-200 px-4 py-3">{{$godown->id}}</td>
                    <td class="border border-gray-200 px-4 py-3" >
                        {{$godown->name}}
                    </td>
                    <td class="border border-gray-200 px-4 py-3">
                         <a href="#" onclick="openModal(event, 'godown_model'); update_default({{$godown->id}})" class="text-indigo-600">Make Default</a>
                    </td>
                    <td class="border border-gray-200 px-4 py-3">
                        <div class="flex items-center gap-3">
                            <a href="#" onclick="getUpdateId({{$godown->id}})" class="text-indigo-600">
                                <i data-feather="edit-2" class="w-4 h-4"></i>
                            </a>
                            <a href="{{'delete_godown/'.$godown->id}}" class="text-red-600">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </td>
                </tr>

            @endforeach


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>





<div
    id="godown_model"
    class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
    <div
        class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
        style="scrollbar-width: none"
    >



            <div id="modal-content" class="text-gray-700">
                <h3 class="text-gray-600 text-xl font-medium mb-6">Update Godown</h3>
                <div class="flex flex-col gap-1">
                    <div class="flex items-center">
                            <input type="checkbox" id="default" name="default" onclick="default_content()" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="default" class="ml-2 text-sm text-gray-700">Default</label>
                    </div>
                    <input type="hidden" id="update_id" name="update_id" >
                </div>
                <div id="default_content">
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="item" name="item" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="item" class="ml-2 text-sm text-gray-700">item</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="sale" name="sale" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="sale" class="ml-2 text-sm text-gray-700">Sale Invoice</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="sale_r" name="sale_r" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="sale_r" class="ml-2 text-sm text-gray-700">Sale Return</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="r_sale" name="r_sale" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="r_sale" class="ml-2 text-sm text-gray-700">Retail Sale</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="r_sale_r" name="r_sale_r" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="r_sale_r" class="ml-2 text-sm text-gray-700">Retail Sale Return</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="p_invoice" name="p_invoice" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="p_invoice" class="ml-2 text-sm text-gray-700">Purchase Invoice</label>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 mt-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="p_invoice_r" name="p_invoice_r" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-4">
                            <label for="p_invoice_r" class="ml-2 text-sm text-gray-700">Purchase Return Invoice  </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 justify-end text-sm mt-14">
                <button
                    class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                    onclick="closeModal(event, 'godown_model','name')"
                >
                    Close
                </button>
                <button
                    class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                    id="insert_size"
                    type="button"
                    onclick="make_default_form()"
                >
                    Save
                </button>
            </div>


    </div>
</div>

    <script>

        function default_content(){
            var default_rad = document.getElementById('default');
            if(default_rad.checked){
                //window.alert('checked');
                document.getElementById('default_content').style.display = 'none';
            }else{
                //window.alert('not');
                document.getElementById('default_content').style.display = 'block';

            }


        }
        function make_default_form(){
            var def_check = document.getElementById('default');
            var sale_check = document.getElementById('sale');
            var sale_r_check = document.getElementById('sale_r');
            var r_sale_check = document.getElementById('r_sale');
            var r_sale_r_check = document.getElementById('r_sale_r');
            var p_invoice_check = document.getElementById('p_invoice');
            var p_invoice_r_check = document.getElementById('p_invoice_r');
            var item_check = document.getElementById('item');
            var update_id = document.getElementById('update_id').value;
            var def_value = '';
            var item_value = '';
            var sale_value = '';
            var sale_r_value = '';
            var r_sale_value = '';
            var r_sale_r_value = '';
            var p_invoice_value = '';
            var p_invoice_r_value = '';

            if(def_check.checked){
                def_value = 'default';
            }
            if(item_check.checked){
                item_value = 'Item';
            }
            if(sale_check.checked){
                sale_value = 'SaleInvoice';
            }
            if(sale_r_check.checked){
                sale_r_value = 'SaleReturn ';
            }
            if(r_sale_check.checked){
                r_sale_value = 'RetailSale ';
            }
            if(r_sale_r_check.checked){
                r_sale_r_value = 'RetailSaleReturn';
            }
            if(p_invoice_check.checked){
                p_invoice_value = 'PurchaseInvoice';
            }
            if(p_invoice_r_check.checked){
                p_invoice_r_value = 'PurchaseInvoiceReturn';
            }


            $.ajax({
                url: "{{ route('make_default') }}",
                method: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "def_value": def_value,
                    "item_value": item_value,
                    "sale_value": sale_value,
                    "sale_r_value": sale_r_value,
                    "r_sale_value": r_sale_value,
                    "r_sale_r_value": r_sale_r_value,
                    "p_invoice_value": p_invoice_value,
                    "p_invoice_r_value": p_invoice_r_value,
                    "update_id": update_id
                },
                success: function (response) {
                    closeModal(event, 'godown_model','name');
                    //$( "#mytable" ).load( " #mytable" );
                    if(response === 'success'){
                        toastr.success('record has been updated!', 'Success', { timeOut: 800 });
                    }
                    console.log(response);

                },
                error: function (xhr, status, error) {
                    alert('missing', error);
                }
            });

        }
        /*function submitUpdateForm(){
            var g_name = document.getElementById('g_name').value;
            var g_id = document.getElementById('update_id').value;
            //window.alert(g_name);
            $.ajax({
                url: "{{--{{ route('updateGodownForm') }}--}}",
                method: "POST",
                data: {
                    "_token": "{{csrf_token()}}",
                    "g_id": g_id,
                    "g_name": g_name
                },
                success: function (response) {
                   closeModal(event, 'godown_model','name');
                    $( "#mytable" ).load( " #mytable" );
                    if(response === 'success'){
                        toastr.success('record has been updated!', 'Success', { timeOut: 800 });
                    }
                    console.log(response);

                },
                error: function (xhr, status, error) {
                    alert('missing', error);
                }
            });

        }*/
        function update_default(id){
            var def_check = document.getElementById('default');
            var sale_check = document.getElementById('sale');
            var sale_r_check = document.getElementById('sale_r');
            var r_sale_check = document.getElementById('r_sale');
            var r_sale_r_check = document.getElementById('r_sale_r');
            var p_invoice_check = document.getElementById('p_invoice');
            var p_invoice_r_check = document.getElementById('p_invoice_r');
            var item_check = document.getElementById('item');

            def_check.checked = false;
            item_check.checked = false;
            sale_check.checked = false;
            sale_r_check.checked = false;
            r_sale_check.checked = false;
            r_sale_r_check.checked = false;
            p_invoice_check.checked = false;
            p_invoice_r_check.checked = false;

            document.getElementById('update_id').value = id;
            $.ajax({
                url: "{{ route('fetchDefaultValue') }}",
                method: "GET",
                data: { id: id },
                success: function (response) {
                    var myArray = JSON.parse(response);

                    if(myArray.includes('SaleInvoice')){
                        console.log('exist');
                    }
                    if (myArray.includes('default')) {
                        def_check.checked = true;
                        item_check.checked = false;
                        sale_check.checked = false;
                        sale_r_check.checked = false;
                        r_sale_check.checked = false;
                        r_sale_r_check.checked = false;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes('Item')){
                        item_check.checked = true;
                        sale_check.checked = false;
                        sale_r_check.checked = false;
                        r_sale_check.checked = false;
                        r_sale_r_check.checked = false;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes('SaleInvoice')){
                        //window.alert('ccc');
                        sale_check.checked = true;
                        sale_r_check.checked = false;
                        r_sale_check.checked = false;
                        r_sale_r_check.checked = false;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes("SaleReturn")){
                        sale_r_check.checked = true;
                        r_sale_check.checked = false;
                        r_sale_r_check.checked = false;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes("RetailSale")){
                        r_sale_check.checked = true;
                        r_sale_r_check.checked = false;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes("RetailSaleReturn")){
                        r_sale_r_check.checked = true;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes("PurchaseInvoice")){
                        p_invoice_check.checked = true;
                        p_invoice_r_check.checked = false;
                    }
                    if(myArray.includes('PurchaseInvoiceReturn')){
                        p_invoice_r_check.checked = true;
                    }
                    if(myArray.includes('false')){
                        def_check.checked = false;
                        item_check.checked = false;
                        sale_check.checked = false;
                        sale_r_check.checked = false;
                        r_sale_check.checked = false;
                        r_sale_r_check.checked = false;
                        p_invoice_check.checked = false;
                        p_invoice_r_check.checked = false;
                    }

                    console.log(myArray);

                },
                error: function (xhr, status, error) {
                    console.error('Error fetching item:', error);
                    reject(error);
                }
            });
        }
        function getUpdateId(id){

            $.ajax({
                url: "{{ route('updateGodown') }}",
                method: "GET",
                data: { id: id },
                success: function (response) {
                    var data = JSON.parse(response);
                   // document.getElementById('g_name').value = data['name'];
                    document.getElementById('name').value = data['name'];
                    document.getElementById('id').value = data['id'];
                    //console.log();

                },
                error: function (xhr, status, error) {
                    console.error('Error fetching item:', error);
                    reject(error);
                }
            });
        }
    </script>
@endsection


