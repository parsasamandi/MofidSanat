@extends('layouts.admin')
@section('title','لیست آپارات')


@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو آپارات" buttonValue="ویدیئو آپارات">
        <x-slot name="table">
            <x-table :table="$aparatTable" />
        </x-slot>
    </x-header>

    {{-- Insertion --}}
    <x-admin.insert size="modal-lg" formId="aparatForm">
        <x-slot name="content">
            {{-- Form --}}
            @include('includes.form.aparat')
        </x-slot>
    </x-admin.insert>

    {{-- Delete --}}
    <x-admin.delete title="ویدئو آپارات" />
@endsection


@section('scripts')
@parent
{!! $aparatTable->scripts() !!}

<script>
    $(document).ready(function() {
        // Aparat DataTable And Action Object
        let dt = window.LaravelDataTables['aparatTable'];
        let action = new RequestHandler(dt,'#aparatForm','aparat');

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
            // Edit
            action.edit();

            $.ajax({
                url: "{{ url('aparat/edit') }}",
                method: "get",
                data: {id: $url},
                success: function(data) {
                    $('#id').val($url);
                    $('#action').val('ویرایش');
                    $('#button_action').val('update');
                    $('#aparat_url').val(data.media_url);
                    $('#products').val(data.product_id).trigger('change');
                }
            })
        }
    });
</script>
@endsection