<div class="row">
  {{-- Product --}}
  <div class="col-md-6 mb-3">
    @include('includes.form.productSelectBox')
  </div>
  {{-- Image --}}
  <div class="col-md-6">
    <h6 class="images">تصویر:</h6>
    <input type="file" id="image" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg"/>
    {{-- Hidden image --}}
    <input type="hidden" id="hidden_image" name="hidden_image"/>
    {{-- Image to be shown --}}
    <img id="picture" class="image">
  </div>
</div>
