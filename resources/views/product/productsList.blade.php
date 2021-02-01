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
          <input id="name" name="name" type="text" class="form-control" placeholder="نام">
        </div>
        {{-- Model --}}
        <div class="col-md-6 mb-3 ltr">
          <label for="modal">:مدل</label>
          <input id="model" name="model" type="text" class="form-control" placeholder="مدل">
        </div>
        {{-- Price --}}
        <div class="col-md-4 mb-3 ltr">
          <label for="price">:هزینه</label>
          <input id="price" name="price" type="text" class="form-control" placeholder="هزینه">
        </div>
        {{-- Size --}}
        <div class="col-md-4 mb-3">
          <label for="size">اندازه:</label>
          <input id="size" name="size" type="text"
              class="form-control" placeholder="اندازه(بین ۱ تا ۱۲ انتخاب کنید)">
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
          <label for="category_select">دسته بندی سطح-۱:</label>
          <select class="browser-default custom-select" name="category_select" id="category_select">
            <option value="">دسته بندی سطح-۱</option>
            @foreach($cats as $cat)
              <option value="{{ $cat->id }}" required> {{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Sub Category --}}
        <div class="col-md-6 mb-3 ltr">
          <label for="subCategory">:دسته بندی سطح-۲</label>
          <select class="browser-default custom-select" name="subCategory" id="subCategory">
            <option value="">دسته بندی سطح-۲</option>
            @foreach($subCats as $subCat)
              <option value="{{ $subCat->id }}"> {{ $subCat->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="description">توضیحات:</label>
          <textarea Placeholder="توضیحات" rows="6" id="description" name="description" type="text" class="form-control"></textarea>
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
    document.getElementsByTagName("tr")[0].setAttribute("role", "row");
    
    $(document).ready(function () {
      // Product Table
      let dt = window.LaravelDataTables['productTable'];

      // Select2
      $('#category_select').select2({ width: '100%'});
      $('#subCategory').select2({ width: '100%'});

      // Record modal
      $('#create_record').click(function () {
        $('#formModal').modal('show');
        $('#productForm')[0].reset();
        $('#form_output').html('');
      });

      // Store
      $('#productForm').on('submit', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
          url: "{{ route('product.store') }}",
          method: "POST",
          data: form_data,
          processing: true,
          dataType: "json",
          success: function (data) { 
            $('#form_output').html(data.success);
            $('#productForm')[0].reset();
            $('#button_action').val('insert');
            dt.draw(false);
          },
          error: function(data) {
            // Parse To Json
            var data = JSON.parse(data.responseText);
            // Error
            error_html = '';
            for(var all in data.errors) {
              error_html += '<div class="alert alert-danger">' + data.errors[all] + '</div>';
            }
            $('#form_output').html(error_html);
          }
        })
      });
      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        deleteProduct(url);
      }
      function deleteProduct($url) {
        var id = $url;
        $('#confirmModal').modal('show'); 
        $('#ok_button').click(function () {
          $.ajax({
            url: "/product/delete/" + id,
            mehtod: "get",
            success: function (data) {
              $('#confirmModal').modal('hide');
              dt.draw(false);
            }
          })
        }) 
      }
      // Edit
      window.showEditModal = function showEditModal(url) {
        editProduct(url);
      }
      function editProduct($url) {
        var id = $url;
        $('#formModal').modal('show');
        $('#form_output').html('');
        $.ajax({
          url: "{{ route('product.edit') }}",
          method: 'get',
          data: { id: id },
          dataType: 'json',
          success: function (data) { 
            $('#id').val(id); 
            $('#name').val(data.name);
            $('#model').val(data.model);
            $('#description').val(data.desc);
            $('#price').val(data.price);
            $('#size').val(data.size);
            if(data.status == 0) 
              $('#status').val(0).trigger('change');
            else if(data.status == 1) 
              $('#status').val(1).trigger('change');
            $('#category_select').val(data.c_id).trigger('change');
            $('#subCategory').val(data.sc_id).trigger('change');
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#action').show();
          }
        })
      }
      // Ajax/ Category Based on Sub Category
      $('#category_select').on('change', function (e) {
        console.log(e.target.value);
        var c_id = e.target.value;
        $.get('/ajax-subcat?c_id=' + c_id, function (data) {
          $('#subCategory').empty();
          $("#subCategory").append('<option value="">دسته بندی سطح-۲</option>');
          $.each(data, function (index, subCat) {
            $("#subCategory").append('<option value="' + subCat.id + '">' + subCat.name + '</option>');
          });
        });
      });
    });
  </script>
@endsection

