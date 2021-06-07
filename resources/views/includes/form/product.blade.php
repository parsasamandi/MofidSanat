<div class="row">
    {{-- Name --}}
    <x-input key="name" placeholder="نام" 
      class="col-md-6 mb-3" />
    {{-- Model --}}
    <x-input key="model" placeholder="مدل" 
      class="col-md-6 mb-3" />
    {{-- Price --}}
    <x-input key="price" placeholder="هزینه" 
      class="col-md-4 mb-3" />
    {{-- Size --}}
    <x-input key="size" placeholder="اندازه(بین ۱ تا ۱۲ انتخاب کنید)" 
      class="col-md-4 mb-3" />
    {{-- Status --}}
    <div class="col-md-4 mb-3">
      <label for="status">وضعیت:</label>
      <select id="status" name="status" class="browser-default custom-select">
        <option value="0">فعال</option>
        <option value="1">غیرفعال</option>
      </select>
    </div> 
    {{-- Category --}}
    <div class="col-md-6 mb-3">
      <label for="categories">دسته بندی اول:</label>
      <select class="browser-default custom-select" name="categories" id="categories">
        @foreach($categories as $category)
          <option value="{{ $category->id }}"> {{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Sub Category --}}
    <div class="col-md-6 mb-3 ltr">
      <label for="subcategories">دسته بندی دوم:</label>
      <select class="browser-default custom-select" name="subcategories" id="subcategories">
        <option value="">دسته بندی دوم</option>
        @foreach($subcategories as $subcategory)
          <option value="{{ $subcategory->id }}"> {{ $subcategory->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Description --}}
    <div class="col-md-12">
      <label for="description">توضیحات:</label>
      <textarea id="description" name="description" type="text" rows="6" Placeholder="توضیحات" class="form-control"></textarea>
    </div>
</div>