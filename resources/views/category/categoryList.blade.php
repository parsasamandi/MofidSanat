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
            {{-- Form --}}
            @include('includes.form.category')
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
