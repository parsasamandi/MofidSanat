@extends('layouts.admin')
@section('title','پنل مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="ادمین" buttonValue="افزودن ادمین">
    <x-slot name="table">
      {!! $adminTable->table(['class' => 'table table-striped table-bordered w-100 nowrap text-center']) !!}
    </x-slot>
  </x-header>


  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="adminForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.admin')
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا از حذف ادمین مطمئن هستید؟"/>

@endsection


@section('scripts')
  @parent
  
  {{-- Admin Table --}}
  {!! $adminTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Admin DataTable And Action Object
      let dt = window.LaravelDataTables['adminTable'];
      let action = new RequestHandler(dt,'#adminForm','admin');

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
        // Edit
        action.edit();

        $.ajax({
          url: "{{ url('admin/edit') }}",
          method: "get",
          data: {id: $url},
          success: function(data) {
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val('newPassword');
            $('#password-confirm').val('newPassword');
          }
        })
      }
    });
  </script>
@endsection
