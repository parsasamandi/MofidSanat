{{-- Phone number --}}
<div class="row">
    <div class="col-md-12 mb-3">
      <label for="number">شماره همراه:</label>
      <input name="number" id="number" type="text" placeholder="شماره همراه">
    </div>
  </div>
  {{-- Product related to phone number --}}
  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="productSelect">انتخاب محصول مرتبط به شماره همراه:</label>
      <select class="browser-default custom-select" id="productSelect" name="productSelect">
        @foreach($products as $product)
          <option name="product" value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
      </select>
    </div>
</div>