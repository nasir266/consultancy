@extends('layouts.master')

@section('title','Party')

@section('styles')

  <style>
    #mobile-label .flex-wrap{
        flex-wrap: nowrap;
    }
    #mobile-label button{
      font-size: 12px;
    }
  </style>

@endsection

@section('content')

<div class="p-2.5 md:p-6">
    <form enctype="multipart/form-data" id="form" method="post" action="#" class="text-[13px] lg:text-base">
        @csrf
      <div class="flex flex-col">
        <div class="bg-white rounded-t-xl">
          <div class="flex items-center flex-wrap gap-4 px-4 ">
            <div class="flex-1 max-w-[200px]">
              <label for="" class="text-gray-600 font-medium">Date</label>
              <input
                id="date"
                name="date"
                type="date"
                class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                value="{{ date("Y-m-d") }}"
                required
              />
            </div>
            <div class="flex-1">
              <label for="" class="text-gray-600 font-medium">Search</label>
              <select onchange="syncPartyId(this, 'id')" class="selectize-input-sp" name="search" id="search">
                <option value="">Search</option>
                @foreach($search as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} {{ "- " . $item->mobile }} @foreach($item->party_mobiles as $m_item) {{ ", "  . $m_item->mobile}} @endforeach</option>
                @endforeach
              </select>
            </div>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-b-xl px-4 py-2">
          <div class="space-y-2">
            <div class="flex gap-3 flex-wrap">
              <div class="flex flex-col flex-none w-full max-w-[100px]"> <!-- Reduced width here -->
                <label for="id" class="text-gray-600 font-medium">ID</label>
                <input oninput="syncPartyId(this, 'search')" type="number" id="id" name="id" value="{{$id+1}}" min="1" max="{{$id+1}}" class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md" required="">
              </div>
              <div class="flex flex-col flex-grow md:flex-1">
                <label for="name" class="text-gray-600 font-medium">Name</label>
                <input type="text" id="name" name="name" placeholder="Jhon Doe" class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md" required="">
              </div>
            </div>

            <div class="flex gap-3 flex-wrap">


              <div class="flex flex-col flex-grow md:flex-1">
                <label for="mobile" class="text-gray-600 font-medium"
                  >Mobile <span class="text-danger mobile_already"></span></label
                >
                <input
                  type="number"
                  id="mobile"
                  name="mobile"
                  placeholder="0321-321-3841"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md mobile"
                />
              </div>

              <div class="flex gap-2 items-end flex-grow md:flex-1">
                <div class="flex flex-col flex-1">
                  <label for="label" class="text-gray-600 font-medium"
                    >Label</label
                  >
                  <input
                    type="text"
                    id="label"
                    name="label"
                    placeholder="GC Garments"
                    class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                  />
                </div>
                <button
                  type="button"
                  onclick="openModal(event, 'mobile-label')"
                  class="px-4 py-2.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                >
                  <i data-feather="plus" class="w-4 h-4"></i>
                </button>
              </div>
              <div class="flex flex-col flex-grow md:flex-1">
                <label for="type" class="text-gray-600 font-medium"
                  >Type</label
                >
                <select class="block w-full bg-gray-800 text-gray-200 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="type" id="type" required>
                    <option value="">Select</option>
                    <option value="Income">Income</option>
                    <option value="Expensive">Expensive</option>
                    <option value="Assets">Assets</option>
                    <option value="Debitor">Debitor</option>
                    <option value="Creditor">Creditor</option>
                    <option value="Liabilities">Liabilities</option>
                </select>
              </div>
            </div>

            <div class="flex gap-3 flex-wrap">
              <div class="flex gap-2 items-end flex-grow md:flex-1">
                <div class="flex flex-col flex-1">
                  <label for="city" class="text-gray-600 font-medium"
                    >City</label
                  >
                  <select class="selectize-input-sp" onchange="get_areas(this.value)" name="city" id="city" required>
                    <option value="">Select City</option>
                    @foreach($cities as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                </div>
                <button
                  type="button"
                  onclick="openModal(event, 'city-model')"
                  class="px-4 py-2.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                >
                  <i data-feather="plus" class="w-4 h-4"></i>
                </button>
              </div>
              <div class="flex gap-2 items-end flex-grow md:flex-1">
                <div class="flex flex-col flex-1">
                  <label for="area" class="text-gray-600 font-medium"
                    >Area</label
                  >
                  <select class="selectize-input-sp" name="area" id="area" required>
                    <option value="">Select Area</option>
                   </select>
                </div>
                <button
                  type="button"
                  onclick="openModal(event,'area-model')"
                  class="px-4 py-2.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                >
                  <i data-feather="plus" class="w-4 h-4"></i>
                </button>
              </div>
            </div>

            <div class="flex gap-3 flex-wrap">
              <div class="flex flex-col flex-grow md:flex-1">
                <label for="address" class="text-gray-600 font-medium"
                  >Address</label
                >
                <textarea placeholder="Gulberg, Block A, 22/a7" name="address" id="address" cols="30" rows="1" class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"></textarea>
              </div>
            </div>


            <div class="flex gap-3 flex-wrap">





              <div class="flex gap-2 items-end flex-grow md:flex-1">
                <div class="flex flex-col flex-1">
                  <label for="discount" class="text-gray-600 font-medium"
                    >Discount</label
                  >
                  <input
                    type="number"
                    name="discount"
                    id="discount"
                    class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                  />
                </div>

                <button
                  class="block px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                  onclick="openModal(event, 'addless-model')"
                  type="button"
                >
                  Add Less
                </button>
              </div>
              <div class="flex flex-col flex-grow md:flex-1">
                <label for="remark" class="text-gray-600 font-medium"
                  >Remark</label
                >
                <input
                  type="text"
                  name="remark"
                  id="remark"
                  placeholder="Remark"
                  class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                />
              </div>
            </div>
          </div>
        </div>

        <div
          class="mt-4 flex items-center flex-wrap gap-2 justify-between bg-white p-4 py-3 rounded-lg shadow-sm"
        >
          <div class="space-y-2">
            <h3 class="text-2xl font-medium">Status</h3>
            <div class="flex items-center gap-4">
              <div class="flex items-center gap-2">
                <label for="active" class="text-gray-600 font-medium"
                  >Active</label
                >
                <input
                  type="radio"
                  name="status"
                  id="active"
                  value="active"
                  checked
                  class="accent-indigo-600 w-3 h-3"
                />
              </div>
              <div class="flex items-center gap-2">
                <label for="inactive" class="text-gray-600 font-medium"
                  >Inactive</label
                >
                <input
                  type="radio"
                  name="status"
                  id="inactive"
                  value="inactive"
                  class="accent-red-600 w-3 h-3"
                />
              </div>
            </div>
          </div>

          <div class="flex items-center flex-wrap gap-3 justify-end">
            <button
              onclick="window.location.reload();"
              class="flex items-center px-6 mt-3 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
              type="button"
            >
              <i data-feather="refresh-ccw" class="w-5 h-5 mr-3"></i>
              Reset
            </button>
            <button
              class="flex items-center px-6 mt-3 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600 save_button"
              type="submit"
            >
              <i data-feather="save" class="w-5 h-5 mr-3"></i>
              <span id="save_button">Save</span>
            </button>
          </div>
        </div>

        <div class="col-span-2 space-y-4 bg-white rounded-xl p-4 mt-4">
          <h3 class="text-2xl font-medium">Optional</h3>
          <div class="flex flex-wrap gap-4 lg:gap-8">
            <div class="grid grid-cols-2 gap-3 flex-grow md:flex-1">
              <div class="flex flex-col">
                <label for="bill-limit" class="text-gray-600 font-medium"
                  >Bill Limit</label
                >
                <input
                  type="number"
                  name="bill_limit"
                  id="bill_limit"
                  placeholder="Enter Bill Limit"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                />
              </div>
              <div class="flex flex-col">
                <label
                  for="visit-duration"
                  class="text-gray-600 font-medium"
                  >Visit Duration (Day)</label
                >
                <input
                  type="number"
                  name="duration"
                  id="duration"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                />
              </div>
              <div class="flex flex-col">
                <label for="care-of" class="text-gray-600 font-medium"
                  >Care Of</label
                >
                <input
                  type="text"
                  name="care_of"
                  id="care_of"
                  placeholder="Enter Care of"
                  class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                />
              </div>
              <div class="flex flex-col">
                <label for="email" class="text-gray-600 font-medium"
                  >Email</label
                >
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="jhondoe@gmail.com"
                  class="border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                />
              </div>
              <div class="col-span-2 flex flex-col">
                <label for="w-message" class="text-gray-600 font-medium"
                  >Whatsapp Message</label
                >
                <textarea
                  id="whatsapp_greeting"
                  type="text"
                  name="whatsapp_greeting"
                  id="w-message"
                  placeholder="Whatsapp Greeting"
                  rows="5"
                  class="resize-none border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 p-4 rounded-md"
                ></textarea>
              </div>
            </div>
            <div
              class="flex-grow md:flex-grow-0 md:w-1/3 flex flex-col gap-6"
            >
            <div>
              <button
                type="button"
                class="px-4 py-0.5 w-fit hidden mb-2 transition-colors duration-200 bg-red-400 border border-red-400 text-white rounded-lg hover:bg-red-50 hover:text-red-400"
                onclick="openModal(event, 'files-model')"
                id="show-files"
              >
                Show
              </button>

              <div class="flex items-center gap-3">
                <label
                  for="file"
                  class="flex items-center justify-center gap-2 flex-col flex-1 cursor-pointer transition-colors hover:bg-red-50 h-32 p-2 border-2 border-dashed border-red-300 rounded-xl"
                >
                  <input
                    id="file"
                    type="file"
                    class="hidden"
                    name="file"
                    multiple
                    onchange="uploadFile(event,'file')"
                  />
                  <i
                    class="fa-regular fa-file text-5xl text-red-400"
                  ></i>
                  <img
                    id="file-preview"
                    class="block hidden w-full h-full object-cover rounded-md"
                    alt=""
                  />
                  <span
                    class="block text-xs font-medium text-red-400 underline"
                    >Upload File</span
                  >
                </label>
                <button
                  class="flex items-center justify-center gap-2 flex-col flex-1 cursor-pointer transition-colors hover:bg-red-50 h-32 p-2 border-2 border-dashed border-red-300 rounded-xl"
                  type="button"
                  onclick="opneCam(event, 'file')"
                >
                  <i
                    class="fa-solid fa-camera text-4xl text-red-400"
                  ></i>
                  <span
                    class="block text-xs font-medium text-red-400 underline"
                    >Open Camera</span
                  >
                </button>
              </div>
            </div>
            <div>
              <button
                type="button"
                class="px-4 py-0.5 hidden w-fit mb-2 transition-colors duration-200 bg-green-400 border border-green-400 text-white rounded-lg hover:bg-green-50 hover:text-green-400"
                onclick="openModal(event, 'w-files-model')"
                id="show-w-files"
              >
                Show
              </button>
              <div class="flex items-center gap-3">
                <label
                  for="w-file"
                  class="flex items-center justify-center gap-2 flex-col flex-1 cursor-pointer transition-colors hover:bg-green-50 h-32 p-2 border-2 border-dashed border-green-300 rounded-xl"
                >
                  <input
                    id="w-file"
                    type="file"
                    class="hidden"
                    name="whatsapp_file"
                    multiple
                    onchange="uploadFile(event,'w-file')"
                  />
                  <i
                    class="fa-brands fa-whatsapp text-5xl text-green-400"
                  ></i>
                  <img
                    id="w-preview"
                    class="block hidden w-full h-full object-cover rounded-md"
                    alt=""
                  />
                  <span
                    class="block text-xs font-medium text-green-400 underline"
                    >Whatsapp File</span
                  >
                </label>
                <button
                  class="flex items-center justify-center gap-2 flex-col flex-1 cursor-pointer transition-colors hover:bg-green-50 h-32 p-2 border-2 border-dashed border-green-300 rounded-xl"
                  type="button"
                  onclick="opneCam(event, 'w-file')"
                >
                  <i
                    class="fa-solid fa-camera text-4xl text-green-400"
                  ></i>
                  <span
                    class="block text-xs font-medium text-green-400 underline"
                    >Open Camera</span
                  >
                </button>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>




<div
id="mobile-label"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Mobile/Label</h3>
    <div class="flex items-end flex-wrap gap-3">
      <div class="flex flex-col">
        <label class="text-gray-600 font-medium"
          >Mobile <span class="text-danger mobile_already"></span></label
        >
        <input
          name="mobile1[]"
          placeholder="Enter Mobile"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md mobile"
          type="number"
        />
      </div>
      <div class="flex flex-col">
        <label class="text-gray-600 font-medium"
          >Label</label
        >
        <input
          name="label1[]"
          placeholder="Enter Label"
          class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="text"
        />
      </div>
      <div>
        <button
          class="px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          onclick="addNewRow(event, 'mobile-label')"
        >
          ADD
        </button>
      </div>
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'mobile-label','type')"
    >
      Close
    </button>

  </div>
