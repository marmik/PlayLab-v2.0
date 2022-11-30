@extends('admin.layouts.app')
@section('panel')
<div class="row">
	<div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Type')</th>
                                <th scope="col">@lang('Click')</th>
                                <th scope="col">@lang('Impression')</th>
	                            <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ads as $ad)
	                        <tr>
	                            <td data-label="@lang('Title')">
	                                {{ __($ad->title) }}
	                            </td>
	                            <td data-label="@lang('Type')">
	                                {{ __($ad->type) }}
	                            </td>
	                            <td data-label="@lang('Click')">
	                                {{ __($ad->click) }}
	                            </td>
	                            <td data-label="@lang('Impression')">
	                                {{ __($ad->impression) }}
	                            </td>
	                            <td data-action="@lang('Action')">
	                                <button class="btn btn-sm btn-outline--primary editBtn" data-id="{{ $ad->id }}" data-type="{{ $ad->type }}" @if(@$ad->content->link) data-link="{{ $ad->content->link }}"@endif @if(@$ad->content->image)data-image="{{ asset(getFilePath('ads').'/'.$ad->content->image) }}"@endif @if(@$ad->content->script)data-script="{{ $ad->content->script }}"@endif data-title="{{ $ad->title }}"><i class="la la-pencil"></i>@lang('Edit')</button>

	                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-id="{{ $ad->id }}" data-question="@lang('Are you sure to remove this advertise?')" data-action="{{ route('admin.advertise.remove', $ad->id) }}"><i class="la la-trash"></i>@lang('Delete')</button>
	                            </td>
	                        </tr>
	                        @empty
	                        <tr>
	                            <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
	                        </tr>
	                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($ads->hasPages())
            <div class="card-footer py-4">
                {{  paginateLinks($ads) }}
            </div>
            @endif
        </div>
    </div>
</div>

      <!-- Modal -->
<div class="modal fade" id="advertiseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('Add Advertise')</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>@lang('Title')</label>
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
                <label>@lang('Type')</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="">-- @lang('Select One') --</option>
                    <option value="banner">@lang('Banner')</option>
                    <option value="script">@lang('Script')</option>
                </select>
            </div>
            <div class="form-group link">
                <label>@lang('Link')</label>
                <input type="text" name="link" placeholder="@lang('Link')" class="form-control">
            </div>
            <div class="form-group image">
                <label>@lang('Choose file')</label>
                <input type="file" class="form-control" name="image">
            </div>

            <div class="form-group script">
                <label>@lang('Script')</label>
                <textarea rows="6" class="form-control" name="script" placeholder="@lang('Write Your Script')"></textarea>
            </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
      </div>
    </form>
    </div>
  </div>
</div>

<x-confirmation-modal></x-confirmation-modal>

@endsection
@push('breadcrumb-plugins')
<button class="btn btn-sm btn-outline--primary addBtn"><i class="la la-plus"></i> @lang('Add Advertise')</button>
@endpush
@push('script')
<script>
    (function($){
        "use strict";
        $('#type').change(function(){
            if ($(this).val() == 'script') {
                $('.link').hide();
                $('.image').hide();
                $('.script').show();
            }else{
                $('.link').show();
                $('.image').show();
                $('.script').hide();
            }
        }).change();

        $('#type2').change(function(){
            if ($(this).val() == 'script') {
                $('.link2').hide();
                $('.image2').hide();
                $('.script2').show();
            }else if($(this).val() == 'banner'){
                $('.link2').show();
                $('.image2').show();
                $('.script2').hide();
            }
        }).change();

        var modal = $('#advertiseModal');

        $('.addBtn').on('click', function(){
            modal.find('.modal-title').text(`@lang('Add Advertise')`);
            modal.find('form').attr('action', `{{ route('admin.advertise.store') }}`);
            modal.modal('show');
        });

        $('.editBtn').on('click', function(){
            var data = $(this).data();
            modal.find('.modal-title').text(`@lang('Update Advertise')`);

            modal.find('select[name=type]').val(data.type);
            modal.find('input[name=link]').val(data.link);
            modal.find('input[name=title]').val(data.title);
            modal.find('textarea[name=script]').val(data.script);
            if (data.type == 'script') {
                $('.link').hide();
                $('.image').hide();
                $('.script').show();
            }else{
                $('.link').show();
                $('.image').show();
                $('.script').hide();
            }
            modal.find('form').attr('action', `{{ route('admin.advertise.store', '') }}/${data.id}`);
            modal.modal('show');
        });

        modal.on('hidden.bs.modal', function () {
            modal.find('form')[0].reset();
        });

    })(jQuery);
</script>
<script>
    (function($){
        "use strict";
        
    })(jQuery);
</script>
<script>
    (function($){
        "use strict";
        // $(".editBtn").on('click',function(){
        //     var modal = $("#editmodal");
        //     modal.find('img').attr('src',`${$(this).data('image')}`);
        //     modal.find('select[name=type]').val($(this).data('type'));
        //     modal.find('input[name=link]').val($(this).data('link'));
        //     modal.find('input[name=title]').val($(this).data('title'));
        //     modal.find('textarea[name=script]').val($(this).data('script'));
        //     modal.find('form').attr('action',$(this).data('action'));
        //     modal.modal('show');
        //     if ($(this).data('type') == 'script') {
        //         $('.link2').hide();
        //         $('.image2').hide();
        //         $('.script2').show();
        //     }else{
        //         $('.link2').show();
        //         $('.image2').show();
        //         $('.script2').hide();
        //     }
        // });

        // $('.removeBtn').on('click', function() {
        //     var modal = $('#removeModal');
        //     modal.find('input[name=id]').val($(this).data('id'))
        //     modal.modal('show');
        // });
    })(jQuery);
</script>
@endpush
