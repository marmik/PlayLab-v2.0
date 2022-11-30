@extends($activeTemplate.'layouts.master')
@section('content')
    <div class="card-area section--bg ptb-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card custom--card">
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                            <h4 class="card-title mb-0">
                                <i class="fa fa-table"></i> {{ __($pageTitle) }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <form  action="{{route('ticket.store')}}"  method="post" enctype="multipart/form-data" onsubmit="return submitUserForm();">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">@lang('Name')</label>
                                        <input type="text" name="name" value="{{@$user->firstname . ' '.@$user->lastname}}" class="form--control form-control-lg" placeholder="@lang('Enter your name')" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">@lang('Email address')</label>
                                        <input type="email"  name="email" value="{{@$user->email}}" class="form--control form-control-lg" placeholder="@lang('Enter your email')" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="website">@lang('Subject')</label>
                                        <input type="text" name="subject" value="{{old('subject')}}" class="form-control form--control form-control-lg" placeholder="@lang('Subject')" >
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="priority">@lang('Priority')</label>
                                        <select name="priority" class="form-control form--control form-control-lg">
                                            <option value="3" class="text-dark">@lang('High')</option>
                                            <option value="2" class="text-dark">@lang('Medium')</option>
                                            <option value="1" class="text-dark">@lang('Low')</option>
                                        </select>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="inputMessage">@lang('Message')</label>
                                        <textarea name="message" id="inputMessage" rows="6" class="form-control form--control form-control-lg">{{old('message')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-end">
                                        <button type="button" class="btn btn--default btn-sm addFile">
                                            <i class="las la-plus"></i> @lang('Add New')
                                        </button>
                                    </div>
                                    <div class="file-upload">
                                        <label class="form-label">@lang('Attachments')</label> <small class="text-danger">@lang('Max 5 files can be uploaded'). @lang('Maximum upload size is') {{ ini_get('upload_max_filesize') }}</small>
                                        <div class="position-relative">
                                            <div class="input-group">
                                                <input type="file" name="attachments[]" id="inputAttachments" class="form-control form--control custom--file-upload"/>
                                                <label for="inputAttachments">@lang('Attachments')</label>
                                            </div>
                                        </div>

                                        <div id="fileUploadsContainer"></div>
                                        <p class="ticket-attachments-message text-muted">
                                            @lang('Allowed File Extensions'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn--default w-100" type="submit" id="recaptcha" ><i class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function ($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click',function(){
                if (fileAdded >= 4) {
                    notify('error','You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="position-relative input-group my-2">
                        <input type="file" name="attachments[]" id="inputAttachments" class="form-control form--control custom--file-upload"/>
                        <button class="input-group-text remove-btn"><i class="las la-times"></i></button>
                        <label for="inputAttachments">Attachments</label>
                    </div>
                `);
            });

            $(document).on('click','.remove-btn',function(){
                fileAdded--;
                $(this).closest('.input-group').remove();
            });

        })(jQuery);
    </script>
@endpush
