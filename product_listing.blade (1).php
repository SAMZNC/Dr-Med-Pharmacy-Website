@extends('frontend.layouts.app')
@if (isset($category_id))
    @php
        $category = \App\Models\Category::find($category_id);
        $meta_title = $category ? $category->meta_title : '';
        $meta_description = $category ? $category->meta_description : '';
    @endphp
@elseif (isset($brand_id))
    @php
        $brand = \App\Models\Brand::find($brand_id);
        $meta_title = $brand ? $brand->meta_title : '';
        $meta_description = $brand ? $brand->meta_description : '';
    @endphp
@elseif (isset($life_id))
    @php
        $life = \App\Models\Life::find($life_id);
        $meta_title = $life ? $life->meta_title : '';
        $meta_description = $life ? $life->meta_description : '';
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif


@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $meta_title }}">
<meta itemprop="description" content="{{ $meta_description }}">
<!-- Twitter Card data -->
<meta name="twitter:title" content="{{ $meta_title }}">
<meta name="twitter:description" content="{{ $meta_description }}">
<!-- Open Graph data -->
<meta property="og:title" content="{{ $meta_title }}" />
<meta property="og:description" content="{{ $meta_description }}" />
@endsection
<style>
   .listing-types {
   display: flex;
   flex-wrap: wrap;
   margin: auto;
   align-items: center;
   justify-content: center;
   row-gap: 15px;
   }
   .listing-types li{
   list-style:none;
   }
   .listing-types li a {
   padding: 1.1rem 1.9rem;
   border: 1px solid #ccc;
   }
   .navactive{
   border: 2px solid #336699;
   border-radius: 0.3rem;
   background: #262626;
   color: white !important;
   }
   .toggle-btn{
   width: 100%;
   display: flex !important;
   align-items: center;
   justify-content: flex-end;
   }
   .aiz-filter-sidebar .mobile-menu li a{
   color:#333!important;
   font-size:13px;
   }
   .aiz-filter-sidebar .mobile-menu.categories-select .navactive{
   color:white!important;
   }
   @media(max-width:800px){
   .sortbrand{
   position:initial !important;
   justify-content:space-between;
   }
   .sortbrand .sort-by{
   flex-direction:column;
   }
   .sort-by.ml-auto {
   margin-left:initial !important;
   }
   .sortbrand .sort-by:first-child{
   display:block!important;
   max-width:150px;
   }
   .sortbrand .sort-by label{
   margin-left:0;
   }
   .listing-types li a{
   font-size:11px!important;
   padding:8px 15px;
   }
   .listing-types{
   row-gap:5px;
   }
   }
   .mobile-menu li  .navactive a{
   color: white !important;
   }
   .mobile-menu li  .navactive{
   color: white !important;
   }
   @media(min-width:600px){
   .mobile-menu li{
   border-bottom: 1px solid #dbdbdb  !important;
   }
   .noborder li{
   border-bottom: none !important;
   }
   .mobile-menu .show .show{
   display:block;
   }
   .toggle-btn::before {
   font-size: 12px !important;
   }
   }
   .mobile-menu a.empty-ul-list .toggle-btn {
   display: none !important;
   }
</style>
@section('content')
<section class="mb-4 ps-categogy">
   <div class="container sm-px-0">


        <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item">
                     <a class="" href="{{ route('home') }}">{{ translate('Home')}}</a>
                  </li>
                  @if(isset($category_id))
                  <li class="ps-breadcrumb__item">
                     <a class="" href="{{ route('search') }}">{{ translate('All Categories')}}</a>
                  </li>
                  @elseif(isset($life_id))
                  <li class="ps-breadcrumb__item">
                     <a class="" href="#">{{ translate('Browse By Category')}}</a>
                  </li>
                  @else
                  <li class="ps-breadcrumb__item">
                     <a class="" href="{{ route('search') }}">{{ translate('All Categories')}}</a>
                  </li>
                  @endif
                @if (isset($brand_id))
    @php
        $brand = \App\Models\Brand::find($brand_id);
    @endphp
    @if ($brand)
        <li class="ps-breadcrumb__item">
            <a class="text-capitalize" href="#">{{ $brand->name }}</a>
        </li>
    @endif
