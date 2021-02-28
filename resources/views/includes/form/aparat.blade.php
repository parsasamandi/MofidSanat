<div class="row rtl">
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