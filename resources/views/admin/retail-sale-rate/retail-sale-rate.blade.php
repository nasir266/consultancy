@extends('layouts.master')

@section('title','Retail Sale Rate')

@section('content')

<div class="p-2.5 md:px-5 md:py-4 text-[13px] lg:text-base">
    <form method="post" action="{{ route('retail-sale-rate.update') }}" class="p-5 bg-white rounded-xl">
      @csrf
      <div class="space-y-5">

        @if(Session::has("success"))
        <div class="alert alert-success">
          {{Session::get("success")}}
        </div>
        @endif

        <div class="max-w-[700px]">
          <label
            for="r-sale-rate"
            class="block text-gray-600 font-medium mb-1"
            >Retail Sale Rate (%)</label
          >
          <input
            id="r-sale-rate"
            type="number"
            name="retail_sale_rate"
            class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-5 py-2.5 rounded-md"
            placeholder="Enter Rate"
            value="{{ $get->retail_sale_rate }}"

            onkeyup="chengeType(this.id)"
          />
        </div>

        <div class="max-w-[700px]">
          <label
            for="r-sale-rate-rs"
            class="block text-gray-600 font-medium mb-1"
            >Retail Sale Rate (Rs)</label
          >
          <input
            id="r-sale-rate-rs"
            type="number"
            name="retail_sale_rate_rs"
            class="no-arrows border border-gray-300 w-full transition-all ease-in-out duration-200 focus:border-none focus:outline-indigo-500 px-5 py-2.5 rounded-md"
            placeholder="Enter Rate"
            value="{{ $get->retail_sale_rate_rs }}"
            onkeyup="chengeType(this.id)"
          />
        </div>

        <div class="flex items-center flex-wrap gap-3">
          <button
            class="flex items-center px-3 py-1.5 transition-colors duration-200 bg-indigo-600 border border-indigo-600 text-white rounded-lg hover:bg-transparent hover:text-indigo-600"
            type="submit"
          >
            <i data-feather="chevrons-up" class="w-4 h-4 mr-3"></i>
            Update
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
<script>
    function chengeType(id) {

        var r_sale_rate = document.getElementById('r-sale-rate').value;
        var r_sale_rate_rs = document.getElementById('r-sale-rate-rs').value;


        if(id === 'r-sale-rate' ){

            if(r_sale_rate > 1 || r_sale_rate != ''){
                document.getElementById('r-sale-rate-rs').value = 0;
                document.getElementById('r-sale-rate-rs').readOnly = true;
            }else{
                window.alert(r_sale_rate);
                document.getElementById('r-sale-rate-rs').removeAttribute('readonly');
            }
        }else if(id === 'r-sale-rate-rs'){

            if(r_sale_rate_rs > 1 || r_sale_rate_rs != ''){
                document.getElementById('r-sale-rate').value = 0;
                document.getElementById('r-sale-rate').readOnly = true;
            }else{
                //window.alert(r_sale_rate_rs);
                document.getElementById('r-sale-rate').removeAttribute('readonly');
            }
        }
    }
</script>
@endsection


