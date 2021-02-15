@extends('layouts.admin')
@section('title','لیست آپارات')


@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو آپارات" buttonValue="افزودن ویدیئو آپارات">
        <x-slot name="table">
            {!! $aparatTable->table(['class' => 'table table-striped table-hover-responsive dt_responsive nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="aparatForm">
        <x-slot name="content">
            <div class="row text-right rtl">
                {{-- Aparat --}}
                <div class="col-md-6 mt-2">
                  <label for="aparat_url">لینک ویدئو:</label>
                  <textarea rows="5" id="aparat_url" name="aparat_url" type="text" class="form-control"
                    placeholder="لینک ویدئو آپارات"></textarea>
                </div>
                {{-- Product --}}
                <div class="col-md-6 mt-2">
                  <label for="productSelect">انتخاب محصول مرتبط:</label>
                  <select name="productSelect" id="productSelect" class="custom-select">
                    @foreach($products as $product)
                      <option name="product" value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                  </select>
                </div>
            </div>
        </x-slot>
    </x-admin.insert>

    {{-- Delete Modal --}}
    <x-admin.delete title="آیا از حذف لینک ویدئو آپارات مطمئن هستید؟" />

@endsection


@section('scripts')
    @parent
    {!! $aparatTable->scripts() !!}

    <script>
        $(document).ready(function() {
            // Product Select2
            $('#productSelect').select2({ tags:true,width:'100%' });
            // Aparat DataTable
            let dt = window.LaravelDataTables['aparatTable'];
            // Record Modal
            $('#create_record').click(function() {
                $('#formModal').modal('show');
                $('#aparatForm')[0].reset();
                $('#form_output').html('');
            });
            // Insert Modal
            $('#aparatForm').on('submit', function (event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('aparat.store') }}",
                    method: "POST",
                    data: form_data,
                    processing: true,
                    dataType: "json",
                    success: function (data) {
                        $('#form_output').html(data.success);
                        $('#aparatForm')[0].reset();
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
            // Edit
            window.showEditModal = function showEditModal(url) {
                editModal(url);
            }
            function editModal($url) {
                var id = $url;
                $('#form_output').html('');
                $('#formModal').modal('show');
                $.ajax({
                    url: "{{ route('aparat.edit') }}",
                    method: "get",
                    data: {id: id},
                    dataType: "json",
                    success: function(data) {
                        $('#aparat_url').val(data.media_url);
                        $('#productSelect').val(data.product_id).trigger('change');
                        $('#id').val(id);
                        $('#button_action').val('update');
                        $('#action').val('ویرایش');
                    }
                })
            }
            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteModal(url);
            }
            function deleteModal($url) {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function() {
                    $.ajax({
                        url: "/aparat/delete/" + id,
                        mathod: "get",
                        success: function
                        (data) {
                            $('#confirmModal').modal('hide');
                            dt.draw(false);
                        }
                    })
                });
            }
        });
    </script>
@endsection