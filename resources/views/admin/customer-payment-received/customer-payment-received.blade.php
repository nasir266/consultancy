@extends('layouts.master')

@section('title','Customer Payment Received')

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
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="w-full max-w-[90px]">
            <label for="vr" class="block text-gray-600 font-medium mb-1"
              >Vr</label
            >
            <input
              id="vr"
              type="number"
              class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Vr #"
            />
          </div>
        </div>
        <div class="flex items-center flex-wrap gap-3">
          <div class="w-full max-w-[120px]">
            <label
              for="acc-id"
              class="block text-gray-600 font-medium mb-1"
              >Acc ID</label
            >
            <input
              id="acc-id"
              type="number"
              class="no-arrows border border-gray-30 w-full max-w-[120px] transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Acc ID"
            />
          </div>
          <div class="w-full max-w-[300px]">
            <label
              for="ac-name"
              class="block text-gray-600 font-medium mb-1"
              >Account Name</label
            >
            <select
              name="ac-name"
              id="ac-name"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
            >
              <option value="" disabled selected>Account Name</option>
              <option value="">My name</option>
            </select>
          </div>
          <div class="w-full max-w-[120px]">
            <label for="inv" class="block text-gray-600 font-medium mb-1"
              >Inv</label
            >
            <input
              id="inv"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Inv #"
            />
          </div>
          <div class="w-full max-w-[200px]">
            <label
              for="same-man"
              class="block text-gray-600 font-medium mb-1"
              >Sale Man</label
            >
            <input
              id="same-man"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Sale Man"
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
            Cheque
          </button>
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="button"
            id="transfer"
            onclick="toggleInputs(event, 'transfer')"
          >
            <i data-feather="globe" class="w-4 h-4 mr-2"></i>
            Bank Transfer
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
              for="receipt"
              class="block text-gray-600 font-medium mb-1"
              >Receipt</label
            >
            <input
              id="receipt"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Receipt"
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
              for="bank-name"
              class="block text-gray-600 font-medium mb-1"
              >Bank Name</label
            >
            <select
              name="bank-name"
              id="bank-name"
              class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:outline-indigo-500 px-4 py-1 rounded-md"
            >
              <option value="" disabled selected>Bank Name</option>
              <option value="">My name</option>
            </select>
          </div>
          <div class="w-full max-w-[300px]">
            <label
              for="cheque-inp"
              class="block text-gray-600 font-medium mb-1"
              >Cheque</label
            >
            <input
              id="cheque-inp"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Cheque"
            />
          </div>
          <div class="w-full max-w-[180px]">
            <label
              for="cheque-date"
              class="block text-gray-600 font-medium mb-1"
              >Cheque Date</label
            >
            <input
              id="cheque-date"
              type="date"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>
          <div class="w-full max-w-[100px]">
            <label
              for="cheque-receipt"
              class="block text-gray-600 font-medium mb-1"
              >Receipt</label
            >
            <input
              id="cheque-receipt"
              type="number"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Receipt"
            />
          </div>
          <div class="w-full max-w-[100px]">
            <label
              for="cheque-amount"
              class="block text-gray-600 font-medium mb-1"
              >Amount</label
            >
            <input
              id="cheque-amount"
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
          <div class="w-full max-w-[300px]">
            <label
              for="b-name"
              class="block text-gray-600 font-medium mb-1"
            >
              Bank Name
            </label>
            <input
              id="b-name"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Bank Name"
            />
          </div>

          <div class="w-full max-w-[300px]">
            <label
              for="transfer-particulars"
              class="block text-gray-600 font-medium mb-1"
            >
              Particulars
            </label>
            <input
              id="transfer-particulars"
              type="text"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
              placeholder="Particulars"
            />
          </div>

          <div class="w-full max-w-[180px]">
            <label
              for="transfer-receipt"
              class="block text-gray-600 font-medium mb-1"
            >
              Receipt
            </label>
            <input
              id="transfer-receipt"
              type="number"
              placeholder="Receipt"
              class="no-arrows border border-gray-30 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
            />
          </div>

          <div class="w-full max-w-[100px]">
            <label
              for="transfer-amount"
              class="block text-gray-600 font-medium mb-1"
            >
              Amount
            </label>
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
                    Account Name
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Sale Man
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Type
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Cheque
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Cheque Date
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Particular
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Inv
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Receipt
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Amount
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Del
                  </th>
                  <th class="border border-gray-200 px-3 py-2 text-left">
                    Edit
                  </th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      <div
        class="flex items-center flex-wrap lg:flex-nowrap gap-3 mt-4 max-w-[800px]"
      >
        <div class="flex-grow md:flex-1">
          <label
            for="cash-inp"
            class="block text-gray-600 font-medium mb-1"
          >
            Cash
          </label>
          <input
            id="cash-inp"
            type="number"
            placeholder="Cash"
            class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>

        <div class="flex-grow md:flex-1">
          <label
            for="cheque-inp-2"
            class="block text-gray-600 font-medium mb-1"
          >
            Cheque
          </label>
          <input
            id="cheque-inp-2"
            type="number"
            placeholder="Cheque"
            class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>

        <div class="flex-grow md:flex-1">
          <label
            for="bank-transfer"
            class="block text-gray-600 font-medium mb-1"
          >
            Bank Transfer
          </label>
          <input
            id="bank-transfer"
            type="number"
            placeholder="Bank Transfer"
            class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>

        <div class="flex-grow md:flex-1">
          <label for="total" class="block text-gray-600 font-medium mb-1">
            Total
          </label>
          <input
            id="total"
            type="text"
            placeholder="Total"
            class="w-full border border-gray-300 transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1 rounded-md"
          />
        </div>
      </div>
      <div class="mt-6 flex items-center gap-2 justify-end">
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


