@extends('layouts.master')

@section('title','Search all vouchers')

@section('content')

<div class="p-2.5 md:p-6 text-[13px] lg:text-base">
    <form action="#" class="bg-white rounded-xl p-5 block">
      <div class="space-y-4">
        <div class="flex items-center flex-wrap gap-5">
          <div class="flex items-center justify-center gap-2">
            <input
              type="radio"
              name="checkActive"
              id="sale"
              checked=""
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="sale" class="text-gray-600 font-medium"
              >Sale</label
            >
          </div>
          <div class="flex items-center justify-center gap-2">
            <input
              type="radio"
              name="checkActive"
              id="purchase"
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="purchase" class="text-gray-600 font-medium"
              >Purchase</label
            >
          </div>
          <div class="flex items-center justify-center gap-2">
            <input
              type="radio"
              name="checkActive"
              id="sale-r"
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="sale-r" class="text-gray-600 font-medium"
              >Sale Return</label
            >
          </div>
          <div class="flex items-center justify-center gap-2">
            <input
              type="radio"
              name="checkActive"
              id="purchase-r"
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="purchase-r" class="text-gray-600 font-medium"
              >Purchase Return</label
            >
          </div>
          <div class="flex items-center justify-center gap-2">
            <input
              type="radio"
              name="checkActive"
              id="all"
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="all" class="text-gray-600 font-medium">All</label>
          </div>
        </div>
        <div class="flex items-end flex-wrap gap-3">
          <div class="w-full max-w-[400px]">
            <label
              for="search"
              class="block font-medium text-gray-600 mb-1"
              >Search</label
            >
            <select
              name="search"
              id="search"
              class="selectize-input-sp w-full rounded-md"
            >
              <option value="">Search</option>
            </select>
          </div>
          <button
            class="flex items-center px-6 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
          >
            Show
          </button>
          <button
            class="flex items-center px-6 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
          >
            Clear
          </button>
          <div class="w-full max-w-[200px]">
            <label for="date" class="text-sm font-medium text-gray-700"
              >Date</label
            >
            <input
              id="date"
              type="date"
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>

          <div class="flex items-center justify-center gap-2 lg:mb-2">
            <input
              type="radio"
              name="checkActive"
              id="c-date"
              checked=""
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="c-date" class="text-gray-600">Current Date</label>
          </div>

          <div class="flex items-center justify-center gap-2 lg:mb-2">
            <input
              type="radio"
              name="checkActive"
              id="all-date"
              checked=""
              class="accent-indigo-600 w-3.5 h-3.5"
            />
            <label for="all-date" class="text-gray-600">All</label>
          </div>
        </div>
      </div>

      <div class="mt-6">
        <div class="flex gap-3 flex-wrap items-end overflow-x-auto pb-3">
          <div class="flex-grow flex-shrink-0">
            <table
              class="table-auto w-full border-collapse border text-sm"
            >
              <thead class="bg-gray-50 text-gray-500 font-medium">
                <tr>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    SR
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    ID
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Customer Name
                  </th>

                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Type
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Account Name
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Bank Name
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Cheque
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    cheque Date
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Particular
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Amount
                  </th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>


@endsection


