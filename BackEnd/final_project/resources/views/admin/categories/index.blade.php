@push('scripts')
    <script>
        function edit_category(id) {
            {{--console.log(`{{ route("admin.categories.index") }}/${id}`);--}}
            {{--let url = '{{ route("admin.categories.index") }}/'+id;--}}
            let url = "{{route('admin.categories.show', '')}}"+"/"+id;
            $.get({
                url,
                success: (res) => {
                    console.log(res.name)
                    $('#editModal form').attr('action', url)
                    $('#editModal input[name=en_name]').val(res.en_name)
                    $('#editModal input[name=ar_name]').val(res.ar_name)
                    $('#editModal .image-input-wrapper').attr('style', `background-image: url(/${res.image.path})`);
                    $('#editModal select').val(res.parent_id);
                }
            })
        }

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();

            var data = new FormData(this);
            let url = $('#editModal form').attr('action');
            $.ajax({
                type: 'post',
                url,
                data,
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    console.log(res);
                    $('#row_'+res.id+' td:nth-child(2)').text(res.trans_name);
                    $('#row_'+res.id+' td:nth-child(5) img').attr('src', '/'+res.image.path)
                    $('#row_'+res.id+' td:nth-child(6)').text(res.parent.trans_name);

                    $('#editModal').modal('hide')
                }
            })
        })


    </script>

@endpush

<x-admin-layout title="All category">

    <div class="alert alert-{{ session('type' )}}">
        {{ session('msg')  }}
    </div>

    <div class="card card-docs mb-2">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('dash.all_categories') }}</h3>
            </div>
            <!--end::Card title-->

            <div class="card-toolbar">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-md btn-primary">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                            </svg>
                        </span>
                    <span>إضافة </span>
                </a>
            </div>


        </div>
        <div class="card-body">

            {{--                                <x-info custom="info test">--}}
            {{--                                    <p>--}}
            {{--                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, illo?--}}
            {{--                                    </p>--}}
            {{--                                </x-info>--}}

            <table id="kt_datatable_example_1"
                   class="table align-middle table-row-dashed fs-6 gy-5 custom-table">
                <thead>
                    <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                        <th>
                            ID
                        </th>
                        <th>
                            Original Name
                        </th>
                        <th>
                           Arabic Name
                        </th>
                        <th>
                            English Name
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                            Parent
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-center fw-bold">
                    @foreach($categories as $category)
                    <tr id="row_{{ $category->id }}">
                        <td>
                            {{  $loop->iteration }}
                        </td>
                        <td>
                            {{ $category->trans_name }}
                        </td>
                        <td>
                            <!-- json_decode => convert json code to array index -->
                            {{-- {{ json_decode($category->name, true)['ar'] }} --}}
                            {{ $category->ar_name }}
                            {{-- {{  $category->name }}--}}
                        </td>
                        <td>
                            <!-- json_decode => convert json code to array index -->
                            {{--  {{ json_decode($category->name, true)['en'] }} --}}
                            {{ $category->en_name }}
                            {{-- {{  $category->name }}--}}
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="symbol symbol-50px">
                                    <img src="{{ asset($category->image->path ?? '') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </td>
                        <td>
                            {{  $category->parent_id  }}
                        </td>
                        <td>

                            <a  class="btn btn-primary btn-icon mx-2" onclick="edit_category({{ $category->id }})" data-id="{{ $category->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                <div class="svg-icon svg-icon-2">
                                    <svg width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6ZM19.3 8.925l-4.25-4.2L17.875 1.9L22.1 6.125ZM3 21v-4.25l10.6-10.6l4.25 4.25L7.25 21ZM14.325 9.675l-.7-.7l1.4 1.4Z"/></svg>

                                </div>
                            </a>

                            <form class="d-inline" method="post" action="{{ route('admin.categories.destroy', $category->id) }}">
                                @csrf
                                @method('delete')
                                <button onclick="" type="submit" class="btn btn-primary btn-icon mx-2" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف">
                                    <div class="svg-icon svg-icon-2">
                                        <svg width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413Q17.825 21 17 21ZM17 6H7v13h10ZM9 17h2V8H9Zm4 0h2V8h-2ZM7 6v13Z"/></svg>
                                    </div>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="edit_form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Category</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-1"></span>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 mb-5">
                                <label class="form-label">
                                    English Name
                                </label>
                                <input type="text" name="en_name" class="form-control" placeholder="English Name"/>
                            </div>
                            <div class="col-lg-6 mb-5">
                                <label class="form-label">
                                    Arabic Name
                                </label>
                                <input type="text" name="ar_name" class="form-control" placeholder="Arabic Name"/>
                            </div>

                            <div class="col-12 mb-5">

                                <div>
                                    <label class="form-label">
                                        Image
                                    </label>
                                </div>


                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('./assets/images/default-image.png') }})">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-100px h-100px" style="background-image: url({{ asset('./assets/images/default-image.png') }})"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                           data-kt-image-input-action="change"
                                           data-bs-toggle="tooltip"
                                           data-bs-dismiss="click"
                                           title="Change Image">
                                        <i class="bi bi-pencil-fill fs-7"></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->
                                </div>
                                <!--end::Image input-->

                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">Parent </label>
                                <select class="form-select" name="parent_id" data-control="select2" data-placeholder="Parent ">
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->trans_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save_edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin-layout>
