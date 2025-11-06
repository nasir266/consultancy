@extends('layouts.master')

@section('title','City')

@section('content')

<div class="mx-3 sm:mx-5 rounded-xl mt-4 p-5 bg-white" >
    <a
      href="#"
      onclick="openModal(event, 'add_city_model')"
      class="flex items-center text-sm gap-1 w-fit px-4 py-2.5 mb-6 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      <i data-feather="plus" class="w-4 h-4"></i> Add City
    </a>
    @if(session('success'))
        <div class="alert alert-success">
            <b>Successfully!</b> {{session('success')}}
        </div>
    @elseif(session('error'))
        <div class="alert alert-success">
            <b>Sorry!</b> {{session('error')}}
        </div>
    @endif
    <table id="my-datatable" class="w-full" id="myTable">
      <thead>
        <tr>
          <th>
            <div>
              <input
                type="checkbox"
                class="accent-indigo-600 w-4 h-4"
                id="selectAll"
              />
            </div>
          </th>
          <th class="!font-medium">Cities</th>
          <th class="!font-medium">Action</th>
        </tr>
      </thead>
      <tbody >
      @foreach($allCity AS $city)
        <tr >
          <td>
            <div>
              <input type="checkbox" class="accent-indigo-600 w-4 h-4" />
            </div>
          </td>
          <td>{{$city['name']}}</td>
          <td>
            <div class="flex items-center gap-2">
              <a href="#" class="text-indigo-600" onclick="openModal(event, 'city_model'); getUpdateId({{$city->id}})  ">
                <i data-feather="edit-2" class="w-5 h-5"></i>
              </a>
              <a href="{{'deleteCity/'.$city->id}}" class="text-red-600">
                <i data-feather="trash-2" class="w-5 h-5"></i>
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



<div
    id="add_city_model"
    class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
    <div
        class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
        style="scrollbar-width: none"
    >



        <div id="modal-content" class="text-gray-700">
            <h3 class="text-gray-600 text-xl font-medium mb-6">Add City</h3>
            <div class="flex flex-col gap-1">
                <label id="size" class="text-gray-600 font-medium">City Name</label>
                <input
                    placeholder="enter city"
                    class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-2 rounded-md"
                    type="text"
                    id="city_name"
                    name="city_name"
                />

            </div>
        </div>
        <div class="flex items-center gap-3 justify-end text-sm mt-14">
            <button
                class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                onclick="closeModal(event, 'add_city_model','name')"
            >
                Close
            </button>
            <button
                class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                id="insert_size"
                type="button"
                onclick="submitAddForm()"
            >
                Save
            </button>
        </div>


    </div>
</div>

<div
    id="city_model"
    class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
    <div
        class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
        style="scrollbar-width: none"
    >



        <div id="modal-content" class="text-gray-700">
            <h3 class="text-gray-600 text-xl font-medium mb-6">Update City</h3>
            <div class="flex flex-col gap-1">
                <label id="size" class="text-gray-600 font-medium">City Name</label>
                <input
                    placeholder="enter city"
                    class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-2 rounded-md"
                    type="text"
                    id="c_name"
                    name="c_name"
                />
                <input type="hidden" id="update_id" name="update_id" >
            </div>
        </div>
        <div class="flex items-center gap-3 justify-end text-sm mt-14">
            <button
                class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                onclick="closeModal(event, 'city_model','name')"
            >
                Close
            </button>
            <button
                class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                id="insert_size"
                type="button"
                onclick="submitUpdateForm()"
            >
                Save
            </button>
        </div>


    </div>
</div>


<script>
    function submitAddForm(){
        var c_name = document.getElementById('city_name').value;
        //window.alert(g_name);
        $.ajax({
            url: "{{ route('addCityForm') }}",
            method: "POST",
            data: {
                "_token": "{{csrf_token()}}",
                "c_name": c_name
            },
            success: function (response) {
                closeModal(event, 'add_city_model','name');
                $("#myTable").load(" #myTable");
                //$( "#myTable" ).load( " #myTable" );
                if(response === 'success'){
                    document.getElementById('city_name').value = '';
                    toastr.success('record has been updated!', 'Success', { timeOut: 800 });
                    setTimeout(function() {
                        window.location.href = '{{ route("city") }}';
                    }, 2000);

                }else{
                    toastr.error('record already exist', 'Error!', { timeOut: 800 });
                }
                console.log(response);

            },
            error: function (xhr, status, error) {
               // alert('missing', error);
            }
        });

    }
    function submitUpdateForm(){
        var c_name = document.getElementById('c_name').value;
        var c_id = document.getElementById('update_id').value;
        //window.alert(g_name);
        $.ajax({
            url: "{{ route('updateCityForm') }}",
            method: "POST",
            data: {
                "_token": "{{csrf_token()}}",
                "c_id": c_id,
                "c_name": c_name
            },
            success: function (response) {
                closeModal(event, 'city_model','name');
                $("#myTable").load(" #myTable");
                //$( "#myTable" ).load( " #myTable" );
                if(response === 'success'){
                    toastr.success('record has been updated!', 'Success', { timeOut: 800 });
                    setTimeout(function() {
                        window.location.href = '{{ route("city") }}';
                    }, 2000);
                }
                console.log(response);

            },
            error: function (xhr, status, error) {
                alert('missing', error);
            }
        });

    }
    function getUpdateId(id){
        document.getElementById('update_id').value = id;
        $.ajax({
            url: "{{ route('updateCity') }}",
            method: "GET",
            data: { id: id },
            success: function (response) {
                //console.log(response);
                var data = JSON.parse(response);
                document.getElementById('c_name').value = data['name'];
                //console.log(data['name']);

            },
            error: function (xhr, status, error) {
                console.error('Error fetching item:', error);
                reject(error);
            }
        });
    }
</script>
@endsection


