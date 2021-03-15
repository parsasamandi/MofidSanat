<div class="row rtl">
    {{-- Product --}}
    <div class="col-md-6">
      @include('includes.form.productSelectBox')
    </div>
    {{-- Image --}}
    <div class="col-md-6 mt-2">
      <label for="image">تصویر:</label>
      <br>
      <input name="image" type="file" required/>
    </div>
</div>