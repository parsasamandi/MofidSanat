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
      // Image DataTable
      let dt = window.LaravelDataTables['imageTable'];
      // Product Select2
      $('#products').select2({tags: true, width: "100%"});

      // ----------------------- Filepond  -----------------------
      // const inputElement = document.querySelector('input[type="file"]');
      // const pond = FilePond.create( inputElement, {
      //   maxFiles: 10,
      //   instantUpload: false,
      //   allowReplace: true,
      //   allowDrop: true,
      // });

      // Record modal
      $('#create_record').click(function () {
        $('#formModal').modal('show');
        $('#imageForm')[0].reset();
        $('#form_output').html('');
      });
      // Insert
      $('#imageForm').on('submit', function (event) {
        event.preventDefault();
        var form_data = new FormData(this);
        form_data.append('file',form_data);
        $.ajax({
          url: "{{ route('image.store') }}",
          method: "POST",
          data: form_data,
          dataType: "json",
          contentType: false,
          processData: false,
          cache: false,
          success: function(data) {
            $('#form_output').html(data.success);
            $('#imageForm')[0].reset();
            dt.draw(false); 
          }
        })
      });
      // Edit
      window.showEditModal = function showEditModal(url) {
        editImage(url);
      }

      function editImage($url) {
        var id = $url;
        $('#form_output').html('');
        $('#formModal').modal('show');
        $.ajax({
          url: "{{ route('image.edit') }}",
          method: "get",
          data: {id: id},
          dataType: "json",
          success: function(data) {
            $('#id').val(id);
            $('#button_action').val('update');
            $('#products').val(data.product_id).trigger('change');
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
      }

      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        deleteImage(url);
      }

      function deleteImage($url) {
        var id = $url;
        $('#confirmModal').modal('show');
        $('#ok_button').click(function(data) {
          $.ajax({
            url: "/image/delete/" + id,
            method: "get",
            success: function(data) {
              $('#confirmModal').modal('hide');
              dt.draw(false);
            }
          })
        });
      }
    });
  </script>
@endsection
