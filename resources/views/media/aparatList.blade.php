@extends('layouts.admin')
@section('title','لیست آپارات')


@section('content')
    {{-- Header --}}
    <x-header pageName="ویدئو آپارات" buttonValue="افزودن ویدیئو آپارات">
        <x-slot name="table">
            {!! $aparatTable->table(['class' => 'table table-bordered table-striped table-hover-responsive dt_responsive nowrap text-center'], false) !!}
        </x-slot>
    </x-header>

    {{-- Insert Modal --}}
    <x-admin.insert size="modal-lg" formId="aparatForm">
        <x-slot name="content">
            <div class="row text-right rtl">
                {{-- Aparat --}}
                <div class="col-md-12 mb-3">
                  <label for="aparat_url">لینک ویدئو:</label>
                  <textarea rows="3" id="aparat_url" name="aparat_url" type="text" class="form-control" placeholder="لینک ویدئو آپارات"></textarea>
                </div>
                {{-- Product --}}
                <div class="col-md-12">
                  <label for="products">انتخاب محصول مرتبط:</label>
                  <select id="products" name="products[]" class="custom-select">
                    @foreach($products as $product)
                      <option name="product" value="{{ $product->id }}" multiple>{{ $product->name }}</option>
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
            $('#products').select2({width:'100%'});

            // Aparat DataTable And Action Object
            let dt = window.LaravelDataTables['aparatTable'];
            let action = new requestHandler(dt,'#aparatForm','aparat');

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
                    url: "{{ route('aparat.edit') }}",
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