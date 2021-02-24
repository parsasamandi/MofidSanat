@extends('layouts.admin')
@section('title','لیست دسته بندی اول')

@section('content')
    
    {{-- Header --}}
    <x-header pageName="دسته بندی ۱" buttonValue="دسته بندی">
        <x-slot name="table">
            {!! $categoryTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-l" formId="categoryForm">
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
    </x-admin.insert>

    {{-- Delete --}}
    <x-admin.delete title="آیا مایل هستید دسته بندی ۱ را حذف کنید؟" />

@endsection

@section('scripts')
    @parent
    
    {!! $categoryTable->scripts() !!}
    
    <script>
        $(document).ready(function () {
            // Category DataTable
            let dt = window.LaravelDataTables['categoryTable'];
            let action = new requestHandler(dt,'#categoryForm','category');

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
                $('#formModal').modal('show');
                $('#form_output').html('');

                $.ajax({
                    url: "{{ url('category/edit') }}",
                    method: 'get',
                    data: { id: $url },
                    dataType: 'json',
                    success: function (data) { 
                        $('#id').val($url);
                        $('#name').val(data.name);
                        $('#status').val(data.status).trigger('change');
                        $('#action').val('ویرایش');
                        $('#button_action').val('update');
                    }
                })
            }
        });
    </script>
@endsection
