<div class="row rtl">
    {{-- Name --}}
    <div class="col-md-6">
      <label for="name">نام:</label>
      <input name="name" id="name" type="text" placeholder="نام">
    </div>
    {{-- Category --}}
    <div class="col-md-6 mb-1 lrt">
      <label for="category">در دسته بندی اول:</label>
      <select class="browser-default custom-select" id="category" name="category">
        @foreach($cats as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- Status --}}
    <div class="col-md-12">
      <label for="status"></label>
      <select id="status" name="status" class="browser-default custom-select">
        <option value="0">فعال</option>
        <option value="1">غیر فعال</option>
      </select>
    </div>
</div>