<div class="row">
    {{-- Name --}}
    <div class="col-md-6 mb-3">
      <x-input key="name" name="نام" />
    </div>
    {{-- Model --}}
    <div class="col-md-6 mb-3">
      <x-input key="model" name="مدل" />
    </div>
    {{-- Price --}}
    <div class="col-md-4 mb-3">
      <x-input key="price" name="هزینه" />
    </div>
    {{-- Size --}}
    <div class="col-md-4 mb-3">
      <x-input key="model" name="اندازه(بین ۱ تا ۱۲ انتخاب کنید)" />
    </div>
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
      <label for="category_select">دسته بندی اول:</label>
      <select class="browser-default custom-select" name="categories" id="categories">
        <option value="">دسته بندی اول</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}"> {{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Sub Category --}}
    <div class="col-md-6 mb-3 ltr">
      <label for="subCategory">دسته بندی دوم:</label>
      <select class="browser-default custom-select" name="subCategories" id="subCategories">
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