</div>
</div>

<div
id="city-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">City</h3>
    <div class="flex flex-col">
      <label id="city-sh" class="text-gray-600 font-medium">City</label>
      <input
        id="city_add"
        placeholder="Enter City"
        class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-2 rounded-md"
        type="text"
        required
      />
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'city-model','area')"
    >
      Close
    </button>
    <button
      id="insertCity"
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      Save
    </button>
  </div>
</div>
</div>

<div
id="area-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Area</h3>
    <div class="flex flex-col">
      <label id="city-ch" class="text-gray-600 font-medium">City</label>
      <select class="selectize-input-sp" name="popup_city" id="popup_city" required>
        <option value="">Select City</option>
        @foreach($cities as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="flex flex-col mt-5">
      <label id="area-sh" class="text-gray-600 font-medium">Area</label>
      <input
        id="popup_area"
        name="popup_area"
        placeholder="Enter an Area"
        class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-2 rounded-md"
        type="text"
        required
      />
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'area-model','address')"
    >
      Close
    </button>
    <button
      id="insertArea"
      class="px-5 py-2 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
    >
      Save
    </button>
  </div>
</div>
</div>

<div
id="addless-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">From-To-Less</h3>
    <div class="flex flex-wrap sm:flex-nowrap items-end gap-3">
      <div class="flex flex-col flex-grow sm:flex-grow-0">
        <label id="from" class="text-gray-600 font-medium">From</label>
        <input
          name="from[]"
          id="from"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="number"
        />
      </div>
      <div class="flex flex-col flex-grow sm:flex-grow-0">
        <label id="to" class="text-gray-600 font-medium">To</label>
        <input
          name="to[]"
          id="to"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="number"
        />
      </div>
      <div class="flex flex-col flex-grow sm:flex-grow-0">
        <label id="less" class="text-gray-600 font-medium">Less</label>
        <input
          name="less[]"
          id="less"
          class="no-arrows border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
          type="number"
        />
      </div>
      <div class="flex-grow sm:flex-grow-0">
        <button
          class="px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
          onclick="addNewless(event, 'addless-model')"
        >
          ADD
        </button>
      </div>
    </div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'addless-model','remark')"
    >
      Close
    </button>
  </div>
