@extends('layouts.admin')
@section('title','لیست محصولات')


@section('content')
   {{-- Header --}}
  <x-header pageName="محصولات" buttonValue="محصول">
    <x-slot name="table">
      {!! $productTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>


  {{-- Insert Modal --}}
  <x-admin.insert size="modal-xl" formId="productForm">
    <x-slot name="content">
      <div class="row">
        {{-- Name --}}
        <div class="col-md-6 mb-3">
          <label for="name">نام:</label>
          <input id="name" name="name" type="text" placeholder="نام">
        </div>
        {{-- Model --}}
        <div class="col-md-6 mb-3 ltr">
          <label for="modal">:مدل</label>
          <input id="model" name="model" type="text" placeholder="مدل">
        </div>
        {{-- Price --}}
        <div class="col-md-4 mb-3 ltr">
          <label for="price">:هزینه</label>
          <input id="price" name="price" type="text" placeholder="هزینه">
        </div>
        {{-- Size --}}
        <div class="col-md-4 mb-3">
          <label for="size">اندازه:</label>
          <input id="size" name="size" type="text" placeholder="اندازه(بین ۱ تا ۱۲ انتخاب کنید)">
        </div>
        {{-- Status --}}
        <div class="col-md-4 mb-3">
          <label for="status">وضعیت:</label>
          <select id="status" name="status" class="browser-default custom-select">
            <option value="0">فعال</option>
            <option value="1">غیرفعال</option>
          </select>
        </div> 
        {{-- Category --}}
        <div class="col-md-6 mb-3">
          <label for="category_select">دسته بندی اول:</label>
          <select class="browser-default custom-select" name="categories" id="categories">
            <option value="">دسته بندی اول</option>
            @foreach($cats as $cat)
              <option value="{{ $cat->id }}" required> {{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Sub Category --}}
        <div class="col-md-6 mb-3 ltr">
          <label for="subCategory">دسته بندی دوم:</label>
          <select class="browser-default custom-select" name="subCategories" id="subCategories">
            <option value="">دسته بندی دوم</option>
            @foreach($subCats as $subCat)
              <option value="{{ $subCat->id }}"> {{ $subCat->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="description">توضیحات:</label>
          <textarea id="description" name="description" type="text" rows="6" Placeholder="توضیحات" class="form-control"></textarea>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل هستید محصول خود را حذف کنید؟" />

  {{-- Images And Videos --}}
  <div class="col-md-12 mt-3">
    <x-alert type="warning" message="لطفا عکس و ویدئو را در قسمت مربوطه و مشخص، وارد نمایید" />
  </div>

@endsection

@section('scripts')
@parent

  {!! $productTable->scripts() !!}

  <script>
    $(document).ready(function () {

      // Select2
      $('#category_select').select2({ width: '100%'});
      $('#subCategory').select2({ width: '100%'});

      // Product DataTable And Action Object
      let dt = window.LaravelDataTables['productTable'];
      let action = new requestHandler(dt,'#productForm','product');

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
        $('#formModal').modal('show');
        $('#form_output').html('');

        $.ajax({
          url: "{{ url('product/edit') }}",
          method: 'get',
          data: { id: $url },
          dataType: 'json',
          success: function (data) { 
            $('#id').val($url);
            $('#button_action').val('update');
            $('#action').val('ویرایش'); 
            $('#name').val(data.name);
            $('#model').val(data.model);
            $('#description').val(data.desc);
            $('#price').val(data.price);
            $('#size').val(data.size);
            $('#status').val(data.status).trigger('change');
            $('#category_select').val(data.c_id).trigger('change');
            $('#subCategory').val(data.sc_id).trigger('change');
          }
        })
      }
      // Ajax Category Based on Sub Category
      $('#categories').on('change', function (e) {
        var c_id = e.target.value;
        $.get('/subCategory?c_id=' + c_id, function (data) {
          $('#subCategories').empty();
          $("#subCategories").append('<option value="">دسته بندی دوم</option>');
          $.each(data, function (index, subCat) {
            $("#subCategories").append('<option value="' + subCat.id + '">' + subCat.name + '</option>');
          })
        })
      })
    });
  </script>
@endsection

