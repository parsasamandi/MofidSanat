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
      let action = new Action('','','');
    });
  </script>
@endsection
