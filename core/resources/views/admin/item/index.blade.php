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
                                <th scope="col">@lang('Title')</th>
                                <th scope="col">@lang('Category')</th>
                                <th scope="col">@lang('Sub Category')</th>
                                <th scope="col">@lang('Item Type')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td data-label="@lang('Title')">{{ $item->title }}</td>
                                    <td data-label="@lang('Category')">{{ $item->category->name }}</td>
                                    <td data-label="@lang('Sub Category')">{{ @$item->sub_category->name ?? 'N/A' }}</td>
                                    <td data-label="@lang('Item Type')">
                                        @if($item->item_type == 1)
                                            <span class="badge badge--success">@lang('Single Item')</span>
                                        @elseif($item->item_type == 2)
                                            <span class="badge badge--primary">@lang('Episode Item')</span>
                                        @else
                                            <span class="badge badge--warning">@lang('Trailer')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status == 1)
                                            <span class="badge badge--success">@lang('Active')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Deactive')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('')Action">
                                        <a href="{{ route('admin.item.edit',$item->id) }}"
                                           class="btn btn-sm btn-outline--primary">
                                            <i class="la la-pencil"></i>@lang('Edit')
                                        </a>
                                        @if($item->item_type == 2)
                                            <a href="{{ route('admin.item.episodes',$item->id) }}"
                                               class="btn btn-sm btn-outline--success">
                                                <i class="las la-list"></i>@lang('Episodes')
                                            </a>
                                        @else
                                            @if($item->video)
                                                <a href="{{ route('admin.item.updateVideo',$item->id) }}"
                                                   class="btn btn-sm btn-outline--info">
                                                   <i class="las la-cloud-upload-alt"></i>@lang('Update Video')
                                                </a>
                                            @else
                                                <a href="{{ route('admin.item.uploadVideo',$item->id) }}"
                                                   class="btn btn-sm btn-outline--warning">
                                                   <i class="las la-cloud-upload-alt"></i>@lang('Upload Video')
                                                </a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">@lang('Item Not Found')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($items) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
<div class="d-flex flex-wrap justify-content-end search-group">
    <form action="" method="GET" class="form-inline">
        <div class="input-group justify-content-end">
            <input type="text" name="search" class="form-control bg--white" placeholder="@lang('Title or Category')" value="{{ request()->search }}">
            <button class="btn btn--primary input-group-text" type="submit"><i class="fa fa-search"></i></button>
        </div>
    </form>
    <a href="{{ route('admin.item.create') }}" class="btn btn-outline--primary ms-2"><i class="la la-plus"></i>@lang('Add New')</a>
</div>
@endpush
