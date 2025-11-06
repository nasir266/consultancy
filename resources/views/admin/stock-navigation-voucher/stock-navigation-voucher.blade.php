@extends('layouts.master')

@section('title','Stock Navigation Voucher')

@section('content')
<div class="p-2.5 md:p-6 text-[13px] lg:text-base">
    <form action="#" class="bg-white rounded-xl p-5 block">
      <div class="space-y-4">
        <div class="w-full max-w-[90px]">
          <label for="serial" class="block font-medium text-gray-600 mb-1"
            >Serial</label
          >

          <input
            id="serial"
            type="number"
            class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            placeholder="Serial"
          />
        </div>
        <div class="flex items-center flex-wrap gap-3 max-w-[300px]">
          <div class="flex-1">
            <label for="date" class="block font-medium text-gray-600 mb-1"
              >Date</label
            >
            <input
              id="date"
              type="date"
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="w-full max-w-[90px]">
            <label for="vrno" class="block font-medium text-gray-600 mb-1"
              >Vrno</label
            >
            <input
              id="vrno"
              type="number"
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Vrno"
            />
          </div>
        </div>
        <div class="flex items-end flex-wrap max-w-[1060px] space-y-4">
          <div class="w-full">
            <label
              for="select-sale-man"
              class="block font-medium text-gray-600 mb-1"
              >Sale Man</label
            >
            <select
              name="sale-man"
              id="select-sale-man"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
            >
              <option value="" disabled selected>Sale Man</option>
            </select>
          </div>

          <div class="flex items-center flex-wrap gap-3 flex-1 w-fit">
            <div class="w-full max-w-[100px]">
              <label
                for="bardcode"
                class="block font-medium text-gray-600 mb-1"
                >Barcode</label
              >
              <input
                id="bardcode"
                type="number"
                class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                placeholder="Barcode"
              />
            </div>

            <div class="w-full max-w-[100px]">
              <label
                for="i-code"
                class="block font-medium text-gray-600 mb-1"
                >Item Code</label
              >
              <input
                id="i-code"
                type="text"
                class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                placeholder="ItemCode"
              />
            </div>

            <div class="w-full max-w-[200px]">
              <label
                for="description"
                class="block font-medium text-gray-600 mb-1"
                >Description</label
              >
              <input
                id="description"
                type="text"
                class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                placeholder="Description"
              />
            </div>

            <div class="w-full max-w-[200px]">
              <label
                for="goddown-from"
                class="block font-medium text-gray-600 mb-1"
                >Goddown From</label
              >
              <select
                name="goddown-from"
                id="goddown-from"
                class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
              >
                <option value="" disabled selected>Goddown From</option>
              </select>
            </div>

            <div class="w-full max-w-[100px]">
              <label
                for="qty"
                class="block font-medium text-gray-600 mb-1"
                >Qty</label
              >
              <input
                id="qty"
                type="number"
                class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
                placeholder="Qty"
              />
            </div>

            <div class="w-full max-w-[200px]">
              <label
                for="goddown-to"
                class="block font-medium text-gray-600 mb-1"
                >Goddown To</label
              >
              <select
                name="goddown-to"
                id="goddown-to"
                class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
              >
                <option value="" disabled selected>Goddown To</option>
              </select>
            </div>
          </div>

          <button
            class="flex items-center px-3 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
          >
            <i data-feather="plus" class="w-5 h-5 mr-2"></i>
            Add
          </button>
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
      <div class="mt-4">
        <label
          for="total-qty"
          class="block font-medium text-gray-600 mb-1"
          >Total Qty</label
        >
        <input
          id="total-qty"
          type="number"
          placeholder="Total Qty"
          class="border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
        />
      </div>
      <div class="mt-8 lg:mt-0 flex items-center gap-2 justify-end">
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
          >
            <i data-feather="chevrons-up" class="w-4 h-4 mr-3"></i>
            Update
          </button>
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="submit"
          >
            <i data-feather="save" class="w-4 h-4 mr-3"></i>
            Save
          </button>
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
          >
            <i data-feather="printer" class="w-4 h-4 mr-3"></i>
            Print
          </button>
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
          >
            <i data-feather="trash-2" class="w-4 h-4 mr-3"></i>
            Delete
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>

@endsection


