@extends('layouts.app')

@push('title')
   ادارة التصنيفات
@endpush


@push('pg_btn')
    @can('create-category')
        <a href="{{ route('category.create') }}" class="btn btn-sm btn-neutral">اضافة تصنيف جديد</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">جميع التصنيفات</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <livewire:category-table/>

                    {{--      <div class="table-responsive">
                              <div>
                                  <table class="table table-hover align-items-center">
                                      <thead class="thead-light">
                                      <tr>
                                          <th scope="col">Name</th>
                                          <th scope="col">Added by</th>
                                          <th scope="col">Status</th>
                                          <th scope="col">Created at</th>
                                          <th scope="col" class="text-center">Action</th>
                                      </tr>
                                      </thead>
                                      <tbody class="list">
                                      @foreach($categories as $category)
                                          <tr>
                                              <th scope="row">
                                                  {{$category->category_name}}
                                              </th>
                                              <td class="budget">
                                                  {{$category->user->name}}
                                              </td>
                                              <td>
                                                  @if($category->status)
                                                      <span class="badge badge-pill badge-lg badge-success">Active</span>
                                                  @else
                                                      <span class="badge badge-pill badge-lg badge-danger">Disabled</span>
                                                  @endif
                                              </td>
                                              <td>
                                                  {{$category->created_at->diffForHumans()}}
                                              </td>
                                              <td class="text-center">
                                                  @can('destroy-category')
                                                  {!! Form::open(['route' => ['category.destroy', $category],'method' => 'delete',  'class'=>'d-inline-block dform']) !!}
                                                  @endcan

                                                  @can('update-category')
                                                  <a class="btn btn-primary btn-sm m-1" href="{{route('category.edit',$category)}}">
                                                      <i class="fa fa-edit"></i>
                                                  </a>
                                                  @endcan
                                                  @can('destroy-category')
                                                      <button type="submit" class="btn delete btn-primary btn-sm m-1">
                                                          <i class="fas fa-trash"></i>
                                                      </button>
                                                  {!! Form::close() !!}
                                                  @endcan
                                              </td>
                                          </tr>
                                      @endforeach
                                      </tbody>
                                      <tfoot >
                                      <tr>
                                          <td colspan="6">
                                              {{$categories->links()}}
                                          </td>
                                      </tr>
                                      </tfoot>
                                  </table>
                              </div>
                          </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
