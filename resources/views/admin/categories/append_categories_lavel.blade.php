<div class="form-group">
    <label for="parent_id">Select Category Lavel </label>
    <select name="parent_id" id="parent_id" class="form-control">
      <option value="0" @if (isset($category['parent_id']) && $category['parent_id']== 0)
          selected
      @endif>Main Category</option>
      @if (!empty($categories))
          @foreach ($categories as $ParentCategory)
              <option value="{{ $category['id'] }} @if (isset($category['parent_id']) && $category['parent_id']== $ParentCategory['id'])
              selected
          @endif">{{ $ParentCategory['category_name'] }}</option>
          @if (!empty($ParentCategory["subCategories"]))
              @foreach ($category["subCategories"] as $subCategory)
                  <option value="{{ $category['id'] }} @if (isset($category['parent_id']) && $category['parent_id']== $subCategory['id'])
                  selected
          @endif">&nbsp;&raquo;&nbsp;{{ $subCategory['category_name'] }}</option>
          @endforeach
      @endif
      @endforeach
      @endif
    </select>
  </div>