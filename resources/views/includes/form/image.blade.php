<div class="row rtl">
    {{-- Product --}}
    <div class="col-md-6">
      <label for="products">انتخاب محصول مرتبط:</label>
      <select name="products[]" id="products" class="browser-default custom-select">
        @foreach($products as $product)
          <option value="{{ $product->id }}" multiple>{{ $product->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Image --}}
    <div class="col-md-6 mt-2">
      <label for="image">تصویر:</label>
      <br>
      <input name="image" type="file" required/>
    </div>
</div>