@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Item')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sliders as $slider)
                                <tr>
                                    <td data-label="@lang('Item')">
                                        {{ $slider->item->title }}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if ($slider->status == 1)
                                            <span class="badge badge--success">@lang('Enabled')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Disabled')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Action')">
                                        <button class="btn btn-sm btn-outline--primary editBtn" data-id="{{ $slider->id }}"
                                                data-image="{{ getImage(getFilePath('slider').'/'.$slider->image, getFileSize('slider')) }}" data-status="{{ $slider->status }}" data-caption="{{ $slider->caption_show }}">
                                            <i class="la la-pencil"></i>@lang('Edit')
                                        </button>
                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" data-id="{{ $slider->id }}" data-action="{{ route('admin.sliders.remove', $slider->id) }}" data-question="@lang('Are you sure to delete this slider?')" data-submit_text="btn btn--primary">
                                            <i class="las la-trash text--shadow"></i>@lang('Delete')
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">@lang('Slider Not Found')</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($sliders->hasPages())
                <div class="card-footer py-4">
                    {{ $sliders->links('admin.partials.paginate') }}
                </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>


    <!-- Slider Modal -->
    <div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Add Slider')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.sliders.add') }}" method="post" enctype="multipart/form-data" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group itemGroup">
                            <label>@lang('Select Item')</label>
                            <select name="item" class="form-control item-list select2-basic" required>
                                <option value="">-- @lang('Select One') --</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @php
                            if($general->active_template == 'basic'){
                                $slider = 'slider';
                            }else{
                                $slider = 'labflixSlider';
                            }
                        @endphp
                        <div class="form-group">
                            <label>@lang('Thumbnail Image')</label>
                            <div class="image-upload">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview"
                                             style="background-image: url({{ getImage('/', getFileSize($slider)) }})">
                                            <button type="button" class="remove-image"><i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1"
                                               accept=".png, .jpg, .jpeg" required>
                                        <label for="profilePicUpload1" class="bg--success">@lang('Upload Thumbnail Image')</label>
                                        <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg, jpg, png')</b>. @lang('Image will
                                            be resized into') {{ getFileSize($slider) }}@lang('px') </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($general->active_template == 'labflix')
                        <div class="form-group caption">
                            <label>@lang('Caption Status')</label>
                            <input type="checkbox" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disable')" data-width="100%" name="caption_show">
                        </div>
                        @endif
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
    <button class="btn btn-sm btn-outline--primary addBtn"><i class="las la-plus"></i> @lang('Add New')
    </button>
@endpush
@push('script')
    <script>
        

        var modal = $('#sliderModal');
        var defautlImage = `{{ getImage(getFilePath('slider'), getFileSize('slider')) }}`;
        $('.addBtn').click(function () {
            modal.find('.modal-title').text(`@lang('Add Slider')`);
            modal.find('form').attr('action', `{{ route('admin.sliders.add') }}`);
            modal.find('.itemGroup').show();
            modal.find('.statusGroup').hide();
            modal.find('input[name=caption_show]').bootstrapToggle('off');
            modal.modal('show');
            $(".item-list").select2({
                ajax: {
                url: "{{ route('admin.item.list') }}",
                type: "get",
                dataType: 'json',
                delay: 1000,
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page,
                        rows: 5,
                    };
                },
                processResults: function (response, params) {
                    params.page = params.page || 1;
                    return {
                        results: response,
                        pagination: {
                            more: params.page < response.length
                        }
                    };
                },
                cache: false
            },
                
            dropdownParent: modal });
        });
        $('.editBtn').click(function () {
            modal.find('.modal-title').text(`@lang('Update Slider')`);
            modal.find('.itemGroup').hide();
            modal.find('.profilePicPreview').attr('style', `background-image: url(${$(this).data('image')})`);
            modal.find('form').attr('action', `{{ route('admin.sliders.update', '') }}/${$(this).data('id')}`);

            modal.find('.statusGroup').show();
            var caption = $(this).data('caption');
            var status = $(this).data('status');
            if(caption == 1){
                modal.find('input[name=caption_show]').bootstrapToggle('on');
            }else{
                modal.find('input[name=caption_show]').bootstrapToggle('off');
            }
            if(status == 1){
                modal.find('input[name=status]').bootstrapToggle('on');
            }else{
                modal.find('input[name=status]').bootstrapToggle('off');
            }
            modal.modal('show');
        });
        
        modal.on('hidden.bs.modal', function () {
            modal.find('.profilePicPreview').attr('style', `background-image: url(${defautlImage})`);
            $('#sliderModal form')[0].reset();
        });

    </script>
@endpush