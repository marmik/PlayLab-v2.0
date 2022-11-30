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
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($televisions as $television)
                            <tr>
                                <td data-label="@lang('Title')">{{ __($television->title) }}</td>
                                <td data-label="@lang('Status')">
                                    @if($television->status == 1)
                                    <span class="badge badge--success">@lang('Enabled')</span>
                                    @else
                                    <span class="badge badge--danger">@lang('Disabled')</span>
                                    @endif
                                </td>
                                <td data-label="@lang('Action')">
                                    <button class="btn btn-sm btn-outline--primary editBtn" data-television="{{ $television }}" data-image="{{ getImage(getFilePath('television').'/'.$television->image, getFileSize('television')) }}"><i class="la la-pencil"></i>@lang('Edit')</button>
                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-question="@lang('Are you sure to delete this television?')" data-action="{{ route('admin.television.delete', $television->id) }}" data-submit_text="btn btn--primary"><i class="la la-trash"></i>@lang('Delete')</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($televisions->hasPages())
            <div class="card-footer py-4">
                {{ paginateLinks($televisions) }}
            </div>
            @endif
        </div><!-- card end -->
    </div>
</div>


<!-- Plan Modal -->
<div class="modal fade" id="televisionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Add New Plan')</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Television Title')</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('URL')</label>
                        <input type="text" name="url" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Description')</label>
                        <textarea name="description" id="" class="form-control"  rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('Thumbnail Image')</label>
                        <div class="image-upload">
                            <div class="thumb">
                                <div class="avatar-preview">
                                    <div class="profilePicPreview" style="background-image: url({{ getImage('/', getFileSize('television')) }})">
                                        <button type="button" class="remove-image"><i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                    <label for="profilePicUpload1" class="bg--success">@lang('Upload Thumbnail Image')</label>
                                    <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg, jpg, png')</b>. @lang('Image will
                                        be resized into') {{ getFileSize('television') }} @lang('px') </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group statusGroup">
                        <label>@lang('Status')</label>
                        <input type="checkbox" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" data-width="100%" name="status">
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
<button class="btn btn-sm btn-outline--primary addBtn"><i class="la la-plus"></i>@lang('Add New')</button>
@endpush

@push('script')
<script>
    (function ($) {
        "use strict"
        var modal = $('#televisionModal');
        var defautlImage = `{{ getImage(getFilePath('television'), getFileSize('television')) }}`;

        $('.addBtn').on('click', function(){
            $('.modal-title').text(`@lang('Add New Television')`);
            modal.find('form').attr('action', `{{ route('admin.television.store') }}`);
            modal.find('.profilePicPreview').attr('style', `background-image: url(${defautlImage})`);
            modal.find('.statusGroup').hide();
            modal.modal('show');
        });

        $('.editBtn').on('click', function(){
            var television = $(this).data('television');
            $('.modal-title').text(`@lang('Update Television')`);
            modal.find('input[name=title]').val(television.title);
            modal.find('input[name=url]').val(television.url);
            modal.find('[name=description]').val(television.description);
            modal.find('.profilePicPreview').attr('style', `background-image: url(${$(this).data('image')})`);
            modal.find('form').attr('action', `{{ route('admin.television.store', '') }}/${television.id}`);
            modal.find('.statusGroup').show();
         
            if(television.status == 1){
                modal.find('input[name=status]').bootstrapToggle('on');
            }else{
                modal.find('input[name=status]').bootstrapToggle('off');
            }

            modal.modal('show');
        });

        modal.on('hidden.bs.modal', function () {
                modal.find('form')[0].reset();
        });



    })(jQuery);
</script>
@endpush