</div>
</div>

<div
id="files-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Files</h3>
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3"
    ></div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'files-model')"
    >
      Close
    </button>
  </div>
</div>
</div>

<div
id="w-files-model"
class="group hidden z-10 px-4 fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-opacity ease-linear duration-200 opacity-0 model"
>
<div
  class="bg-white rounded-lg shadow-lg w-full max-w-[600px] p-4 sm:p-6 overflow-auto max-h-[95vh] text-[13px] md:text-base transition-transform duration-300 ease-out -translate-y-14 group-[.opacity-100]:transform-none"
  style="scrollbar-width: none"
>
  <div id="modal-content" class="text-gray-700">
    <h3 class="text-gray-600 text-xl font-medium mb-6">Whatsapp Files</h3>
    <div
      class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3"
    ></div>
  </div>
  <div class="flex items-center gap-3 justify-end text-sm mt-14">
    <button
      class="px-5 py-2 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
      onclick="closeModal(event, 'w-files-model')"
    >
      Close
    </button>
  </div>
</div>
</div>


@endsection


@section('scripts')

<script>


jQuery(document).ready(function() {
        jQuery(document).on("keydown", function(event) {
            if (event.which === 13) { // Enter key
                event.preventDefault(); // Prevent default behavior (e.g., form submission)

                // Get all focusable elements in the DOM, including those inside iframes and modals
                var focusable = jQuery("a, button, input, select, textarea, [tabindex]:not([tabindex='-1'])")
                    .filter(":visible:not([disabled]):not([readonly])"); // Exclude disabled/readonly elements

                var activeElement = jQuery(document.activeElement); // Get the currently focused element
                var index = focusable.index(activeElement);

                // Handle focus shift properly
                if (index > -1) {
                    var nextIndex = index + 1;

                    // Loop back to the first focusable element if at the end
                    if (nextIndex >= focusable.length) {
                        nextIndex = 0;
                    }

                    focusable.eq(nextIndex).focus();
                }
            }
        });
    });


