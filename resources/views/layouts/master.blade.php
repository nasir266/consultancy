<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=3') }}" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--@yield('links')--}}
    <!-- Feather -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.2/feather.min.js"
      integrity="sha512-zMm7+ZQ8AZr1r3W8Z8lDATkH05QG5Gm2xc6MlsCdBz9l6oE8Y7IXByMgSm/rdRQrhuHt99HAYfMljBOEZ68q5A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- FOnt Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- selecetize -->
    <link
      rel="stylesheet"
      href="https://selectize.dev/css/selectize.css"
    />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Datatables -->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"
    />


      @yield('tailwind')

    <style>
        label.text-gray-600.font-medium {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 1px;
        }
        .text-danger {
            color: red;
            font-size: 10px;
        }
        input, select, textarea, .selectize-input {
            border: 1.5px solid #777 !important;
        }
        .toast-center {
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          position: fixed;
          z-index: 9999;
        }
        #tabs{
          width: 80%;
        }
        .selectize-dropdown [data-selectable] .highlight{
          background: #FF9633;
        }
        .alert.alert-success {
            background-color: #d4edda; /* Light green background */
            border-color: #c3e6cb; /* Slightly darker green border */
            color: #155724; /* Dark green text */
            padding: 10px;
            border-radius: 5px;
        }

         td,  th,  tr,  table {
            border-color: #777 !important;
        }

         th {
            background: rgb(79 70 229 / var(--tw-bg-opacity, 1));
            color: white;
        }
         .sideNav{
             list-style: none;
         }
         .sideNav li{
             padding: 0px 10px;
             display: inline-block;
         }
         .sideNav li ul{
             display: none;
             list-style: none;
             position: absolute;

             background-color: #e5e7eb;
             margin-left: -10px;
         }
         .sideNav li ul li{
             padding: 3px 10px;
             float: none;
             color: rgb(75 85 99 / var(--tw-text-opacity, 1));;
         }
         .sideNav li:hover ul{
             display: block;
         }
    </style>

    @yield('styles')

  </head>
  <body class="h-full">

     <!-- Global Preloader -->
