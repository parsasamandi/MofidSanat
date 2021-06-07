<div class="row">
    {{-- Name --}}
    <x-input key="name" placeholder="نام" 
        class="col-md-12 mb-3" />
    {{-- Status --}}
    <div class="col-md-12">
        <label for="status">وضعیت:</label>
        <select id="status" name="status" class="browser-default custom-select">
            <option value="0">فعال</option>
            <option value="1">غیرفعال</option>
        </select>
    </div>
</div>