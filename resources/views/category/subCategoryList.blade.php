@extends('layouts.admin')
@section('title','لیست دسته بندی دوم')

@section('content')
  {{-- Header --}}
  <x-header pageName="دسته بندی ۲" buttonValue="دسته بندی دوم">
    <x-slot name="table">
      {!! $subCategoryTable->table(['class' => 'table table-bordered table-striped w-100 nowrap text-center'], false) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="xs" formId="subCategoryForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.category')
      {{-- Category --}}
      <div class="row">
        <div class="col-md-12 mt-3">
          <label for="categories">در دسته بندی اول:</label>
          <select class="custom-select" id="categories" name="categories">
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف دسته بندی دوم هستید؟" />

@endsection

@section('scripts')
@parent

  {!! $subCategoryTable->scripts() !!}

  <!-- DataTable data -->
  <script>
    $(document).ready(function () {

      // Category DataTable
      let dt = window.LaravelDataTables['subCategoryTable'];
      let action = new RequestHandler(dt,'#subCategoryForm','subCategory');

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
      function edit($url) {
        var id = $url;
        $('#formModal').modal('show');
        $('#form_output').html('');

        $.ajax({
          url: "{{ url('subCategory/edit') }}",
          method: "get",
          data: {id,id},
          dataType: "json",
          success: function(data) {
            $('#id').val(data.id);
            $('#button_action').val('update');
            $('#action').val('ویرایش');
            $('#name').val(data.name);
            $('#status').val(data.status).trigger('change');
            $('#category').val(data.c_id).trigger('change');
          }
        })
      }
    });
  </script>
@endsection