@endif

                  @if(isset($category_id))
                  @php
                  $category = \App\Models\Category::find($category_id);
                  $parentCategory = $category->parent; // Fetch parent category
                  @endphp
                  @if($parentCategory)
                  <li class="ps-breadcrumb__item">
                     <a class="" href="{{ route('products.category', $parentCategory->slug) }}">
                     {{ $parentCategory->name }}
                     </a>
                  </li>
                  @endif
                  <li class="ps-breadcrumb__item">
                     <a class="" href="{{ route('products.category', $category->slug) }}">
                     {{ $category->name }}
                     </a>
                  </li>
                  @endif
               </ul>
            </ul>

{{-- If $products is a Builder/Paginator for the grid --}}
@php
    $productCount = method_exists($products, 'total') ? $products->total() : $products->count();
    $firstCategory = optional($products->first())->category;
@endphp

<h1 class="ps-categogy__name">
 @if (isset($life_id))
    @php
        $brand = \App\Models\Life::find($life_id);
    @endphp
    @if ($brand)
        {{ $brand->name }}
    @endif

@elseif (isset($category))
    {{ $category->name }}

@else
@endif

    <sup>{{ $productCount }} {{ \Illuminate\Support\Str::plural('product', $productCount) }}</sup>
</h1>






      <form style="padding-top: 20px;" class="" id="search-form" action="" method="GET">
         <div class="row">
            <div class="col-xl-3">
               <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                  <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                  <div class="collapse-sidebar c-scrollbar-light text-left">
                     <div class="d-flex d-lg-none justify-content-between align-items-center pl-3 border-bottom">
                        <h3 class="mb-0 fw-600">{{ translate('Filters') }}</h3>
                        <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" >
                        <i class="las la-times la-2x"></i>
                        </button>
                     </div>
                     <div class="bg-white shadow-sm rounded mb-3">
                        <div class=" fw-600 p-3 border-bottom">
                           {{ translate('Categories')}}
                        </div>
                        <div class="tab-pane active" id="categories">
                           <ul class="mobile-menu categories-select">
                              @foreach (\App\Models\Category::where('level', 0)->when(isset($facet_categories), fn ($q) => $q->whereIn('id', $facet_categories))->get() as $category)
                              <li>
                                 <a href="@if(Route::currentRouteName() === 'products.brand') {{ request()->fullUrlWithQuery(['category' => $category->slug]) }}  @else {{route('products.category',$category->slug)}} @endif"
                                    class="{{ isset($category_id) && $category_id == $category->id ? 'navactive' : '' }} @if(isset($facet_categories) && !array_intersect($category->children->pluck('id')->toArray(), $facet_categories)) empty-ul-list @endif"
                                    onclick="toggleAccordion(this)">
                                 {{ $category->name }}
                                 </a>
                                 @if ($category->children->isNotEmpty())
                                 <ul class="noborder {{ isset($category_id) && in_array($category_id, $category->children->pluck('id')->toArray()) ? 'open show' : '' }}">
                                    <!--      <li>-->
                                    <!--          <a class="mt-2" style="    background: #172f47;-->
                                    <!--width: fit-content;-->
                                    <!--padding: 5px 10px;-->
                                    <!--color: white !important;-->
                                    <!--border-radius: 999px;-->
                                    <!--font-size: 10px;" href="{{route('products.category',$category->slug)}}">View All <i class="fas fa-layer-group"></i></a>-->
                                    <!--      </li>-->
                                    <li>
                                       <a class="mt-2" style="width: 100%;
                                          padding: 10px 22px;
                                          font-size: 14px;
                                          display: flex
                                          ;
                                          justify-content: space-between;
                                          border-radius: 10px;" href="{{route('products.category',$category->slug)}}">View All <i class="fas fa-layer-group"></i></a>
                                    </li>
                                    @foreach ($category->children as $child)
                                    @if(!isset($facet_categories) || in_array($child->id, $facet_categories))
                                    <li class="{{ isset($category_id) && $category_id == $child->id ? 'navactive' : '' }}">
                                       <a href="@if(Route::currentRouteName() === 'products.brand') {{ request()->fullUrlWithQuery(['category' => $child->slug]) }}  @else {{route('products.category',$child->slug)}} @endif" onclick="toggleAccordion(this)">
                                       {{ $child->name }}
                                       </a>
                                       @if ($child->children->isNotEmpty())
                                       <ul class="{{ isset($category_id) && in_array($category_id, $child->children->pluck('id')->toArray()) ? 'show' : '' }}">
                                          @foreach ($child->children as $subChild)
                                          <li class="{{ isset($category_id) && $category_id == $subChild->id ? 'navactive' : '' }}">
                                             <a href="@if(Route::currentRouteName() === 'products.brand') {{ request()->fullUrlWithQuery(['category' => $subChild->slug]) }}  @else {{route('products.category',$subChild->slug)}} @endif">
                                             {{ $subChild->name }}
                                             </a>
                                          </li>
                                          @endforeach
                                       </ul>
                                       @endif
                                    </li>
                                    @endif
                                    @endforeach
                                 </ul>
                                 @endif
                              </li>
                              @endforeach
                           </ul>
                        </div>
                        <div class="p-3 d-none">
                           <ul class="list-unstyled">
                              @if (!isset($category_id))
                              @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                              <li class="mb-2 ml-2">
                                 <a class="text-reset fs-22 {{ request()->route('category') == $category->slug ? 'font-weight-bold' : '' }}"
                                    href="{{ route('products.category', $category->slug) }}">
                                 {{ $category->name }}
                                 </a>
                              </li>
                              @endforeach
                              @else
                              @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                              <li class="mb-2 ml-2">
                                 <a class="text-reset fs-22 {{ $category_id == $category->id ? 'font-weight-bold' : '' }}"
                                    href="{{ route('products.category', $category->slug) }}">
                                 {{ $category->name }}
                                 </a>
                              </li>
                              @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category_id) as $key => $id)
                              <li class="ml-4 mb-2">
                                 <a class="text-reset fs-22 {{ $id == $category_id ? 'font-weight-bold' : '' }}"
                                    href="{{ route('products.category', \App\Models\Category::find($id)->slug) }}">
                                 {{ \App\Models\Category::find($id)->name }}
                                 </a>
                              </li>
                              @endforeach
                              @endforeach
                              @endif
                           </ul>
                        </div>
                     </div>
                     <div class="bg-white shadow-sm rounded mb-3">
                        <div class="fw-600 p-3 border-bottom">
                           {{ translate('Price range')}}
                        </div>
                        <div class="p-3">
                           @php
                              $priceRangeMin = $priceRangeMin ?? 0;
                              $priceRangeMax = $priceRangeMax ?? 0;
                           @endphp
                           <div class="aiz-range-slider">
                              <div
                                 id="input-slider-range"
                                 data-range-value-min="{{ $priceRangeMin }}"
                                 data-range-value-max="{{ $priceRangeMax }}"
                              ></div>
                              <div class="row mt-2">
                                 <div class="col-6">
                                    <span class="range-slider-value value-low fs-14 text-red"
                                       @if (isset($min_price))
                                          data-range-value-low="{{ $min_price }}"
                                       @elseif($priceRangeMin > 0)
                                          data-range-value-low="{{ $priceRangeMin }}"
                                       @else
                                          data-range-value-low="0"
                                       @endif
                                       id="input-slider-range-value-low"
                                    ></span>
                                 </div>

                                 <div class="col-6 text-right">
                                    <span class="range-slider-value value-high fs-14 text-red"
                                       @if (isset($max_price))
                                          data-range-value-high="{{ $max_price }}"
                                       @elseif($priceRangeMax > 0)
                                          data-range-value-high="{{ $priceRangeMax }}"
                                       @else
                                          data-range-value-high="0"
                                       @endif
                                       id="input-slider-range-value-high"
                                    ></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @if (get_setting('color_filter_activation'))
                     <div class="bg-white shadow-sm rounded mb-3 d-none">
                        <div class=" fw-600 p-3 border-bottom">
                           {{ translate('Filter by color')}}
                        </div>
                        <div class="p-3">
                           <div class="aiz-radio-inline">
                              @foreach ($colors as $key => $color)
                              <label class="aiz-megabox pl-0 mr-2" data-toggle="tooltip" data-title="{{ $color->name }}">
                              <input
                              type="radio"
                              name="color"
                              value="{{ $color->code }}"
                              onchange="filter()"
                              @if(isset($selected_color) && $selected_color == $color->code) checked @endif
                              >
                              <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                              <span class="size-30px d-inline-block rounded" style="background: {{ $color->code }};"></span>
                              </span>
                              </label>
                              @endforeach
                           </div>
                        </div>
                     </div>
                     @endif
                     {{-- <button type="submit" class="btn btn-styled btn-block btn-base-4">Apply filter</button> --}}
                  </div>
               </div>
            </div>
            <div class="col-xl-9" style="padding-left: 60px;">

               <div class="breadcrumb__text">
                 @if (isset($brand_id))
    @php
        $brand = \App\Models\Brand::find($brand_id);
    @endphp
    @if ($brand)
        <h2 class="h6 fw-600 brand">
            {{ $brand->name }}
        </h2>
    @endif
