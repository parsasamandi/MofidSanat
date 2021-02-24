@extends('layouts.admin')
@section('title','لیست تصاویر')

@section('content')

  {{-- Header --}}
  <x-header pageName="عکس" buttonValue="افزودن عکس">  
    <x-slot name="table">
      {!! $imageTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="imageForm">
    <x-slot name="content">
      <div class="row rtl">
        {{-- Product --}}
        <div class="col-md-6">
          <label for="products">انتخاب محصول مرتبط:</label>
          <select name="products[]" id="products" class="browser-default custom-select">
            @foreach($products as $product)
              <option value="{{ $product->id }}" multiple>{{ $product->name }}</option>
            @endforeach
          </select>
        </div>
        {{-- Image --}}
        <div class="col-md-6 mt-2">
          <label for="image">تصویر:</label>
          <br>
          <input name="image" type="file" required/>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف تصویر هستید؟"/>

@endsection

@section('scripts')
  @parent
  {{-- Image DataTable --}}
  {!! $imageTable->scripts() !!}

  <script>
    $(document).ready(function () {

      // ----------------------- Filepond  -----------------------
      // const inputElement = document.querySelector('input[type="file"]');
      // const pond = FilePond.create( inputElement, {
      //   maxFiles: 10,
      //   instantUpload: false,
      //   allowReplace: true,
      //   allowDrop: true,
      // });

      // Product Select2
      $('#products').select2({width:'100%'});

      // Image DataTable
      let dt = window.LaravelDataTables['imageTable'];
      let action = new requestHandler(dt,'#imageForm','image');

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
      window.showEditModal = function showEditModal(url) {
        edit(url);
      }

      function edit($url) {
        $('#form_output').html('');
        $('#formModal').modal('show');

        $.ajax({
          url: "{{ url('image/edit') }}",
          method: "get",
          data: {id: $url},
          success: function(data) {
            $('#id').val($url);
            $('#button_action').val('update');
            $('#products').val(data.product_id).trigger('change');
          }
        })
      }
    });
  </script>
@endsection
