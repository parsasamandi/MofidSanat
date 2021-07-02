@extends('layouts.admin')
@section('title','لیست تصاویر')

@section('content')

  {{-- Header --}}
  <x-header pageName="عکس" buttonValue="عکس">  
    <x-slot name="table">
      <x-table :table="$imageTable" />
    </x-slot>
  </x-header>

  {{-- Insertion --}}
  <x-admin.insert size="modal-lg" formId="imageForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.image')
    </x-slot>
  </x-admin.insert>

  {{-- Delete --}}
  <x-admin.delete title="تصویر"/>

@endsection

@section('scripts')
  @parent
  {{-- Image DataTable --}}
  {!! $imageTable->scripts() !!}

  <script>
    // Get media after selecting the picture
    document.getElementById("image").onchange = function () {
      var reader = new FileReader();
      reader.onload = function (e) {
        // get the loaded data and render thumbnail.
        var img = document.getElementById("picture");
        img.src = e.target.result;
        // Hidden input
        document.getElementById("hidden_image").value = e.target.result;
      };
      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    };

    $(document).ready(function () {
      // ----------------------- Filepond  -----------------------
      // const inputElement = document.querySelector('input[type="file"]');
      // const pond = FilePond.create( inputElement, {
      //   maxFiles: 10,
      //   instantUpload: false,
      //   allowReplace: true,
      //   allowDrop: true,
      // });

      // Image Datatable
      let dt = window.LaravelDataTables['imageTable'];
      let action = new RequestHandler(dt,'#imageForm','image');

      // Record modal
      $('#create_record').click(function () {
        // Select 2
        $('#products').val('').trigger('change');
        // Picture
        $("#picture").attr("src", "");
        $("#picture").attr("alt", "عکس خود را وارد نمایید");
        // Hidden image
        $('#hidden_image').val(null);
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
        action.edit();

        $.ajax({
          url: "{{ url('image/edit') }}",
          method: "get",
          data: {id: $url},
          success: function(data) {
            action.editData($url);
            $('#products').val(data.product_id).trigger('change');
          }
        })
      }
    });
  </script>
@endsection
