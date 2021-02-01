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
  <x-modals.insert size="modal-l" formId="teamForm">
    <x-slot name="content">
      <div class="col-md-12 mb-3">
        <label for="name">نام:</label>
        <input id="name" name="name" type="text" class="form-control" placeholder="نام">
      </div>
      <div class="col-md-12 mb-3">
        <label for="responsibility">مسئولیت:</label>
        <input id="responsibility" name="responsibility" type="text" class="form-control" placeholder="مسئولیت">
      </div>
      <div class="col-md-12 mb-3">
        <label for="linkedin">آدرس لینکدین:</label>
        <input id="linkedin" name="linkedin" type="url" class="form-control" placeholder="آدرس لینکدین">
      </div>
      <div class="col-md-12 mb-3">
        <label for="image">عکس:</label>
        <br>
        <input type="file" name="image"/>
      </div>
      <div class="col-md-12 mb-3">
        <label for="size">اندازه:</label>
        <input type="text" class="form-control mt-2" id="size" name="size" placeholder="اندازه"/>
      </div>
    </x-slot>
  </x-modals.insert>

  {{-- Delete Modal --}}
  <x-modals.delete title="آیا مایل به حذف عضو تیم هستید؟" />

@endsection

@section('scripts')
@parent
  <!-- DataTable data -->
  {!! $teamTable->scripts() !!}
  <script>

    $(document).ready(function () {
      // ُTeam Table
      let dt = window.LaravelDataTables['teamTable'];
      // Record modal
      $('#create_record').click(function () {
        $('#formModal').modal('show');
        $('#teamForm')[0].reset();
        $('#form_output').html('');
      });
      // Insert
      $('#teamForm').on('submit', function (event) {
        event.preventDefault();
        var form_data = new FormData(this);
        form_data.append('file',form_data);
        $.ajax({
          url: "{{ route('team.store') }}",
          method: "POST",
          data: form_data,
          dataType: "json",
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {
            $('#form_output').html(data.success);
            $('#teamForm')[0].reset();
            $('#button_action').val('insert');
            dt.draw(false);
          },
          error: function(data) {
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
      // Edit
      window.showEditModal = function showEditModal(url) {
        editTeam(url);
      }
      function editTeam($url) {
        var id = $url;
        $('#formModal').modal('show');
        $.ajax({
          url: "{{ route('team.edit') }}",
          method: "get",
          data: {id: id},
          dataType: "json",
          success: function(data) {
            $('#name').val(data.name);
            $('#responsibility').val(data.responsibility);
            $('#linkedin').val(data.linkedin_address);
            $('#size').val(data.size);
            $('#id').val(id);
            $('#action').val('update');
            $('#button_action').val('ویرایش');
          }
        })
      }
      // Delete
      window.showConfirmationModal = function showConfirmationModal(url) {
        deleteTeam(url);
      }
      function deleteTeam($url) {
        var id = $url;
        $('#confirmModal').modal('show');
        $('#ok_button').click(function () {
          $.ajax({
            url: "/team/delete/" + id,
            method: "get",
            data: {id: id},
            dataType: "json",
            success: function(data) {
              setTimeout(function (data) {
                $('#confirmModal').modal('hide');
                dt.draw(false);
              }, 500);
            }
          })
        })
      }
    });
  </script>
@endsection
