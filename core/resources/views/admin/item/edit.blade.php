@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('admin.item.update',$item->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>@lang('Portrait Image')</label>
                            <div class="image-upload">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('item_portrait').'/'.@$item->image->portrait) }})">
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" name="portrait" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                        <label for="profilePicUpload1" class="bg--success">@lang('Upload Portrait Image')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label>@lang('Landscape Image')</label>
                            <div class="image-upload">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('item_landscape').'/'.@$item->image->landscape) }})">
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" name="landscape" id="profilePicUpload2" accept=".png, .jpg, .jpeg">
                                        <label for="profilePicUpload2" class="bg--success">@lang('Upload Landscape Image')</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group @if($item->item_type != 1) col-md-12 @else col-md-6 @endif">
                            <label>@lang('Title')</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $item->title }}">
                        </div>
                        @if($item->item_type == 1)
                        <div class="form-group col-md-6">
                            <label>@lang('Version')</label>
                            <select class="form-control" name="version">
                                <option value="0">@lang('Free')</option>
                                <option value="1">@lang('Paid')</option>
                            </select>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>@lang('Category')</label>
                            <select class="form-control" name="category">
                                <option value="">-- @lang('Select One') --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" data-subcategories="{{ $category->subcategories }}">{{ __($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('Sub Category')</label>
                            <select class="form-control" name="sub_category_id">
                                <option value="">-- @lang('Select One') --</option>
                                @foreach($subcategories as $sub_categorie)
                                <option value="{{ $sub_categorie->id }}">{{ __($sub_categorie->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>@lang('Preview Text')</label>
                            <textarea class="form-control" name="preview_text" rows="5" placeholder="@lang('Preview Text')">{{ $item->preview_text }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('Description')</label>
                            <textarea class="form-control" name="description" rows="5" placeholder="@lang('Description')">{{ $item->description }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>@lang('Director')</label>
                            <input type="text" name="director" class="form-control" placeholder="@lang('Director')" value="{{ $item->team->director }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>@lang('Producer')</label>
                            <input type="text" name="producer" class="form-control" placeholder="@lang('Producer')" value="{{ $item->team->producer }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label>@lang('Ratings') <small class="text--primary">(@lang('maximum 10 star'))</small></label>
                            <div class="input-group">
                                <input type="text" name="ratings" class="form-control" placeholder="@lang('Ratings')" value="{{ $item->ratings }}">
                                <span class="input-group-text"><i class="las la-star"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-control-label">@lang('Casts')</label>
                            <small class="ml-2 mt-2 text-facebook">@lang('Separate multiple by') <code>,</code>(@lang('comma')) @lang('or') <code>@lang('enter')</code> @lang('key')</small>

                            <select name="casts[]" class="form-control select2-auto-tokenize" placeholder="Add short words which better describe your site" multiple="multiple" required>
                                @foreach(explode(',',$item->team->casts) as $cast)
                                <option value="{{ $cast }}" selected>{{ $cast }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang('Tags')</label>
                            <small class="ml-2 mt-2 text-facebook">@lang('Separate multiple by') <code>,</code>(@lang('comma')) @lang('or') <code>@lang('enter')</code> @lang('key')</small>
                            <select name="tags[]" class="form-control select2-auto-tokenize" placeholder="Add short words which better describe your site" multiple="multiple" required>
                                @foreach(explode(',',$item->tags) as $tag)
                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>@lang('Status')</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Active')" data-off="@lang('Inactive')" name="status" @if($item->status) checked @endif>
                        </div>
                        <div class="col-md-3">
                            <label>@lang('Featured')</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Yes')" data-off="@lang('No')" name="featured" @if($item->featured) checked @endif>
                        </div>
                        <div class="col-md-3">
                            <label>@lang('Trending')</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Yes')" data-off="@lang('No')" name="trending" @if($item->trending) checked @endif>
                        </div>
                        <div class="col-md-3">
                            <label>@lang('Single Section')</label>
                            <input type="checkbox" data-width="100%" data-size="large" data-onstyle="-success" data-offstyle="-danger" data-bs-toggle="toggle" data-height="50" data-on="@lang('Yes')" data-off="@lang('No')" name="single" @if($item->single) disabled checked @endif>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn--primary w-100 h-45">@lang('Update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('breadcrumb-plugins')
<a href="{{ route('admin.item.index') }}" class="btn btn-sm btn-outline--primary"><i class="la la-undo"></i> @lang('Back')</a>
@endpush
@push('script')
<script>
    (function($){
        "use strict"
        $('[name=category]').change(function(){
            var subcategoryOption = '<option>@lang("Select One")</option>';
            var subcategories = $(this).find(':selected').data('subcategories');

            subcategories.forEach(subcategory => {
                subcategoryOption += `<option value="${subcategory.id}">${subcategory.name}</option>`;
            });

            $('[name=sub_category_id]').html(subcategoryOption);
        });

        $('select[name=category]').val('{{ $item->category->id }}');
        $('select[name=sub_category_id]').val('{{ @$item->sub_category->id }}');
        $('select[name=version]').val('{{ @$item->version }}');
    })(jQuery);
</script>
@endpush
