@extends('layouts.admin')
@section('title','لیست محصولات')

@section('content')

  {{-- Header --}}
  <x-header pageName="محصولات" buttonValue="محصول">
    <x-slot name="table">
      <x-table :table="$productTable" />
    </x-slot>
  </x-header>

  {{-- Insertion --}}
  <x-admin.insert size="modal-xl" formId="productForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.product')
    </x-slot>
  </x-admin.insert>

  {{-- Delete --}}
  <x-admin.delete title="محصولات" />

  {{-- Images and videos --}}
  <div class="col-md-12 mt-3">
    <x-alert type="warning" message="لطفا عکس و ویدئو را در قسمت مربوطه و مشخص، وارد نمایید" />
  </div>

@endsection

@section('scripts')
@parent

  {!! $productTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Product DataTable And Action Object
      let dt = window.LaravelDataTables['productTable'];
      let action = new RequestHandler(dt,'#productForm','product');

      // Record modal
      $('#create_record').click(function () {
        action.modal();
      });

      // Insert
      action.insert();

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        action.delete(url);
      }
      // Edit
      window.showEditModal = function showEditModal(url) {
        edit(url);
      }
      // Edit
      function edit($url) {
        action.edit();

        $.ajax({
          url: "{{ url('product/edit') }}",
          method: 'get',
          data: { id: $url },
          success: function (data) { 
            action.editData($url);
            $('#name').val(data.name);
            $('#model').val(data.model);
            $('#description').val(data.description);
            $('#price').val(data.price);
            $('#size').val(data.size);
            $('#status').val(data.statuses.status).trigger('change');
            $('#categories').val(data.category_id).trigger('change');
            $('#subcategories').val(data.subcategory_id).trigger('change');
          }
        })
      }
      // Ajax Category Based on Sub Category
      $('#categories').on('change', function (e) {
        var category_id = e.target.value;
        $.get('/subCategory?category_id=' + category_id, function (data) {
          $('#subCategories').empty();
          $("#subCategories").append('<option value="">دسته بندی دوم</option>');
          $.each(data, function (index, subcategory) {
            $("#subCategories").append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
          })
        })
      })
    });
  </script>
@endsection

