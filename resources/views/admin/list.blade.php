@extends('layouts.admin')
@section('title','پنل مدیریت ادمین ها')

@section('content')
  {{-- Header --}}
  <x-header pageName="ادمین" buttonValue="افزودن ادمین">
    <x-slot name="table">
      <x-table :table="$adminTable" />
    </x-slot>
  </x-header>

  {{-- Insertion --}}
  <x-admin.insert size="modal-l" formId="adminForm">
    <x-slot name="content">
      {{-- Form --}}
      <div class="row">
        {{-- Name --}}
        <x-input key="name" placeholder="نام"
          class="col-md-12 mb-3" />
        {{-- Email --}}
        <x-input key="email" placeholder="ایمیل"  
          class="col-md-12 mb-3"/>
        {{-- Passwords --}}
        <div class="col-md-12 mb-3">
          <label for="password">رمز جدید:</label>
          <input type="password" name="password" id="password" class="form-control" 
            placeholder="رمز جدید" autocomplete="new-password">
        </div>
        <div class="col-md-12">
          <label for="password-confirm">تکرار رمز جدید:</label>
          <input type="password" name="password-confirm" id="password-confirm" class="form-control"  
            placeholder="تکرار رمز جدید" autocomplete="new-password">
        </div>
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete  --}}
  <x-admin.delete title="ادمین"/>
@endsection

@section('scripts')
  @parent
  
  {{-- Admin Table --}}
  {!! $adminTable->scripts() !!}

  <script>
    $(document).ready(function () {
      // Admin datatable and action object
      let dt = window.LaravelDataTables['adminTable'];
      let action = new RequestHandler(dt,'#adminForm','admin');

      // Record modal
      $('#create_record').click(function () {
        action.modal();
      });
      // Insert
      action.insert();

      // Delete
      window.showConfirmationModal = function showConfirmationModal(id) {
        action.delete(id);
      }
      // Edit
      window.showEditModal = function showEditModal(id) {
        edit(id);
      }
      function edit($id) {
        // Edit
        action.edit();

        $.ajax({
          url: "{{ url('admin/edit') }}",
          method: "get",
          data: {id: $id},
          success: function(data) {
            action.editData($id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#password').val('new_password');
            $('#password-confirm').val('new_password');
          }
        })
      }
    });
  </script>
@endsection
