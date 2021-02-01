@extends('layouts.admin')
@section('title','لیست دسته بندی سطح-۱')

@section('content')
    
    {{-- Header --}}
    <x-header pageName="دسته بندی ۱" buttonValue="افزودن دسته بندی">
        <x-slot name="table">
            {!! $categoryTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-modals.insert size="modal-l" formId="catForm">
        <x-slot name="content">
            <div class="row">
                {{-- Name --}}
                <div class="col-md-12 mb-3">
                    <label for="title">نام:</label>
                    <input name="name" id="name" type="text" class="form-control" placeholder="نام دسته بندی">
                </div>
                {{-- Status --}}
                <div class="col-md-12">
                    <label for="status">وضعیت:</label>
                    <select id="status" name="status" class="browser-default custom-select">
                        <option value="0">فعال</option>
                        <option value="1">غیرفعال</option>
                    </select>
                </div>
            </div>
        </x-slot>
    </x-modals.insert>
    {{-- Delete --}}
    <x-modals.delete title="آیا مایل هستید دسته بندی ۱ را حذف کنید؟" />

@endsection

@section('scripts')
    @parent
    
    {!! $categoryTable->scripts() !!}
    
    <script>
        $(document).ready(function () {
            // Category Table
            let dt = window.LaravelDataTables["categoryTable"];
            // create modal
            $('#create_record').click(function () {
                $('#formModal').modal('show');
                $('#catForm')[0].reset();
                $('#form_output').html('');
            });
            // Store
            $('#catForm').on('submit', function (event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ route('category.store') }}",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    success: function(data) {
                        $('#form_output').html(data.success);
                        $('#catForm')[0].reset();
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
                editCategory(url);
            }
            function editCategory($url) {
                var id = $url;
                $('#formModal').modal('show');
                $('#form_output').html('');
                $.ajax({
                    url: "{{ route('category.edit') }}",
                    method: 'get',
                    data: { id: id },
                    dataType: 'json',
                    success: function (data) {  
                        $('#name').val(data.name);
                        $('#id').val(id);
                        $('#formModal').modal('show');
                        $('#action').val('ویرایش');
                        $("#action").show();
                        if(data.status == 0) 
                            $('#status').val(0).trigger('change');
                        if(data.status == 1) 
                            $('#status').val(1).trigger('change');
                        $('#button_action').val('update');
                    }
                })
            }
            // Delete
            window.showConfirmationModal = function showConfirmationModal(url) {
                deleteCategory(url);
            }
            function deleteCategory($url)
            {
                var id = $url;
                $('#confirmModal').modal('show');
                $('#ok_button').click(function () {
                    $.ajax({
                        url: "/category/delete/" + id,
                        method: "get",
                        success: function(data) {
                            setTimeout(function () {
                                $('#confirmModal').modal('hide');
                                dt.draw(false);
                            }, 500)
                        }
                    })
                })
            }
        });
    </script>
@endsection
