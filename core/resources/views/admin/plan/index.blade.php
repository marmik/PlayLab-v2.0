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
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Price')</th>
                                <th scope="col">@lang('Duration')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $plan)
                                <tr>
                                    <td data-label="@lang('Name')">{{ $plan->name }}</td>
                                    <td data-label="@lang('Price')">{{ getAmount($plan->pricing) }} {{ $general->cur_text }}</td>
                                    <td data-label="@lang('Duration')">{{ $plan->duration }}</td>
                                    <td data-label="@lang('Status')">
                                        @if($plan->status == 1)
                                            <span class="badge badge--success">@lang('Enabled')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Disabled')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <button class="btn btn-sm btn-outline--primary editBtn" data-plan="{{ $plan }}" data-id="{{ $plan->id }}" data-name="{{ $plan->name }}" data-pricing="{{ getAmount($plan->pricing) }}" data-duration="{{ $plan->duration }}" data-icon="{{ $plan->icon }}"  data-image="{{ getImage(getFilePath('plan').'/'.$plan->image, getFileSize('plan')) }}"><i class="la la-pencil"></i>@lang('Edit')</button>
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
                @if ($plans->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($plans) }}
                </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>


<!-- Plan Modal -->
<div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label>@lang('Plan Name')</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('Plan Price')</label>
                    <input type="text" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>@lang('Subscription Duration')</label>
                    <div class="input-group">
                        <input type="text" name="duration" class="form-control" required>
                        <span class="input-group-text">@lang('Days')</span>
                    </div>
                </div>

                <div class="form-group">
                    <label>@lang('Description')</label>
                    <textarea name="description" class="form-control" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label>@lang('Image')</label>
                    <div class="image-upload">
                        <div class="thumb">
                            <div class="avatar-preview">
                                <div class="profilePicPreview"
                                     style="background-image: url({{ getImage('/', getFileSize('plan')) }})">
                                    <button type="button" class="remove-image"><i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="avatar-edit">
                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1"
                                       accept=".png, .jpg, .jpeg">
                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Thumbnail Image')</label>
                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg, jpg, png')</b>. @lang('Image will
                                    be resized into') {{ getFileSize('plan') }}@lang('px') </small>
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

@endsection


@push('breadcrumb-plugins')
    <button class="btn btn-sm btn-outline--primary addBtn"><i class="la la-plus"></i>@lang('Add New')</button>
@endpush

@push('style-lib')
<link href="{{ asset('assets/admin/css/fontawesome-iconpicker.min.css') }}" rel="stylesheet">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/fontawesome-iconpicker.js') }}"></script>
@endpush

@push('script')
<script>
    (function ($) {
        "use strict"
        var modal = $('#planModal');
        var defautlImage = `{{ getImage(getFilePath('plan'), getFileSize('plan')) }}`;
        $('.addBtn').on('click', function(){
            $('.modal-title').text(`@lang('Add New Plan')`);
            modal.find('form').attr('action', `{{ route('admin.plan.store') }}`);
            modal.find('.statusGroup').hide();
            modal.modal('show');
        });

        $('.editBtn').on('click', function(){
            var plan = $(this).data('plan');
            $('.modal-title').text(`@lang('Update Plan')`);
            modal.find('input[name=name]').val(plan.name);
            modal.find('input[name=price]').val(parseFloat(plan.pricing).toFixed(2));
            modal.find('input[name=duration]').val(plan.duration);
            modal.find('input[name=icon]').val(plan.icon);
            modal.find('[name=description]').val(plan.description);
            modal.find('form').attr('action', `{{ route('admin.plan.store', '') }}/${plan.id}`);
            modal.find('.profilePicPreview').attr('style', `background-image: url(${$(this).data('image')})`);
            modal.find('.statusGroup').show();
         
            if(plan.status == 1){
                modal.find('input[name=status]').bootstrapToggle('on');
            }else{
                modal.find('input[name=status]').bootstrapToggle('off');
            }

            modal.modal('show');
        });

        modal.on('hidden.bs.modal', function () {
            modal.find('.profilePicPreview').attr('style', `background-image: url(${defautlImage})`);
            $('#planModal form')[0].reset();
        });

        $('.iconPicker').iconpicker().on('iconpickerSelected', function (e) {
            $(this).closest('.form-group').find('.iconpicker-input').val(`<i class="${e.iconpickerValue}"></i>`);
        });

    })(jQuery);
</script>
@endpush
