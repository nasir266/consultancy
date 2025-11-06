@extends('layouts.master')

@section('title','Greeting')

@section('content')

<div class="mx-3 sm:mx-5 rounded-xl mt-4 p-5 bg-white">
    <a
      href="#"
      class="flex items-center text-sm gap-1 w-fit px-4 py-2.5 mb-6 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      <i data-feather="plus" class="w-4 h-4"></i> Add Greeting
    </a>
    <table id="my-datatable" class="w-full">
      <thead class="text-gray-600">
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
          <th class="!font-medium">Whatsapp Greeting</th>
          <th class="!font-medium">Whatsapp File</th>
          <th class="!font-medium">Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr>
          <td>
            <div>
              <input type="checkbox" class="accent-indigo-600 w-4 h-4" />
            </div>
          </td>
          <td>KHUSHAB</td>
          <td>BAWA CHAKK</td>
          <td>
            <div class="flex items-center gap-2">
              <a href="#" class="text-indigo-600">
                <i data-feather="edit-2" class="w-5 h-5"></i>
              </a>
              <a href="#" class="text-red-600">
                <i data-feather="trash-2" class="w-5 h-5"></i>
              </a>
            </div>
          </td>
        </tr> -->
      </tbody>
    </table>
  </div>
</div>
</div>


@endsection