$("#name").focus();

$(document).on('change', '.mobile', function () {
    var mobile = $(this).val();
    var excludeId = $("#id").val();
    var mobile_obj = $(this);
    if (mobile) {
        $.ajax({
            url: "{{ route('ajax.check_party_mobile') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                mobile: mobile,
                exclude_id: excludeId
            },
            success: function (response) {
                if (response.exists) {
                    var txt = 'Mobile already exists on ' + response.id;
                    alert(txt);
                    $(mobile_obj).prev('label').find(".mobile_already").text("("+txt+")");
                }else{
                    $(mobile_obj).prev('label').find(".mobile_already").text("");
                }
            },
            error: function () {
                alert('An error occurred while checking the mobile number.');
            }
        });
    }
});

function reset_data() {
    $("#search")[0].selectize.setValue("");
    $('#date').val("<?php echo date('Y-m-d') ?>");
    $('#name').val("");
    $('#mobile').val("");
    $('#label').val("");
    $('#type').val("");
    $("#city")[0].selectize.setValue("");
    $("#area")[0].selectize.setValue("");
    $('#address').val("");
    $('#discount').val("");
    $('#remark').val("");
    $('#bill_limit').val("");
    $('#duration').val("");
    $('#email').val("");
    $('#care_of').val("");
    $('#whatsapp_greeting').val("");
    $('#active').prop('checked', true);
    $("#save_button").text("Save");
}

