@push('scripts')
    <script>
        function edit_category(id) {
            {{--console.log(`{{ route("admin.categories.index") }}/${id}`);--}}
            {{--let url = '{{ route("admin.categories.index") }}/'+id;--}}
            let url = "{{route('admin.coupons.show', '')}}"+"/"+id;
            $.get({
                url,
                success: (res) => {
                    console.log(res.name)
                    $('#editModal form').attr('action', url)
                    $('#editModal input[name=en_name]').val(res.en_name)
                    $('#editModal input[name=ar_name]').val(res.ar_name)
                    $('#editModal input[name=code]').val(res.code)
                    $('#editModal select[name=type]').val(res.type)
                    $('#editModal input[name=value]').val(res.value)
                    $('#editModal input[name=expire]').val(res.expire)
                    $('#editModal input[name=usage]').val(res.usage)
                    $('#editModal select[name=product_id]').val(res.parent_id);
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
                    $('#row_'+res.id+' td:nth-child(3)').text(res.code);
                    $('#row_'+res.id+' td:nth-child(4)').text(res.usage);
                    $('#row_'+res.id+' td:nth-child(5)').text(res.expire);

                    $('#editModal').modal('hide')
                }
            })
        })


    </script>

@endpush

<x-admin-layout title="All category">

    @if (session('msg'))
    <div class="alert alert-{{ session('type' )}}">
        {{ session('msg')  }}
    </div>
    @endif

    <div class="card card-docs mb-2">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">All coupons</h3>
            </div>
            <!--end::Card title-->

            <div class="card-toolbar">
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-md btn-primary">
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


            <table id="kt_datatable_example_1"
                   class="table align-middle table-row-dashed fs-6 gy-5 custom-table">
                <thead>
                <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Code
                    </th>
                    <th>
                        Usage
                    </th>
                    <th>
                        Expire
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
                </thead>
                <tbody class="text-gray-800 text-center fw-bold">
                @foreach($coupons as $coupon)
                    <tr id="row_{{ $coupon->id }}">
                        <td>
                            {{  $loop->iteration }}
                        </td>
                        <td>
                            {{ $coupon->trans_name }}
                        </td>
                        <td>
                            {{ $coupon->code }}
                        </td>
                        <td>
                            {{ $coupon->usage }}
                        </td>
                        <td>
                            {{ $coupon->expire }}
                        </td>
                        <td>

                            <a  class="btn btn-primary btn-icon mx-2" onclick="edit_category({{ $coupon->id }})" data-id="{{ $coupon->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                <div class="svg-icon svg-icon-2">
                                    <svg width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6ZM19.3 8.925l-4.25-4.2L17.875 1.9L22.1 6.125ZM3 21v-4.25l10.6-10.6l4.25 4.25L7.25 21ZM14.325 9.675l-.7-.7l1.4 1.4Z"/></svg>

                                </div>
                            </a>

                            <form class="d-inline" method="post" action="{{ route('admin.coupons.destroy', $coupon->id) }}">
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
            {{ $coupons->links() }}
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="edit_form" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h3 class="modal-title">Edit Coupons</h3>
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
                                <label class="form-label">
                                    Code
                                </label>
                                <input type="text" name="code" class="form-control" placeholder="Code">
                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">
                                    Type
                                </label>
                                <select class="form-select" name="type" data-control="select2" data-placeholder="Type">
                                    <option value="value">Value</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">
                                    Value
                                </label>
                                <input type="text" name="value" class="form-control" placeholder="Value">
                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">
                                    Expire
                                </label>
                                <input type="text" name="expire" class="form-control" placeholder="Expire">
                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">
                                    Usage
                                </label>
                                <input type="text" name="usage" class="form-control" placeholder="Usage">
                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">
                                    Product
                                </label>
                                <select class="form-select" name="product_id" data-control="select2" data-placeholder="Type">

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
