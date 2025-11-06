@extends('layouts.master')

@section('title','Customer Cheque Post')

@section('content')

<div class="p-2.5 md:p-6 text-[13px] lg:text-base">
    <form action="#" class="bg-white rounded-xl p-5 block">
      <div class="space-y-4">
        <div class="flex items-center flex-wrap gap-3 max-w-[350px]">
          <div class="flex-1">
            <label for="date" class="block text-gray-600 font-medium mb-1"
              >Date</label
            >
            <input
              id="date"
              type="date"
              class="no-arrows border w-full border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="max-w-[90px]">
            <label for="vr" class="block text-gray-600 font-medium mb-1"
              >Vr</label
            >
            <input
              id="vr"
              type="number"
              class="no-arrows w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Vr #"
            />
          </div>
        </div>
        <div class="flex items-center flex-wrap gap-3">
          <div class="w-full max-w-[100px]">
            <label for="vr" class="block text-gray-600 font-medium mb-1"
              >Vr</label
            >
            <input
              id="acc-id"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Acc ID"
            />
          </div>
          <div class="w-full max-w-[200px]">
            <label
              for="cust-name"
              class="block text-gray-600 font-medium mb-1"
              >Customer Name</label
            >
            <select
              name="cust-name"
              id="cust-name"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
            >
              <option value="" disabled selected>Customer Name</option>
              <option value="">My name</option>
            </select>
          </div>
          <div class="w-full max-w-[200px]">
            <label
              for="cheque-inp-4"
              class="block text-gray-600 font-medium mb-1"
              >Cheque</label
            >
            <input
              id="cheque-inp-4"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Cheque"
            />
          </div>
          <div class="w-full max-w-[200px]">
            <label
              for="cheque-date-2"
              class="block text-gray-600 font-medium mb-1"
              >Cheque Date</label
            >
            <input
              id="cheque-date-2"
              type="date"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="w-full max-w-[100px]">
            <label
              for="cheque-amount-2"
              class="block text-gray-600 font-medium mb-1"
              >Amount</label
            >
            <input
              id="cheque-amount-2"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Amount"
            />
          </div>
        </div>
        <div class="flex items-center flex-wrap gap-2">
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
            id="cash"
            onclick="toggleInputs(event, 'cash')"
          >
            <i data-feather="dollar-sign" class="w-4 h-4 mr-2"></i>
            Cash
          </button>
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
            id="cheque"
            onclick="toggleInputs(event, 'cheque')"
          >
            <i data-feather="sliders" class="w-4 h-4 mr-2"></i>
            Bank Transfer
          </button>
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
            id="transfer"
            onclick="toggleInputs(event, 'transfer')"
          >
            <i data-feather="globe" class="w-4 h-4 mr-2"></i>
            Deliver To
          </button>
        </div>
        <div
          id="cash-inpts"
          class="hidden flex items-center flex-wrap gap-3"
        >
          <div class="w-full max-w-[320px]">
            <label
              for="particulars"
              class="block text-gray-600 font-medium mb-1"
              >Particulars</label
            >
            <input
              id="particulars"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Particulars"
            />
          </div>

          <div class="w-full max-w-[120px]">
            <label
              for="cash-amount"
              class="block text-gray-600 font-medium mb-1"
              >Amount</label
            >
            <input
              id="cash-amount"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Amount"
            />
          </div>
        </div>
        <div
          id="cheque-inpts"
          class="hidden flex items-center flex-wrap gap-3"
        >
          <div class="w-full max-w-[300px]">
            <label
              for="acc-name"
              class="block text-gray-600 font-medium mb-1"
              >Account Name</label
            >
            <input
              id="acc-name"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Account Name"
            />
          </div>

          <div class="w-full max-w-[320px]">
            <label
              for="particulars-2"
              class="block text-gray-600 font-medium mb-1"
              >Particulars</label
            >
            <input
              id="particulars-2"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Particulars"
            />
          </div>
          <div class="w-full max-w-[100px]">
            <label
              for="transfer-amount-2"
              class="block text-gray-600 font-medium mb-1"
              >Amount</label
            >
            <input
              id="transfer-amount-2"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Amount"
            />
          </div>
        </div>
        <div
          id="transfer-inpts"
          class="hidden flex items-center flex-wrap gap-3"
        >
          <div class="w-full max-w-[100px]">
            <label for="p-id" class="block text-gray-600 font-medium mb-1"
              >Party ID</label
            >
            <input
              id="p-id"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Party ID"
            />
          </div>
          <div class="w-full max-w-[350px]">
            <label
              for="p-name"
              class="block text-gray-600 font-medium mb-1"
              >Party Name</label
            >
            <select
              name="p-name"
              id="p-name"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
            >
              <option value="" disabled selected>Party Name</option>
              <option value="">My name</option>
            </select>
          </div>
          <div class="w-full max-w-[250px]">
            <label
              for="transfer-particulars"
              class="block text-gray-600 font-medium mb-1"
              >Particulars</label
            >
            <input
              id="transfer-particulars"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Particulars"
            />
          </div>
          <div class="w-full max-w-[100px]">
            <label
              for="transfer-amount"
              class="block text-gray-600 font-medium mb-1"
              >Amount</label
            >
            <input
              id="transfer-amount"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Amount"
            />
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
        class="flex items-center flex-wrap lg:flex-nowrap gap-3 mt-4 max-w-[700px]"
      >
        <div class="flex-grow md:flex-1">
          <label
            for="cash-inp"
            class="block text-gray-600 font-medium mb-1"
            >Cash</label
          >
          <input
            id="cash-inp"
            type="number"
            placeholder="Cash"
            class="border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>
        <div class="flex-grow md:flex-1">
          <label
            for="bank-transfer"
            class="block text-gray-600 font-medium mb-1"
            >Bank Transfer</label
          >
          <input
            id="bank-transfer"
            type="number"
            placeholder="Bank Transfer"
            class="border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>
        <div class="flex-grow md:flex-1">
          <label
            for="deliver-to"
            class="block text-gray-600 font-medium mb-1"
            >Deliver To</label
          >
          <input
            id="deliver-to"
            type="text"
            placeholder="Deliver To"
            class="border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>
        <div class="flex-grow md:flex-1">
          <label for="total" class="block text-gray-600 font-medium mb-1"
            >Total</label
          >
          <input
            id="total"
            type="number"
            placeholder="Total"
            class="border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
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


