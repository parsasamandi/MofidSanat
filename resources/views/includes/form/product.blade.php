<div class="row">
    {{-- Name --}}
    <div class="col-md-6 mb-3">
      <label for="name">نام:</label>
      <input id="name" name="name" type="text" placeholder="نام">
    </div>
    {{-- Model --}}
    <div class="col-md-6 mb-3 ltr">
      <label for="modal">:مدل</label>
      <input id="model" name="model" type="text" placeholder="مدل">
    </div>
    {{-- Price --}}
    <div class="col-md-4 mb-3 ltr">
      <label for="price">:هزینه</label>
      <input id="price" name="price" type="text" placeholder="هزینه">
    </div>
    {{-- Size --}}
    <div class="col-md-4 mb-3">
      <label for="size">اندازه:</label>
      <input id="size" name="size" type="text" placeholder="اندازه(بین ۱ تا ۱۲ انتخاب کنید)">
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
        @foreach($cats as $cat)
          <option value="{{ $cat->id }}" required> {{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Sub Category --}}
    <div class="col-md-6 mb-3 ltr">
      <label for="subCategory">دسته بندی دوم:</label>
      <select class="browser-default custom-select" name="subCategories" id="subCategories">
        <option value="">دسته بندی دوم</option>
        @foreach($subCats as $subCat)
          <option value="{{ $subCat->id }}"> {{ $subCat->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-3">
      <label for="description">توضیحات:</label>
      <textarea id="description" name="description" type="text" rows="6" Placeholder="توضیحات" class="form-control"></textarea>
    </div>
</div>