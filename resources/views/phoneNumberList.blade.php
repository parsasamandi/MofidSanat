@extends('layouts.admin')
@section('title','لیست شماره تلفن ها')

@section('content')

  {{-- Header --}}
  <x-header pageName="شماره تلفن" buttonValue="شماره تلفن">
    <x-slot name="table">
      {!! $phoneNumberTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap  text-center'], false) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="phoneForm">
    <x-slot name="content">
      {{-- Form --}}
      @include('includes.form.phoneNumber')
    </x-slot>
  </x-admin.insert>

  {{-- Delete Modal --}}
  <x-admin.delete title="آیا مایل هستید که شماره تلفن خود را حذف کنید؟" />
  
@endsection

@section('scripts')
@parent

<!-- DataTable data -->
{!! $phoneNumberTable->scripts() !!}

<script>
  $(document).ready(function () {
    // Select2
    $('#productSelect').select2({width: '100%'});

    // phoneNumber Table
    let dt = window.LaravelDataTables['phoneNumberTable'];
    let action = new requestHandler(dt,'phoneForm', 'phoneNumber');

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
      $('#form_output').html('');
      $('#formModal').modal('show');

      $.ajax({
        url: "{{ url('phoneNumber/edit') }}",
        method: 'get',
        data: { id: $url },
        success: function (data) {  
          $('#id').val($url);
          $('#button_action').val('update');
          $('#action').val('ویرایش');
          $('#number').val(data.number);
          $('#status').val(data.status).trigger('change');
        }
      })
    }
  });
</script>
@endsection