let isSyncing = false;

function syncPartyId(source, targetId) {
  if (isSyncing) return; // Prevent re-triggering
    isSyncing = true;
    const target = document.getElementById(targetId);
    if(target.tagName === "SELECT"){
      $("#"+targetId)[0].selectize.setValue(source.value);
    }else{
      target.value = source.value;
    }
    get_id_party(source.value);
    isSyncing = false;
}
function capitalizeFirstLetter(str) {
    if (str.length === 0) {
        return ""; // Handle empty strings
    }
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}
function get_id_party(value) {
    var name = value;

    $.ajax({
        url: "{{ route('ajax.party.search.id') }}",
        type: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            value: value,
        },
        success: function(response) {
            if (response) {
                //console.log(response);
                $("#save_button").text("Update");
                var data = response;
                //console.log(capitalizeFirstLetter(data.type));
                if (Object.keys(data).length > 0) {
                    $('#date').val(data.date);
                    $('#name').val(data.name);
                    $('#mobile').val(data.mobile);
                    $('#label').val(data.label);
                    $("#type").val(capitalizeFirstLetter(data.type));
                   ///$("#type")[0].selectize.setValue(data.type);
                    ///$("#type-selectized")[0].selectize.setValue(data.type, true);
                    $("#city")[0].selectize.off('change');
                    $("#city")[0].selectize.setValue(data.area.city_id, false);
                    get_areas(data.area.city.id, data.area_id);
                    $("#city")[0].selectize.on('change', function(value) {
                      get_areas(value);
                    });
                    $('#address').val(data.address);
                    $('#discount').val(data.discount);
                    $('#remark').val(data.remark);
                    $('#bill_limit').val(data.bill_limit);
                    $('#duration').val(data.duration);
                    $('#email').val(data.email);
                    $('#care_of').val(data.care_of);
                    $('#whatsapp_greeting').val(data.whatsapp_greeting);

                    if (data.status == 'inactive') {
                        $('#inactive').prop('checked', true);
                        $('#name')[0].style.setProperty('border-color', 'red', 'important');
                    } else {
                        $('#active').prop('checked', true);
                        $('#name')[0].style.setProperty('border-color', '#aaa', 'important');
                    }




                    if(data.party_mobiles.length > 0){
                        const modalContent = document.getElementById("mobile-label").querySelector("#modal-content");

                        modalContent.innerHTML = `<h3 class="text-gray-600 text-xl font-medium mb-6">Mobile/Label</h3>`;

                        data.party_mobiles.forEach((item, index) => {
                          modalContent.innerHTML += `
                            <div class="flex items-end flex-wrap gap-3 mt-5">
                              <div class="flex flex-col gap-1">
                                <label class="text-gray-600 font-medium">Mobile</label>
                                <input
                                  name="mobile1[]"
                                  class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                                  type="text"
                                  value="${item.mobile || ''}"
                                />
                              </div>
                              <div class="flex flex-col gap-1">
                                <label class="text-gray-600 font-medium">Label</label>
                                <input
                                  name="label1[]"
                                  class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                                  type="text"
                                  value="${item.label || ''}"
                                />
                              </div>
                              <div>
                                ${
                                  index === 0
                                    ? `<button
                                        class="px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                                        onclick="addNewRow(event, 'mobile-label')"
                                      >
                                        Add
                                      </button>`
                                    : `<button
                                        class="px-4 py-1.5 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                                        onclick="removeRow(event)"
                                      >
                                        Remove
                                      </button>`
                                }
                              </div>
                            </div>`;
                          });
                    }


                    if(data.party_less.length > 0){

                        const partyLessContent = document.getElementById("addless-model").querySelector("#modal-content");

                        partyLessContent.innerHTML = '<h3 class="text-gray-600 text-xl font-medium mb-6">From-To-Less</h3>';

                        data.party_less.forEach((item, index) => {
                          partyLessContent.innerHTML += `
                            <div class="flex flex-wrap sm:flex-nowrap items-end gap-3 mt-5">
                              <div class="flex flex-col gap-1">
                                <label class="text-gray-600 font-medium">From</label>
                                <input
                                  name="from[]"
                                  class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                                  type="text"
                                  value="${item.from || ''}"
                                />
                              </div>
                              <div class="flex flex-col gap-1">
                                <label class="text-gray-600 font-medium">To</label>
                                <input
                                  name="to[]"
                                  class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                                  type="text"
                                  value="${item.to || ''}"
                                />
                              </div>
                              <div class="flex flex-col gap-1">
                                <label class="text-gray-600 font-medium">Less</label>
                                <input
                                  name="less[]"
                                  class="border border-gray-300 w-full transition-all duration-200 focus:border-none focus:outline-indigo-500 px-4 py-1.5 rounded-md"
                                  type="text"
                                  value="${item.less || ''}"
                                />
                              </div>
                              <div class="flex-grow sm:flex-grow-0">
                                ${
                                  index === 0
                                    ? `<button
                                        class="px-4 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
                                        onclick="addNewless(event, 'addless-model')"
                                      >
                                        Add
                                      </button>`
                                    : `<button
                                        class="px-4 py-1.5 transition-colors duration-200 bg-red-600 border border-red-600 text-white rounded-lg hover:bg-transparent hover:text-red-600"
                                        onclick="removeRow(event)"
                                      >
                                        Remove
                                      </button>`
                                }
                              </div>
                            </div>`;
                        });
                  }
                } else {
                    reset_data();
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function get_areas(cityId, area_id = null) {

    // Clear the area dropdown options
    $("#area")[0].selectize.clearOptions();
    $("#area")[0].selectize.clear(); // Optional: clear the current selection

    if (cityId) {
        // Fetch areas via AJAX
        $.ajax({
            url: '/ajax/get_areas/' + cityId,
            type: 'GET',
            success: function(data) {
                data.forEach(function(area) {
                    $("#area")[0].selectize.addOption({
                        value: area.id,
                        text: area.name
                    });
                });

                $("#popup_city")[0].selectize.setValue(cityId); // Set the value

                if (area_id != null) {
                    $("#area")[0].selectize.setValue(area_id); // Set the value
                }

            },
            error: function() {
                alert('Unable to fetch areas. Please try again later.');
            }
        });
    }
}




$(document).ready(function() {
    $('#form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Get all form data
        let formData = new FormData(this);

        let hasValues = false; // Flag to check if there are any non-empty values

        // Get all inputs with the name 'mobile1[]' and 'label1[]'
        let mobileInputs = document.querySelectorAll('input[name="mobile1[]"]');
        let labelInputs = document.querySelectorAll('input[name="label1[]"]');

        // Append each value to formData
        mobileInputs.forEach((mobileInput, index) => {
            // Check if both mobile and label input are empty at the same time
            if (mobileInput.value || labelInputs[index].value) {
                formData.append('mobile1[]', mobileInput.value);
                formData.append('label1[]', labelInputs[index].value);
                hasValues = true;
            }
        });

        if (!hasValues) {
            formData.append('mobile1[]', '');
            formData.append('label1[]', '');
        }

        hasValues = false;

        // Get all inputs with the name 'from[]', 'to[]', and 'less[]'
        let from = document.querySelectorAll('input[name="from[]"]');
        let to = document.querySelectorAll('input[name="to[]"]');
        let less = document.querySelectorAll('input[name="less[]"]');


        // Append each value to formData
        from.forEach((fromInput, index) => {
            if (fromInput.value || to[index].value || less[index].value) {
                formData.append('from[]', fromInput.value);
                formData.append('to[]', to[index].value);
                formData.append('less[]', less[index].value);
                hasValues = true;
            }
        });

        // If no values were added, append empty arrays
        if (!hasValues) {
            formData.append('from[]', '');
            formData.append('to[]', '');
            formData.append('less[]', '');
        }



        $("#save").text("Please wait...");
        $("#save").attr("disabled", true);

        // Send AJAX request
        $.ajax({
            url: "{{ route('party.post') }}", // Laravel route URL
            method: 'POST',
            data: formData,
            contentType: false, // Ensure no content-type header is set
            processData: false, // Ensure jQuery doesn't try to process the data
            success: function(response) {
                $("#save").text("Reloading");
                $("#save").attr("disabled", false);
                if($("#save_button").text() == "Update"){
                  toastr.success('Party Updated Successfully!', 'Success', {
                    timeOut: 600,
                    onHidden: function() {
                        location.reload();
                    }
                });
                }else{
                  toastr.success('Party Added Successfully!', 'Success', {
                    timeOut: 600,
                    onHidden: function() {
                        location.reload();
                    }
                });
                }
            },
            error: function(xhr) {
                // Display errors if any
                let errors = xhr.responseJSON.errors;
                let errorHtml = '<ul>';
                $.each(errors, function(key, value) {
                    errorHtml += '<li>' + value[0] + '</li>';
                });
                errorHtml += '</ul>';
                $('#response').html(errorHtml);
            }
        });
    });
});

$("#insertArea").on("click", function(e) {
    e.preventDefault();
    var popup_city = $("#popup_city").val();
    var popup_area = $("#popup_area").val();

    if (popup_city == "" || popup_area == "") {
        toastr.error('Fields are required!', 'Error');
        return;
    }

    $("#insertArea").attr("disabled", true);
    $("#insertArea").text("Please Wait...");

    $.ajax({
        url: "{{ route('ajax.insert_area') }}",
        type: "POST",
        data: {
            '_token': '{{csrf_token()}}',
            city: popup_city,
            name: popup_area
        },
        success: function(data) {
            if (data.success === true) {
                toastr.success('Area Added Successfully!', 'Success');
                closeModal(event, 'area-model');

                var area = $("#area")[0].selectize;

                area.addOption({
                    value: data.id, // Use the ID from the data
                    text: popup_area // Assign the name "popup_area" or any desired label
                });

                area.setValue(data.id);

                $("#address").focus();

            } else {
                toastr.error('Area Already Exist!', 'Error')
            }

            $("#insertArea").attr("disabled", false);
            $("#insertArea").text("Save");
        }
    });
});



$("#insertCity").on("click", function(e) {

    e.preventDefault();

    var city_name = $("#city_add").val();

    if (city_name == "") {
        toastr.error('Fields are required!', 'Error');
        return;
    }

    $("#insertCity").attr("disabled", true);
    $("#insertCity").text("Please Wait...");

    $.ajax({
        url: "{{ route('ajax.insert_city') }}",
        type: "POST",
        data: {
            '_token': '{{csrf_token()}}',
            name: city_name
        },
        success: function(data) {
            if (data.result === "success") {
                toastr.success('City Added Successfully!', 'Success');


                $("#popup_city")[0].selectize.addOption({
                    value: data.id,
                    text: city_name
                });

                $("#popup_city")[0].selectize.setValue();

                $("#city")[0].selectize.addOption({
                    value: data.id,
                    text: city_name
                });

                $("#city")[0].selectize.setValue(data.id);
                $("#popup_city")[0].selectize.setValue(data.id);

                closeModal(event, 'city-model');

                $("#area")[0].selectize.focus();


            } else {
                toastr.error('City Already Exist!', 'Error')
            }

            $("#insertCity").attr("disabled", false);
            $("#insertCity").text("Save");
        }
    });
});

</script>

@endsection