@endif

                  @if(isset($category_id))
                  @php
                  $category = \App\Models\Category::find($category_id);
                  $parentCategory = $category->parent; // Fetch parent category
                  @endphp
                  <div>



                  </div>
                  @elseif(isset($query))
                  {{ translate('Search result for ') }}"{{ $query }}
                  @elseif (Route::currentRouteName() == 'products.brand')
                  @else
                  @endif
                  <input type="hidden" name="keyword" value="{{ $query }}">
               </div>
               <div class="text-left position-relative">
                  <div class="sortbrand d-none breadcrumb-filter-mobile" style="    position: absolute;
                     top: 0;
                     right: 0;margin-top:-50px;" class="d-flex align-items-center ">
                      @if (Route::currentRouteName() != 'products.brand')
                     <div class="d-flex form-group ml-auto mr-3 w-200px  d-xl-block sort-by">

                        <label class="mb-0">{{ translate('Brands : ')}}</label>
                        <select class="form-control form-control-sm aiz-selectpicker" data-live-search="true" name="brand" onchange="filter()">
                           <option value="">{{ translate('All  Brands')}}</option>
                           @foreach (\App\Models\Brand::all() as $brand)
                           <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->name }}</option>
                           @endforeach
                        </select>

                     </div>
                     @endif
                     <div  class="d-flex form-group ml-0 ml-xl-3 sort-by">
                        <label class="mb-0">{{ translate('Sort by : ')}}</label>
                        <select class="form-control form-control-sm aiz-selectpicker" name="sort_by" onchange="filter()">
                        <option value="newest" @isset($sort_by) @if ($sort_by == 'newest') selected @endif @endisset>{{ translate('Newest')}}</option>
                        <option value="oldest" @isset($sort_by) @if ($sort_by == 'oldest') selected @endif @endisset>{{ translate('Oldest')}}</option>
                        <option value="price-asc" @isset($sort_by) @if ($sort_by == 'price-asc') selected @endif @endisset>{{ translate('Price low to high')}}</option>
                        <option value="price-desc" @isset($sort_by) @if ($sort_by == 'price-desc') selected @endif @endisset>{{ translate('Price high to low')}}</option>
                        </select>
                     </div>
                     <div class="d-xl-none ml-auto ml-xl-3 mr-0 form-group align-self-end filterall">
                        <button style="    border: none;" type="button" class="btn btn-icon p-0 fw-500" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                        <i class="la la-filter la-2x"></i>
                        Filter
                        </button>
                     </div>
                  </div>
               </div>
               <input type="hidden" name="min_price" value="">
               <input type="hidden" name="max_price" value="">
               @if(isset($category_id) || isset($brand_id))
               <div class="listing-types mt-3 mb-3 d-none">
                  @foreach (\App\Models\Category::where('level', 0)->get() as $category)
                  <li class="mb-2 ml-2">
                     <a class=" fs-22 {{ $category_id == $category->id ? 'navactive' : '' }}"
                        href="@if(Route::currentRouteName() === 'products.brand') {{ request()->fullUrlWithQuery(['category' => $category->slug]) }}  @else {{route('products.category',$category->slug)}} @endif">
                     {{ $category->name }}
                     </a>
                  </li>
                  @endforeach
               </div>
               @else
               @endif
               <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-4 row-cols-lg-4 row-cols-md-4 row-cols-2 mt-3 listingproducts" >
                @forelse ($products as $key => $product)
    <div class="col mb-20">
        @include('frontend.partials.product_box_1', ['product' => $product])
    </div>
