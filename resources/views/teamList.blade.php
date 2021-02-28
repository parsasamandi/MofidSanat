@extends('layouts.admin')
@section('title','پنل مدیریت تیم')

@section('content')
  {{-- Header --}}
  <x-header pageName="تیم" buttonValue="افزودن عضو">
    <x-slot name="table">
      {!! $teamTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center'], false)!!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="teamForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.team')
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل به حذف عضو تیم هستید؟" />

@endsection

@section('scripts')
@parent
  <!-- DataTable data -->
  {!! $teamTable->scripts() !!}
  <script>

    $(document).ready(function () {
      // Admin DataTable And Action Object
      let dt = window.LaravelDataTables['teamTable'];
      let action = new requestHandler(dt,'#teamForm','team');

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
        $('#formModal').modal('show');
        $('#form_output').html('');

        $.ajax({
          url: "{{ url('team/edit') }}",
          method: "get",
          data: {id: $url},
          success: function(data) {
            $('#id').val($url);
            $('#action').val('ویرایش');
            $('#button_action').val('update');
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
