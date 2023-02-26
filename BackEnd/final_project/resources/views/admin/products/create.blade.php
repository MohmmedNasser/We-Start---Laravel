@push('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: '.description',
        });

        let uploadedDocumentMap = {};
        let myDropzone = new Dropzone("#dropzone", {
            url: "{{ route('admin.add_image') }}",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            addRemoveLinks: true,
            success: function (file, response) {
                // console.log(file, response);
                let img_input = `<input type="hidden" name="album[]" value="${response}">`;
                document.querySelector('.gallery-wrap').insertAdjacentHTML('beforeend', img_input);
                uploadedDocumentMap[file.name] = response;
                // console.log(uploadedDocumentMap);
            },
            removedfile: function (file) {
                file.previewElement.remove();
                let name = uploadedDocumentMap[file.name];
                document.querySelector('input[name="album[]"][value="' + name + '"]').remove();
            }


        });

        Dropzone.autoDiscover = false;

        let btns = document.querySelectorAll('.add_feild');
        btns.forEach(function (btn) {
            btn.addEventListener('click', function (e){
                e.preventDefault();
                let type = this.dataset.type;
                let el_wrap = document.querySelectorAll(`.${type}-wrap .row`);
                let index = el_wrap.length;
                let tempalte = `
                    <div class="row mb-2">
                        <div class="col-lg-8 mb-3 mb-lg-0">
                            <input type="text" name="variation[${type}s][${index}][value]" class="form-control" placeholder="Value"/>
                        </div>
                        <div class="col-lg-4 mb-3 mb-lg-0">
                            <input type="text" name="variation[${type}s][${index}][price]" class="form-control" placeholder="Price"/>
                        </div>
                    </div>
                    `;

                let wrapper = document.querySelector(`.${type}-wrap`);
                wrapper.insertAdjacentHTML('beforeend', tempalte);

            })
        })


    </script>

@endpush

<x-admin-layout title="Create product">
    <div class="card card-docs mb-2">
        <div class="card-header card-header-stretch">
            <!--begin::Card title-->
            <h3 class="card-title fw-bolder m-0">
                Create Product
            </h3>
            <!--end::Card title-->
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                    <li class="nav-item">
                        <a class="nav-link text-gray-900 active" data-bs-toggle="tab" href="#basic_Data">
                            Basic Data
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray-900" data-bs-toggle="tab" href="#image">
                            Image
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-gray-900" data-bs-toggle="tab" href="#variations">
                            Variations
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 mb-5">
                        <x-errors />
                    </div>
                </div>


                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="basic_Data" role="tabpanel">

                        <div class="row">

                            <div class="col-lg-6 mb-5">
                                <label class="form-label">Arabic Name</label>
                                <input type="text" name="ar_name" class="form-control" placeholder="Arabic Name"/>
                            </div>

                            <div class="col-lg-6 mb-5">
                                <label class="form-label">English Name</label>
                                <input type="text" name="en_name" class="form-control" placeholder="English Name"/>
                            </div>

                            <div class="col-lg-4 mb-5">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Price"/>
                            </div>

                            <div class="col-lg-4 mb-5">
                                <label class="form-label">Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity"/>
                            </div>

                            <div class="col-lg-4 mb-5">
                                <label class="form-label">Category </label>
                                <select class="form-select" name="category_id" data-control="select2" data-placeholder="Parent ">
                                    <option></option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->trans_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mb-5">
                                <label class="form-label">English Small Description</label>
                                <textarea name="en_smalldesc" class="form-control" rows="4" placeholder="English Small Description"></textarea>
                            </div>

                            <div class="col-lg-6 mb-5">
                                <label class="form-label">Arabic Small Description</label>
                                <textarea name="ar_smalldesc" class="form-control" rows="4" placeholder="Arabic Small Description"></textarea>
                            </div>

                            <div class="col-lg-6 mb-5">
                                <label class="form-label">English Description</label>
                                <textarea name="en_desc" class="form-control description" placeholder="English Small Description"></textarea>
                            </div>

                            <div class="col-lg-6 mb-5">
                                <label class="form-label">Arabic Description</label>
                                <textarea name="ar_desc" class="form-control description" placeholder="Arabic Small Description"></textarea>
                            </div>


                            <div class="col-12 mb-5">
                                <div class="form-check form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input" id="featured" value="1" name="featured" type="checkbox" />
                                    <label class="form-check-label fw-bold" for="featured">
                                        Featured
                                    </label>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="image" role="tabpanel">

                        <div class="row">
                            <div class="col-12 mb-5">
                                <div>
                                    <label class="form-label">Image </label>
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
                                <div>
                                    <label class="form-label">gallery </label>
                                </div>
                                <div class="dropzone" id="dropzone">
                                    <div class="dz-message">
                                            Upload Product Images
                                    </div>
                                </div>
                                <div class="gallery-wrap">

                                </div>
                            </div>




                        </div>

                    </div>
                    <div class="tab-pane fade" id="variations" role="tabpanel">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <label class="form-label">Colors :</label>

                                <div class="color-wrap">
{{--                                    <div class="row mb-2">--}}
{{--                                        <div class="col-lg-8 mb-3 mb-lg-0">--}}
{{--                                            <input type="text" name="variation[colors][0][value]" class="form-control" placeholder="Value"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-4 mb-3 mb-lg-0">--}}
{{--                                            <input type="text" name="variation[colors][0][price]" class="form-control" placeholder="Price"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>

                                <button type="button" class="btn btn-light-primary btn-sm mt-3 add_feild" data-type="color">ADD</button>

                            </div>

                            <div class="col-12 mb-5">
                                <label class="form-label">Sizes :</label>
                                <div class="size-wrap">
{{--                                    <div class="row mb-2">--}}
{{--                                        <div class="col-lg-8 mb-3 mb-lg-0">--}}
{{--                                            <input type="text" name="variation[sizes][0][value]" class="form-control" placeholder="Value"/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-4 mb-3 mb-lg-0">--}}
{{--                                            <input type="text" name="variation[sizes][0][price]" class="form-control" placeholder="Price"/>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                                <button type="button" class="btn btn-light-primary btn-sm mt-3 add_feild" data-type="size">ADD</button>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-end mt-5">
                    <button type="submit" class="btn btn-primary px-10">حفظ</button>
                </div>

            </form>

        </div>
    </div>
</x-admin-layout>