@empty
    <div class="col-12 text-center">

        <img style="    width: 100px;" src="https://img.freepik.com/premium-vector/vector-illustration-about-concept-no-items-found-no-results-found_675567-6665.jpg"/>

        <p>No Products Available</p>

    </div>
@endforelse

               </div>
               <div class="aiz-pagination aiz-pagination-center mt-4">
                  {{ $products->appends(request()->input())->links() }}
               </div>
            </div>
         </div>
      </form>
   </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
   function filter(){
       $('#search-form').submit();
   }
   function rangefilter(arg){
       $('input[name=min_price]').val(arg[0]);
       $('input[name=max_price]').val(arg[1]);
       filter();
   }
</script>
<script>
   function toggleAccordion(element) {
       // Find the parent <li> element
       const parentLi = element.closest('li');

       // Toggle the 'show' class on the parent <li>
       parentLi.classList.toggle('show');

       // Close other accordion items (if required)
       const allOtherItems = document.querySelectorAll('.noborder > li');
       allOtherItems.forEach(item => {
           if (item !== parentLi) {
               item.classList.remove('show');
           }
       });
   }

   document.addEventListener("DOMContentLoaded", function() {
       // Find all parent <li> elements that have subcategories (<ul>)
       const parentItems = document.querySelectorAll('li > a');

       parentItems.forEach(parent => {
           const parentLi = parent.closest('li');  // Find the parent <li>
           const subcategories = parentLi.querySelector('ul'); // Find the subcategories <ul>

           if (subcategories && subcategories.classList.contains('show')) {
               // If the subcategory <ul> is visible (has 'show' class), open the parent <li>
               parentLi.classList.add('show');
           }
       });
   });





</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    const lowEl = document.getElementById("input-slider-range-value-low");
    const highEl = document.getElementById("input-slider-range-value-high");

    function updatePeso(el, attr) {
        let value = el.getAttribute(attr) || 0;
        el.textContent = "₱" + value;
    }

    // Initial render
    updatePeso(lowEl, "data-range-value-low");
    updatePeso(highEl, "data-range-value-high");

    // Watch for changes dynamically
    const observerLow = new MutationObserver(() => updatePeso(lowEl, "data-range-value-low"));
    const observerHigh = new MutationObserver(() => updatePeso(highEl, "data-range-value-high"));

    observerLow.observe(lowEl, { attributes: true, attributeFilter: ["data-range-value-low"] });
    observerHigh.observe(highEl, { attributes: true, attributeFilter: ["data-range-value-high"] });
});

</script>
@endsection
