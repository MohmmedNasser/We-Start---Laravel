

<x-admin-layout title="All product">

    <div class="alert alert-{{ session('type' )}}">
        {{ session('msg')  }}
    </div>

    <div class="card card-docs mb-2">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">All Product</h3>
            </div>
            <!--end::Card title-->

            <div class="card-toolbar">
                <a href="{{ route('admin.products.create') }}" class="btn btn-md btn-primary">
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
                            Category
                        </th>
                        <th>
                            Created At
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-center fw-bold">
                    @foreach($products as $product)
                    <tr id="row_{{ $product->id }}">
                        <td>
                            {{  $loop->iteration }}
                        </td>
                        <td>
                            {{ $product->trans_name }}
                        </td>
                        <td>
                            <!-- json_decode => convert json code to array index -->
                            {{-- {{ json_decode($product->name, true)['ar'] }} --}}
                            {{ $product->ar_name }}
                            {{-- {{  $product->name }}--}}
                        </td>
                        <td>
                            <!-- json_decode => convert json code to array index -->
                            {{--  {{ json_decode($product->name, true)['en'] }} --}}
                            {{ $product->en_name }}
                            {{-- {{  $product->name }}--}}
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="symbol symbol-50px">
                                    <img src="{{ asset($product->image->path ?? '') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </td>
                        <td>
                            {{  $product->category->trans_name }}
                        </td>
                        <td>
                            {{ $product->created_at }}
                        </td>
                        <td>

                            <a href="{{ route('admin.products.edit', $product)}}" class="btn btn-primary btn-icon mx-2">
                                <div class="svg-icon svg-icon-2">
                                    <svg width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M5 19h1.4l8.625-8.625l-1.4-1.4L5 17.6ZM19.3 8.925l-4.25-4.2L17.875 1.9L22.1 6.125ZM3 21v-4.25l10.6-10.6l4.25 4.25L7.25 21ZM14.325 9.675l-.7-.7l1.4 1.4Z"/></svg>

                                </div>
                            </a>

                            <form class="d-inline" method="post" action="{{ route('admin.products.destroy', $product->id) }}">
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
            {{ $products->links() }}
        </div>
    </div>

</x-admin-layout>