<div id="global-preloader" style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>


    <div class="min-h-screen bg-gray-100">
      <div
        class="flex items-center flex-wrap justify-between bg-white transition-all duration-200 px-6 py-2 lg:pl-[93px]"
      >
        <button
          class="bg-indigo-50 text-indigo-600 w-10 h-10 flex items-center justify-center rounded-full transition-colors duration-100 active:bg-indigo-600 active:text-white"
          onclick="openSideBar(event)"
        >
          <i data-feather="align-left" class="w-6 h-6"></i>
        </button>
        <div id="tabs"></div>

        <div class="flex items-center gap-5">
            <ul class="sideNav">
                <li>
                    <button class="text-gray-500 hover:text-gray-600">
                        <i data-feather="search" class="w-4 h-4 lg:w-6 lg:h-6"></i>
                    </button>
                </li>
                <li>
                    <button class="text-gray-500 hover:text-gray-600">
                        <i data-feather="bell" class="w-4 h-4 lg:w-6 lg:h-6"></i>
                    </button>
                </li>
                <li>
                    <button class="w-8 h-8 lg:h-10 lg:w-10 rounded-full bg-gray-200 flex items-center justify-center">
                        <i data-feather="user" class="w-4 h-4 lg:w-6 lg:h-6 text-gray-500"></i>
                    </button>
                    <ul>
                        <li><a href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
      </div>

      <div
        id="sidebar-default"
        class="sidebar w-[70px] hidden lg:block fixed z-10 inset-y-0 left-0 bg-white shadow-lg"
      >
        <div class="flex items-center min-h-16 px-5 bg-indigo-600">
          <i data-feather="box" class="w-6 h-6 text-white"></i>
        </div>
        <nav
          class="mt-6 space-y-2 h-[calc(100vh_-_100px)] text-sm text-gray-600 font-medium"
          style="scrollbar-width: none"
        >
          <div class="group relative hover:bg-gray-100 cursor-pointer">
            <a href="#" class="py-2.5 block w-fit mx-auto">
              <i data-feather="layout" class="w-6 h-6"></i>
            </a>
            <ul
              class="transition duration-300 opacity-0 origin-left scale-0 group-hover:opacity-100 group-hover:scale-100 overflow-hidden w-[200px] absolute top-1/2 -translate-y-1/2 left-full bg-white rounded-r-md shadow"
            >
              <li
                class="flex items-center justify-between gap-2 pr-2 bg-gray-50"
              >
                <a href="#" class="flex-1 block p-3">Dashboard</a>
                <button data-label="Dashboard" type="button">
                  <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                </button>
              </li>
            </ul>
          </div>

          <div class="group relative hover:bg-gray-100 cursor-pointer">
            <button type="button" class="py-2.5 block mx-auto">
              <i data-feather="plus" class="w-6 h-6"></i>
            </button>
            <div
              class="transition duration-300 opacity-0 origin-left scale-0 group-hover:opacity-100 group-hover:scale-100 w-[200px] absolute top-0 left-full bg-white rounded-r-md shadow"
            >
              <h3 class="p-3 bg-gray-50 mb-2">Add New</h3>
              <ul class="text-[13px] pl-6 pb-6 space-y-3">
                <li
                  class="flex items-center justify-between gap-2 pr-2 text-indigo-600 hover:text-indigo-600"
                >
                  <a href="{{ route('party') }}" class="flex-1 block">Add New Party</a>
                  <button data-label="Add New Party" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li class="relative group/area">
                  <button
                    type="button"
                    class="block hover:text-indigo-600 w-full text-left"
                  >
                    Area Manager
                  </button>
                  <ul
                    class="space-y-3 p-4 transition duration-300 opacity-0 origin-left scale-0 group-hover/area:opacity-100 group-hover/area:scale-100 overflow-hidden w-[200px] absolute top-0 left-full bg-white rounded-r-md shadow"
                  >
                    <li
                      class="flex items-center justify-between gap-2 hover:text-indigo-600"
                    >
                      <a href="{{ route('city') }}" class="flex-1 block">City</a>
                      <button data-label="City" type="button">
                        <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                      </button>
                    </li>
                    <li
                      class="flex items-center justify-between gap-2 hover:text-indigo-600"
                    >
                      <a href="{{ route('area') }}" class="flex-1 block">Area</a>
                      <button data-label="Area Menu" type="button">
                        <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                      </button>
                    </li>
                  </ul>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('item') }}" class="flex-1 block">Add Item</a>
                  <button data-label="Add Item" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('sales-man') }}/" class="flex-1 block"
                    >Add New Salesman</a
                  >
                  <button data-label="Add New Sales Man" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('retail-sale-rate') }}" class="flex-1 block"
                    >Add Retail Sale Rate</a
                  >
                  <button data-label="Add Retail Sale Rate" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('goddown') }}" class="flex-1 block"
                    >Add New Godown</a
                  >
                  <button data-label="Add New Godown" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                  <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('bank') }}" class="flex-1 block"
                    >Add Bank</a
                  >
                  <button data-label="Add New Godown" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
              </ul>
            </div>
          </div>

          <div class="group relative hover:bg-gray-100 cursor-pointer">
            <button type="button" class="py-2.5 block mx-auto">
              <i data-feather="file-text" class="w-5 h-5"></i>
            </button>
            <div
              class="transition duration-300 opacity-0 origin-left scale-0 group-hover:opacity-100 group-hover:scale-100 w-[250px] absolute top-0 left-full bg-white rounded-r-md shadow"
            >
              <h3 class="p-3 bg-gray-50 mb-2">Invoices</h3>
              <ul class="text-[13px] pl-6 pb-6 space-y-3">
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('sale-invoice') }}" class="flex-1 block"
                    >Sale Invoice</a
                  >
                  <button data-label="Sale Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="#" class="flex-1 block">Sale Return Invoice</a>
                  <button data-label="Sale Return Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="#" class="flex-1 block">Retail Sale Invoice</a>
                  <button data-label="Retail Sale Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="#" class="flex-1 block"
                    >Retail Sale Return Invoice</a
                  >
                  <button data-label="Retail Sale Return Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('purchase-invoice') }}" class="flex-1 block"
                    >Purchase Invoice</a
                  >
                  <button data-label="Purchase Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('purchase-return-invoice') }}" class="flex-1 block"
                    >Purchase Return Invoice</a
                  >
                  <button data-label="Purchase Return Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
              </ul>
            </div>
          </div>

          <div class="group relative hover:bg-gray-100 cursor-pointer">
            <button type="button" class="py-2.5 block mx-auto">
              <i data-feather="gift" class="w-5 h-5"></i>
            </button>
            <div
              class="transition duration-300 opacity-0 origin-left scale-0 group-hover:opacity-100 group-hover:scale-100 w-[300px] absolute top-0 left-full bg-white rounded-r-md shadow"
            >
              <h3 class="p-3 bg-gray-50 mb-2">Vouchers</h3>
              <ul class="text-[13px] pl-6 pb-6 space-y-3">
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('customer-payment-received') }}" class="flex-1 block"
                    >Customer Payment Received</a
                  >
                  <button data-label="Customer Payment Received" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('customer-cheque-post') }}" class="flex-1 block"
                    >Customer Cheque Post</a
                  >
                  <button data-label="Customer Cheque Post" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('party-payment') }}" class="flex-1 block"
                    >Party Payment</a
                  >
                  <button data-label="Party Payment" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="#" class="flex-1 block">Party Cheque Issue</a>
                  <button data-label="Party Cheque Issue" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('party-cheque-post') }}" class="flex-1 block"
                    >Party Cheque Post</a
                  >
                  <button data-label="Party Cheque Post" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('stock-navigation-voucher') }}" class="flex-1 block"
                    >Stock Navigation Voucher</a
                  >
                  <button data-label="Stock Navigation Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('stock-adjustment-voucher') }}" class="flex-1 block"
                    >Stock Adjustment Voucher</a
                  >
                  <button data-label="Stock Adjustment Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('journal-voucher') }}" class="flex-1 block"
                    >Journal Voucher</a
                  >
                  <button data-label="Journal Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('search-all-vouchers') }}" class="flex-1 block"
                    >Search All Voucher</a
                  >
                  <button data-label="Search All Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
              </ul>
            </div>
          </div>

          <!-- NEW: Sync Data group in small sidebar -->
          <div class="group relative hover:bg-gray-100 cursor-pointer">
            <button type="button" class="py-2.5 block mx-auto">
              <i data-feather="database" class="w-5 h-5"></i>
            </button>
            <div
              class="transition duration-300 opacity-0 origin-left scale-0 group-hover:opacity-100 group-hover:scale-100 w-[250px] absolute top-0 left-full bg-white rounded-r-md shadow"
            >
              <h3 class="p-3 bg-gray-50 mb-2">Sync Data</h3>
              <ul class="text-[13px] pl-6 pb-6 space-y-3">
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('sync-contacts') }}" class="flex-1 block">Sync Contacts</a>
                  <button data-label="Sync Contacts" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('sync-item') }}" class="flex-1 block">Sync Item</a>
                  <button data-label="Sync Item" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
              </ul>
            </div>
          </div>

          <div class="group relative hover:bg-gray-100 cursor-pointer">
            <button type="button" class="py-2.5 block mx-auto">
              <i data-feather="tool" class="w-5 h-5"></i>
            </button>
            <div
              class="transition duration-300 opacity-0 origin-left scale-0 group-hover:opacity-100 group-hover:scale-100 w-[300px] absolute top-0 left-full bg-white rounded-r-md shadow"
            >
              <h3 class="p-3 bg-gray-50 mb-2">Setting</h3>
              <ul class="text-[13px] pl-6 pb-6 space-y-3">
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('barcode-setting') }}" class="flex-1 block"
                    >Barcode Setting</a
                  >
                  <button data-label="Barcode Setting" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="#" class="flex-1 block">Printer Setting</a>
                  <button data-label="Printer Setting" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="{{ route('greeting') }}" class="flex-1 block">Greeting</a>
                  <button data-label="Greeting" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <li
                  class="flex items-center justify-between gap-2 pr-2 hover:text-indigo-600"
                >
                  <a href="#" class="flex-1 block">User Level</a>
                  <button data-label="User Level" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </li>
                <!-- NOTE: Sync Contacts removed from Setting; moved to Sync Data -->
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <div
      id="sidebar-c"
      class="sidebar fixed z-10 inset-y-0 left-0 transition duration-300 opacity-0 -translate-x-full w-64 bg-white shadow-lg"
      >
      <div class="flex items-center min-h-16 px-6 bg-indigo-600">
        <i data-feather="box" class="w-6 h-6 text-white"></i>
        <span class="ml-3 text-lg font-semibold text-white">AdminPanel</span>
      </div>
      <nav
        id="sidebar"
        class="px-4 mt-6 space-y-2 overflow-auto h-[calc(100vh_-_100px)]"
        style="scrollbar-width: none"
      >
        <div
          class="flex items-center px-4 justify-between text-indigo-600 bg-indigo-50 rounded-lg"
        >
          <a
            href="#"
            class="flex-1 flex items-center py-2.5 text-sm font-medium"
          >
            <i data-feather="layout" class="w-5 h-5 mr-3"></i>
            Dashboard
          </a>
          <button data-label="Dashboard" type="button">
            <i class="fa-solid fa-star text-gray-300 text-xs"></i>
          </button>
        </div>
        <div class="text-gray-600 font-medium">
          <button
            type="button"
            onclick="toggleMenu(event)"
            class="flex items-center justify-between w-full px-4 py-2.5 text-sm hover:bg-gray-50 rounded-lg"
          >
            <span class="flex items-center">
              <i data-feather="plus" class="w-5 h-5 mr-3"></i>
              Add New
            </span>
            <i
              class="fa-solid fa-chevron-down transition-transform duration-200 text-xs w-[13.5px]"
            ></i>
          </button>
          <div
            class="transition-all duration-500 max-h-0 opacity-0 overflow-hidden"
          >
            <ul class="text-[13px] pl-8">
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('party') }}" class="flex-1 py-2.5">Add New Party</a>
                  <button data-label="Add New Party" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <button
                  class="flex w-full justify-between items-center px-4 py-2.5 hover:bg-gray-50 rounded-lg"
                  onclick="toggleMenu(event)"
                >
                  Area Manager
                  <i
                    class="fa-solid fa-chevron-down transition-transform duration-200 text-xs w-[13.5px]"
                  ></i>
                </button>
                <div
                  class="transition-all duration-500 max-h-0 opacity-0 overflow-hidden"
                >
                  <ul class="pl-4">
                    <li>
                      <div
                        class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                      >
                        <a href="{{ route('city') }}" class="flex-1 py-1.5">City</a>
                        <button data-label="City" type="button">
                          <i
                            class="fa-solid fa-star text-gray-300 text-xs"
                          ></i>
                        </button>
                      </div>
                    </li>
                    <li>
                      <div
                        class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                      >
                        <a href="{{ route('area') }}" class="flex-1 py-1.5">Area</a>
                        <button data-label="Area" type="button">
                          <i
                            class="fa-solid fa-star text-gray-300 text-xs"
                          ></i>
                        </button>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('item') }}" class="flex-1 py-2.5">Add Item</a>
                  <button data-label="Add Item" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('sales-man') }}" class="flex-1 py-2.5">Add New Sales Man</a>
                  <button data-label="Add New Sales Man" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('retail-sale-rate') }}" class="flex-1 py-2.5">Add Retail Sale Rate</a>
                  <button data-label="Add Retail Sale Rate" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('goddown') }}" class="flex-1 py-2.5">Add New Godown</a>
                  <button data-label="Add New Godown" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="text-gray-600 font-medium">
          <button
            type="button"
            onclick="toggleMenu(event)"
            class="flex items-center justify-between w-full px-4 py-2.5 text-sm hover:bg-gray-50 rounded-lg"
          >
            <span class="flex items-center">
              <i data-feather="file-text" class="w-5 h-5 mr-3"></i>
              Invoices
            </span>
            <i
              class="fa-solid fa-chevron-down transition-transform duration-200 text-xs w-[13.5px]"
            ></i>
          </button>
          <div
            class="transition-all duration-500 max-h-0 opacity-0 overflow-hidden"
          >
            <ul class="text-[13px] pl-8">
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('sale-invoice') }}" class="flex-1 py-2.5">Sale Invoice</a>
                  <button data-label="Sale Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="#" class="flex-1 py-2.5">Sale Return Invoice</a>
                  <button data-label="Sale Return Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="#" class="flex-1 py-2.5">Retail Sale Invoice</a>
                  <button data-label="Retail Sale Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="#" class="flex-1 py-2.5"
                    >Retail Sale Return Invoice</a
                  >
                  <button
                    data-label="Retail Sale Return Invoice"
                    type="button"
                  >
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('purchase-invoice') }}" class="flex-1 py-2.5">Purchase Invoice</a>
                  <button data-label="Purchase Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('purchase-return-invoice') }}" class="flex-1 py-2.5"
                    >Purchase Return Invoice</a
                  >
                  <button data-label="Purchase Return Invoice" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="text-gray-600 font-medium">
          <button
            type="button"
            onclick="toggleMenu(event)"
            class="flex items-center justify-between w-full px-4 py-2.5 text-sm hover:bg-gray-50 rounded-lg"
          >
            <span class="flex items-center">
              <i data-feather="gift" class="w-5 h-5 mr-3"></i>
              Vouchers
            </span>
            <i
              class="fa-solid fa-chevron-down transition-transform duration-200 text-xs w-[13.5px]"
            ></i>
          </button>
          <div
            class="transition-all duration-500 max-h-0 opacity-0 overflow-hidden"
          >
            <ul class="text-[13px] pl-8">
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('customer-payment-received') }}" class="flex-1 py-2.5"
                    >Customer Payment Received</a
                  >
                  <button
                    data-label="Customer Payment Received"
                    type="button"
                  >
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('customer-cheque-post') }}" class="flex-1 py-2.5">Customer Cheque Post</a>
                  <button data-label="Customer Cheque Post" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('party-payment') }}" class="flex-1 py-2.5">Party Payment</a>
                  <button data-label="Party Payment" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="#" class="flex-1 py-2.5">Party Cheque Issue</a>
                  <button data-label="Party Cheque Issue" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('party-cheque-post') }}" class="flex-1 py-2.5">Party Cheque Post</a>
                  <button data-label="Party Cheque Post" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('stock-navigation-voucher') }}" class="flex-1 py-2.5"
                    >Stock Navigation Voucher</a
                  >
                  <button data-label="Stock Navigation Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('stock-adjustment-voucher') }}" class="flex-1 py-2.5"
                    >Stock Adjustment Voucher</a
                  >
                  <button data-label="Stock Adjustment Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('journal-voucher') }}" class="flex-1 py-2.5">Journal Voucher</a>
                  <button data-label="Journal Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('search-all-vouchers') }}" class="flex-1 py-2.5">Search All Voucher</a>
                  <button data-label="Search All Voucher" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <!-- NEW: Sync Data section in responsive sidebar -->
        <div class="text-gray-600 font-medium">
          <button
            type="button"
            onclick="toggleMenu(event)"
            class="flex items-center justify-between w-full px-4 py-2.5 text-sm hover:bg-gray-50 rounded-lg"
          >
            <span class="flex items-center">
              <i data-feather="database" class="w-5 h-5 mr-3"></i>
              Sync Data
            </span>
            <i
              class="fa-solid fa-chevron-down transition-transform duration-200 text-xs w-[13.5px]"
            ></i>
          </button>
          <div
            class="transition-all duration-500 max-h-0 opacity-0 overflow-hidden"
          >
            <ul class="text-[13px] pl-8">
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('sync-contacts') }}" class="flex-1 py-2.5">Sync Contacts</a>
                  <button data-label="Sync Contacts" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('sync-item') }}" class="flex-1 py-2.5">Sync Item</a>
                  <button data-label="Sync Item" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
            </ul>
          </div>
        </div>

        <div class="text-gray-600 font-medium">
          <button
            type="button"
            onclick="toggleMenu(event)"
            class="flex items-center justify-between w-full px-4 py-2.5 text-sm hover:bg-gray-50 rounded-lg"
          >
            <span class="flex items-center">
              <i data-feather="tool" class="w-5 h-5 mr-3"></i>
              Setting
            </span>
            <i
              class="fa-solid fa-chevron-down transition-transform duration-200 text-xs w-[13.5px]"
            ></i>
          </button>
          <div
            class="transition-all duration-500 max-h-0 opacity-0 overflow-hidden"
          >
            <ul class="text-[13px] pl-8">
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('barcode-setting') }}" class="flex-1 py-2.5">Barcode Setting</a>
                  <button data-label="Barcode Setting" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="#" class="flex-1 py-2.5">Printer Setting</a>
                  <button data-label="Printer Setting" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="{{ route('greeting') }}" class="flex-1 py-2.5">Greeting</a>
                  <button data-label="Greeting" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <li>
                <div
                  class="flex items-center justify-between px-4 hover:bg-gray-50 rounded-lg"
                >
                  <a href="#" class="flex-1 py-2.5">User Level</a>
                  <button data-label="User Level" type="button">
                    <i class="fa-solid fa-star text-gray-300 text-xs"></i>
                  </button>
                </div>
              </li>
              <!-- NOTE: Sync Contacts removed from Setting; moved to Sync Data -->
            </ul>
          </div>
        </div>
      </nav>
    </div>

      <div class="transition-all duration-200 lg:pl-[70px]">
        <div class="bg-white shadow-sm">
          <div id="favourites"></div>
        </div>

        <div id="pjax-container">
          @yield('content')
        </div>

        <div
          id="modal-cam"
          class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0"
        >
          <div
            class="rounded-lg shadow-lg w-full max-w-[1200px] overflow-auto max-h-[95vh] transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
            style="scrollbar-width: none"
          >
            <div id="modal-content-cam">
              <video
                id="videoFeed"
                autoplay
                class="w-screen h-[500px] rounded-lg object-cover"
              ></video>
            </div>
            <div
              class="flex items-center gap-3 justify-end text-sm mt-2 bg-white p-6"
            >
              <button
                class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                type="button"
                onclick="closeCamera()"
              >
                Close
              </button>
              <button
                class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                type="button"
                onclick="capturePhoto()"
              >
                Capture
              </button>
            </div>
          </div>
        </div>



    <script src="{{asset('assets/js/trackpath.js?v=9')}}"></script>
    <script src="{{asset('assets/js/favouritesPath.js?v=4')}}"></script>
    <script src="{{asset('assets/js/app.js?v=9')}}"></script>

    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    ></script>

    <script
    src="https://selectize.dev/js/selectize.js"

  ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>



    <script>

      feather.replace();
      $(".selectize-input-sp").selectize();

      $(document).ready(function () {
        $("#my-datatable").DataTable({
          responsive: true,
          pageLength: 10,
        });

        // Handle "Select All" checkbox
        $("#selectAll").on("click", function () {
          const rows = $("#example")
            .DataTable()
            .rows({ search: "applied" })
            .nodes();
          $('input[type="checkbox"]', rows).prop("checked", this.checked);
        });
      });


      toastr.options = {
        "positionClass": "toast-center",
        "timeOut": "700", // Notification timeout (adjust as needed)
        "extendedTimeOut": "500", // Extra time if hovered (optional)
        "closeButton": true, // Show close button
        "progressBar": true, // Show progress bar (optional)
        "showDuration": "100", // Animation duration
        "hideDuration": "200", // Fade-out duration
        "showMethod": "fadeIn", // Show animation
        "hideMethod": "fadeOut" // Hide animation
      };




function showLoader() {
    jQuery('#global-preloader').css('display', 'flex');
}

function hideLoader() {
    jQuery('#global-preloader').hide();
}

    </script>

    @yield('scripts')

</body>
</html>
