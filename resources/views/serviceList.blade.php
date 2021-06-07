@extends('layouts.admin')
@section('title','پنل مدیریت خدمات')

@section('content')
  {{-- Header --}}
  <x-header pageName="خدمات" buttonValue="سرویس">
    <x-slot name="table">
      <x-table :table="$serviceTable" />
    </x-slot>
  </x-header>

  {{-- Insertion --}}
  <x-admin.insert size="modal-l" formId="serviceForm">
    <x-slot name="content">
      <div class="row">
        {{-- Name --}}
        <x-input key="title" placeholder="تیتر" 
          class="col-md-12 mb-3" />
        {{-- Description --}}
        <x-input key="description" placeholder="توضیحات" 
          class="col-md-12 mb-3" />
        {{-- Fontawesome --}}
        <x-input key="font_awesome" placeholder="آیکن" 
          class="col-md-12" />
      </div>
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="سرویس" />
  
@endsection

@section('scripts')
@parent
  <!-- DataTable data -->
  {!! $serviceTable->scripts() !!}
  <script>

    $(document).ready(function () {
      // Service dataTable and action object
      let dt = window.LaravelDataTables['serviceTable'];
      let action = new RequestHandler(dt,'#serviceForm','service');

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

        action.edit();

        $.ajax({
          url: "{{ url('service/edit') }}",
          method: "get",
          data: {id: $url},
          success: function(data) {
            action.editData($url);
            $('#title').val(data.title);
            $('#description').val(data.description);
            $('#font_awesome').val(data.font_awesome);
          }
        })
      }
    });
  </script>
@endsection
