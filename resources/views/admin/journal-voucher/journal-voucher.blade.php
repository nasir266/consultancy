@extends('layouts.master')

@section('title','Sales Man')

@section('content')

<div class="p-2.5 md:p-6 text-[13px] lg:text-base">
    <form action="#" class="bg-white rounded-xl p-5 block">
      <div class="space-y-4">
        <div class="flex items-center flex-wrap gap-3 max-w-[300px]">
          <div class="flex-1">
            <label
              for="date"
              class="block text-gray-600 font-medium mb-1"
            >
              Date
            </label>
            <input
              id="date"
              type="date"
              class="w-full no-arrows border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>

          <div class="max-w-[90px]">
            <label
              for="serial"
              class="block text-gray-600 font-medium mb-1"
            >
              Serial
            </label>
            <input
              id="serial"
              type="number"
              class="w-full no-arrows border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Serial"
            />
          </div>
        </div>

        <div class="flex items-center flex-wrap gap-3">
          <div class="w-full max-w-[100px]">
            <label
              for="ac-iad"
              class="block text-gray-600 font-medium mb-1"
            >
              A/C ID
            </label>
            <input
              id="ac-iad"
              type="number"
              class="w-full no-arrows border border-gray-30 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="A/C ID"
            />
          </div>

          <div class="w-full max-w-[300px]">
            <label
              for="account-name"
              class="block text-gray-600 font-medium mb-1"
            >
              Account Name
            </label>
            <select
              name="account-name"
              id="account-name"
              class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
            >
              <option value="" disabled selected>Account Name</option>
            </select>
          </div>

          <div class="w-full max-w-[300px]">
            <label
              for="particulars"
              class="block text-gray-600 font-medium mb-1"
            >
              Particulars
            </label>
            <input
              id="particulars"
              type="text"
              class="w-full no-arrows border border-gray-30 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Particulars"
            />
          </div>

          <div class="w-full max-w-[100px]">
            <label for="inv" class="block text-gray-600 font-medium mb-1">
              Inv
            </label>
            <input
              id="inv"
              type="number"
              class="w-full no-arrows border border-gray-30 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Inv"
            />
          </div>

          <div class="w-full max-w-[100px]">
            <label
              for="debit"
              class="block text-gray-600 font-medium mb-1"
            >
              Debit
            </label>
            <input
              id="debit"
              type="number"
              class="w-full no-arrows border border-gray-30 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Debit"
            />
          </div>

          <div class="w-full max-w-[100px]">
            <label
              for="credit"
              class="block text-gray-600 font-medium mb-1"
            >
              Credit
            </label>
            <input
              id="credit"
              type="number"
              class="w-full no-arrows border border-gray-30 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Credit"
            />
          </div>

          <div>
            <label class="block text-transparent font-medium mb-1"
              >Add</label
            >
            <button
              class="flex items-center px-3 py-1 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
              type="button"
            >
              <i data-feather="plus" class="w-5 h-5 mr-2"></i>
              Add
            </button>
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

      <div
        class="flex items-center gap-3 flex-wrap md:flex-1 max-w-[500px] mt-4"
      >
        <div class="flex-grow md:flex-1">
          <label
            for="t-debit"
            class="block text-gray-600 font-medium mb-1"
            >Tot Debit</label
          >
          <input
            id="t-debit"
            type="number"
            placeholder="Tot Debit"
            class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>
        <div class="flex-grow md:flex-1">
          <label
            for="tot-credit"
            class="block text-gray-600 font-medium mb-1"
            >Tot Credit</label
          >
          <input
            id="tot-credit"
            type="number"
            placeholder="Tot Credit"
            class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>
      </div>
      <div class="mt-8 flex items-center gap-2 justify-end">
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


