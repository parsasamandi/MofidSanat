@extends('layouts.admin')
@section('title','پنل مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="ادمین" buttonValue="افزودن ادمین">
    <x-slot name="table">
      {!! $adminTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap text-center']) !!}
    </x-slot>
  </x-header>


  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="adminForm">
    <x-slot name="content">
      {{-- Name --}}
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="name">نام:</label>
          <input name="name" id="name" type="text" placeholder="نام">
        </div>
        {{-- Email --}}
        <div class="col-md-12 mb-3">
          <label for="email">ایمیل:</label>
          <input name="email" id="email" type="email" placeholder="ایمیل">
        </div>
        {{-- Passwords --}}
        <div class="col-md-12 mb-3">
          <label for="password">رمز جدید:</label>
          <input name="password" id="password" placeholder="رمز جدید">
        </div>
        <div class="col-md-12 mb-3">
          <label for="password2">تکرار رمز جدید:</label>
          <input name="password2" id="password2" placeholder="تکرار رمز جدید">
        </div>
      </div>
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
      // Admin DataTable
      let dt = window.LaravelDataTables['adminTable'];
      // Record modal
      $('#create_record').click(function () {
        $('#formModal').modal('show');
        $('#adminForm')[0].reset();
        $('#form_output').html('');
      });
      // Create a new one
      $('#adminForm').on('submit', function (event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
          url: "{{ route('admin.store') }}",
          method: "POST",
          data: form_data,
          processing: true,
          dataType: "json",
          success: function (data) { 
            $('#form_output').html(data.success);
            $('#adminForm')[0].reset();
            $('#button_action').val('insert');
            dt.draw(false);
          },
          error: function (data) {
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
        deleteAdmin(url);
      }
      function deleteAdmin($url) {
        var id = $url;
        $('#confirmModal').modal('show');
        $('#ok_button').click(function () {
          $.ajax({
            url: "/admin/delete/" + id,
            mathod: "get",
            dataType: "json",
            success: function(data) {
              $('#confirmModal').modal('hide');
              dt.draw(false);
            }
          })
        });
      }
      // Edit
      window.showEditModal = function showEditModal(url) {
        editAdmin(url);
      }
      function editAdmin($url) {
        var id = $url;
        $('#formModal').modal('show');
        $('#form_output').html('');

        $.ajax({
          url: "{{ route('admin.edit') }}",
          method: "get",
          data: {id: id},
          dataType: "json",
          success: function(data) {
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val('رمز عبور جدید');
            $('#password2').val('رمز عبور جدید');
            $('#id').val(id);
            $('#button_action').val('update');
            $('#action').val('ویرایش');
          }
        })
      }
    });
  </script>
@endsection
