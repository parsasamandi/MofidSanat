<div class="row">
  <div class="col-md-12 mb-3">
    <x-input key="number" name="تلفن همراه" />
  </div>
  {{-- Product select box --}}
  <label for="products">محصول:</label>
  <select class="browser-default custom-select" id="products" name="products">
      @foreach($products as $product)
      <option value="{{ $product->id }}">{{ $product->name }}</option>
      @endforeach
  </select>
</div>