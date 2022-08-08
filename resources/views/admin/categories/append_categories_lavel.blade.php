<div class="form-group">
    {{-- @if (isset($category))
       @php
       echo $category['parent_id'];
            echo "<pre>";print_r($category);
       @endphp
    @endif --}}
    <label for="parent_id">Select Category Lavel </label>
    <select name="parent_id" id="parent_id" class="form-control">
      <option value="0" @if (isset($category['parent_id']) && $category['parent_id']== 0)
          selected
      @endif>Main Category</option>
      @if (!empty($getCategories))
          @foreach ($getCategories as $ParentCategory)
              <option value="{{ $ParentCategory['id'] }}"@if (isset($category['parent_id']) && $category['parent_id']== $ParentCategory['id'])
              selected
          @endif >{{ $ParentCategory['category_name'] }}</option>
          @if (!empty($ParentCategory["sub_categories"]))
              @foreach ($ParentCategory["sub_categories"] as $subCategory)
                  <option value="{{ $subCategory['id'] }}"@if (isset($subCategory['parent_id']) && $subCategory['parent_id']== $subCategory['id'])
                  selected
              @endif >&nbsp;&raquo;&nbsp;{{ $subCategory['category_name'] }}</option>
          @endforeach
      @endif
      @endforeach
      @endif
    </select>
  </div>