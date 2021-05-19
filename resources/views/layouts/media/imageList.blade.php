@extends('layouts.admin')
@section('title','لیست تصاویر')

@section('content')
  {{-- Header --}}
  <x-header pageName="عکس" buttonValue="افزودن عکس">  
    <x-slot name="table">
      {!! $imageTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-lg" formId="imageForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.image')
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
      let action = new RequestHandler(dt,'#imageForm','image');

      // Record modal
      $('#create_record').click(function () {
        $("#picture").attr("src", "");
        $("#picture").attr("alt", "عکس خود را وارد نمایید");
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
      function edit($url) {
        action.edit();

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
      // Get media after selecting the picture
      document.getElementById("image").onchange = function () {
        var reader = new FileReader();
        reader.onload = function (e) {
          // get loaded data and render thumbnail.
          var img = document.getElementById("picture");
          img.src = e.target.result;
          // Image input style
          document.getElementById("image").style.marginBottom = "10px"; 
          // Hidden input
          document.getElementById("hidden_image").value = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
      };
    });
  </script>
@endsection
