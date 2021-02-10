@extends('layouts.admin')
@section('title','لیست شماره تلفن ها')

@section('content')

  {{-- Header --}}
  <x-header pageName="شماره تلفن" buttonValue="افزودن شماره تلفن">
    <x-slot name="table">
      {!! $phoneNumberTable->table(['class' => 'table table-striped table-bordered table-hover-responsive dt_responsive nowrap  text-center'], false) !!}
    </x-slot>
  </x-header>

  {{-- Insert Modal --}}
  <x-admin.insert size="modal-l" formId="phoneForm">
    <x-slot name="content">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="number">شماره همراه:</label>
          <input name="number" id="number" type="text" placeholder="شماره همراه">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="productSelect">انتخاب محصول مرتبط به شماره همراه:</label>
          <select class="browser-default custom-select" id="productSelect" name="productSelect">
            @foreach($products as $product)
              <option name="product" value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
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
    $('#productSelect').select2({ tags: true, width: '100%'});

    // phoneNumber Table
    let dt = window.LaravelDataTables['phoneNumberTable'];

    // Record modal
    $('#create_record').click(function () {
      $('#formModal').modal('show');
      $('#phoneForm')[0].reset();
    });
    // Store
    $('#phoneForm').on('submit', function (event) {
      event.preventDefault();
      var form_data = $(this).serialize();
      $.ajax({
        url: "{{ route('phoneNumber.store') }}",
        method: "POST",
        data: form_data,
        dataType: "json",
        success: function(data) {
          $('#form_output').html(data.success);
          $('#phoneForm')[0].reset();
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
      deletePhoneNumber(url);
    }
    function deletePhoneNumber($url) {
      var id = $url;
      $('#confirmModal').modal('show'); 
      $('#ok_button').click(function () {
        $.ajax({
          url: "/phoneNumber/delete/" + id,
          mehtod: "get",
          success: function (data) {
            setTimeout(function () {
              $('#confirmModal').modal('hide');
              dt.draw(false);
            }, 500);
          }
        })
      }) 
    }
    // Edit
    window.showEditModal = function showEditModal(url) {
      editPhoneNumber(url);
    }
    function editPhoneNumber($url) {
      var id = $url;
      $('#form_output').html('');
      $('#formModal').modal('show');

      $.ajax({
        url: "{{ route('phoneNumber.edit') }}",
        method: 'get',
        data: { id: id },
        dataType: 'json',
        success: function (data) {  
          $('#id').val(id);
          $('#number').val(data.number);
          $('#button_action').val('update');
          $('#action').val('ویرایش');
          if(data.status == 0) 
              $('#status').val(0).trigger('change');
          else if(data.status == 1) 
            $('#status').val(1).trigger('change');
          else if(data.status == 2) 
            $('#status').val(2).trigger('change');
        }
      })
    }
  });
</script>
@endsection
