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
  <x-modals.insert size="modal-l" formId="phoneForm">
    <x-slot name="content">
      <div class="row">
        <div class="col-md-12 mb-3">
          <label for="number">شماره همراه:</label>
          <input name="number" id="number" type="text" class="form-control" placeholder="شماره همراه">
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
  </x-modals.insert>

  {{-- Delete Modal --}}
  <x-modals.delete title="آیا مایل هستید که شماره تلفن خود را حذف کنید؟" />
  
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
          if(data.error.length > 0) {
            var error_html = '';
            for(var count = 0;count < data.error.length; count++) {
              error_html += '<div class="alert alert-danger">' + data.error[count] + '</div>';
            }
            $('#form_output').html(error_html);
          }
          else {
            $('#form_output').html(data.success);
            $('#phoneForm')[0].reset();
            $('#button_action').val('insert');
            dt.draw(false);
          }
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
          $('#number').val(data.number);
          $('#id').val(id);
          $('#formModal').modal('show');
          $('#action').val('ویرایش');
          $("#action").show();
          if(data.status == 0) 
              $('#status').val(0).trigger('change');
            if(data.status == 1) 
              $('#status').val(1).trigger('change');
            if(data.status == 2) 
              $('#status').val(2).trigger('change');
          $('#button_action').val('update');
        }
      })
    }
  });
</script>
@endsection
