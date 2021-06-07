@extends('layouts.admin')
@section('title','پنل مدیریت تیم')

@section('content')
  {{-- Header --}}
  <x-header pageName="تیم" buttonValue="افزودن عضو">
    <x-slot name="table">
      <x-table :table="$teamTable" />
    </x-slot>
  </x-header>

  {{-- Insertion --}}
  <x-admin.insert size="modal-l" formId="teamForm">
    <x-slot name="content">
      <div class="row">
        {{-- Name --}}
        <x-input key="name" placeholder="نام" 
          class="col-md-12 mb-3" />
        {{-- Responsibility --}}
        <x-input key="responsibility" placeholder="مسؤلیت" 
          class="col-md-12 mb-3" />
        {{-- Linkedin address --}}
        <x-input key="linkedin" placeholder="آدرس لینکدین" 
          class="col-md-12 mb-3"/>
        {{-- Image --}}
        <div class="col-md-12 mb-3">
          <label for="image">عکس:</label>
          <br>
          <input type="file" name="image" />
        </div>
        {{-- Size --}}
        <x-input key="size" placeholder="اندازه" class="col-md-12" />
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete --}}
  <x-admin.delete title="عضو تیم" />
  
@endsection

@section('scripts')
@parent
  <!-- DataTable data -->
  {!! $teamTable->scripts() !!}
  <script>

    $(document).ready(function () {
      // Admin DataTable And Action Object
      let dt = window.LaravelDataTables['teamTable'];
      let action = new RequestHandler(dt,'#teamForm','team');

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
      function edit($url) {
        // Edit
        action.edit();

        $.ajax({
          url: "{{ url('team/edit') }}",
          method: "get",
          data: {id: $url},
          success: function(data) {
            action.editData($url);
            $('#name').val(data.name);
            $('#responsibility').val(data.responsibility);
            $('#linkedin').val(data.linkedin_address);
            $('#size').val(data.size);
          }
        })
      }
    });
  </script>
@endsection
