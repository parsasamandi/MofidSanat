{{-- Products --}}
<label for="products">محصول:</label>
    <select name="products[]" id="products" class="browser-default custom-select">
        @foreach($products as $product)
            <option value="{{ $product->id }}" multiple>{{ $product->name }}</option>
        @endforeach
    </select>
</select>