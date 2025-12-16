@extends('layouts.master')

@section('title','Salesman')

{{--@section('links')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection--}}
@section('content')

<div class="p-2.5 md:px-5 md:py-4 text-[13px] lg:text-base">
    <form action="#" class="p-5 bg-white rounded-xl" id="myForm" method="post">

        @csrf
      <div class="space-y-5">
        <div
          class="flex flex-col sm:flex-row sm:items-center justify-between gap-y-5 gap-x-8"
        >
          <div class="space-y-2.5 flex-1">
            <div class="max-w-[220px]">
              <label
                for="date"
                class="block text-gray-600 font-medium mb-1"
                >Date</label
              >
              <input
                id="date"
                type="date"
                name="date"
                value="{{ now()->format('Y-m-d') }}"
                class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                required
              />
            </div>
            <div>
              <label
                for="search"
                class="block text-gray-600 font-medium mb-1"
                >Search</label
              >
              <select
                class="selectize-input-sp flex-1"
                name="search"
                id="search"
                onchange="get_id_item(this.value,'id')"
              >
                <option value="">Search</option>
                  @foreach($salesmans as $salesman)
                      <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                  @endforeach
              </select>
            </div>
            <div class="max-w-[220px]">
              <label for="id" class="block text-gray-600 font-medium mb-1"
                >ID</label
              >
              <input
                id="id"
                type="number"
                name="number"
                class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"


                value="{{ $id + 1 }}"
                min="1"
                max="{{ $id + 1 }}"
                oninput="get_id_item(this.value,'id')"
              />
            </div>
            <div>
              <label
                for="name"
                class="block text-gray-600 font-medium mb-1"
                >Name</label
              >
              <input
                id="name"
                name="name"
                type="text"
                class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                placeholder="e.g, bawa"
                required
              />
            </div>
            <div>
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
                placeholder="e.g, bawalchouk faisalabad"
              />
            </div>
            <div class="flex items-center gap-2 flex-wrap">
              <div class="flex-grow">
                <label
                  for="phone"
                  class="block text-gray-600 font-medium mb-1"
                  >Ph Res</label
                >
                <input
                  id="phone"
                  name="phone"
                  type="text"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                  placeholder="Ph Res"
                  required
                />
              </div>

            </div>
            <div class="flex items-center gap-2 flex-wrap">
              <div class="flex-grow">
                <label
                  for="recovery"
                  class="block text-gray-600 font-medium mb-1"
                  >Recovery (%)</label
                >
                <input
                  id="recovery"
                  name="recovery"
                  type="number"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                  placeholder="Recovery (%)"
                />
              </div>
              <div class="flex-grow">
                <label
                  for="sales"
                  class="block text-gray-600 font-medium mb-1"
                  >Sales (%)</label
                >
                <input
                  id="sales"
                  name="sales"
                  type="number"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                  placeholder="Sales (%)"
                />
              </div>
            </div>
            <div class="max-w-[320px]">
              <label
                for="salary"
                class="block text-gray-600 font-medium mb-1"
                >Salary</label
              >
              <input
                id="salary"
                name="salary"
                type="number"
                class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                placeholder="Salary"
              />
            </div>
          </div>
          <div
            class="space-y-3 flex-1 max-w-96 bg-indigo-50 rounded-xl p-6 h-fit"
          >
            <h3 class="text-2xl lg:text-3xl font-medium text-indigo-600">
              Status
            </h3>
            <div class="flex items-center gap-3">
              <div class="flex items-center gap-2">
                <label
                  for="Inactive"
                  class="text-indigo-600 font-medium lg:text-xl"
                  >Inactive</label
                >
                <input
                  type="radio"
                  name="status"
                  id="Inactive"
                  value="off"
                  class="accent-red-600 w-3 h-3 lg:w-3.5 lg:h-3.5"
                />
              </div>
              <div class="flex items-center gap-2">
                <label
                  for="active"
                  class="text-indigo-600 font-medium lg:text-xl"
                  >Active</label
                >
                <input
                  type="radio"
                  name="status"
                  id="active"
                  checked=""
                  value="on"
                  class="accent-indigo-600 w-3 h-3 lg:w-3.5 lg:h-3.5"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="flex items-center flex-wrap gap-3">
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="reset"
          >
            <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i>
            Reset
          </button>

          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="submit"
            id="submit-btn"
          >
            <i data-feather="save" class="w-4 h-4 mr-3"></i>
            Save
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function () {
   $('#myForm').on('submit', function (e) {
       $.ajaxSetup({
           headers:
               { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
       });
       $("#submit-btn").text("Please wait...").attr("disabled", true);
       e.preventDefault();
       //var formData = $('#myForm').serialize();
       //console.log(new FormData(this));



       $.ajax({
           type: 'POST',
           url: '{{route('salesman.create')}}', // Get URL from form's action attribute
           data: new FormData(this),
           contentType: false,
           processData: false,
           success: function(response) {
               $("#submit-btn").attr("disabled", false).text("Save");
               //var data = JSON.parse(response);
               console.log(response);
               toastr.success('Data has submitted!', 'Success', {
                   timeOut: 600,
                   onHidden: function() {
                       location.reload();
                   }
               });
               //toastr.success('Data has submitted!', 'Success', { timeOut: 600, onHidden: 1000 });
               // Optionally, reset the form
              // $('#myForm')[0].reset();
           },
           error: function(error) {
               //console.log({{\Illuminate\Support\Facades\Session::get('error')}})
               console.error(error);
               alert('An error occurred during submission.');
           }
       });
       //console.log(formData);


   });
});

function get_id_item(value,type) {
    var name = value;

    $.ajax({
        url: "{{ route('ajax.salesman.search.id') }}",
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            value: value,
            type: type
        },
        success: function(response) {
            console.log(response);
            if (response) {
                var data = response;

                if (Object.keys(data).length > 0) {

                    $('#date').val(data.date);
                    $('#name').val(data.name);
                    $('#address').val(data.address);
                    $('#phone').val(data.phone);
                    $('#recovery').val(data.recovery);
                    $('#sales').val(data.sales);
                    $('#salary').val(data.salary);

                    if(data.status === 'on'){
                        $('#Inactive').checked;
                    }else{
                        $('#active').checked;
                    }

                    $("#submit-btn").text("Update");

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
</script>
@endsection



