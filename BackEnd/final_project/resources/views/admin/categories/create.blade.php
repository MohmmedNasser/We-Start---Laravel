<x-admin-layout title="Create category">
    <div class="card card-docs mb-2">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0"> Create Categories </h3>
            </div>
            <!--end::Card title-->

        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-12 mb-5">
                        <x-errors />
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Arabic Name</label>
                        <input type="text" name="ar_name" class="form-control" placeholder="Arabic Name"/>
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">English Name</label>
                        <input type="text" name="en_name" class="form-control" placeholder="English Name"/>
                    </div>


                    <div class="col-lg-12 mb-5">
                        <label class="form-label">Image </label>
                        <div>
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('./assets/images/default-image.png') }})">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('./assets/images/default-image.png') }})"></div>
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
                    </div>

                    <div class="col-lg-12 mb-5">
                        <label class="form-label">Parent </label>
                        <select class="form-select" name="parent_id" data-control="select2" data-placeholder="Parent ">
                            <option></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->trans_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button class="btn btn-primary px-10">حفظ</button>
                </div>

            </form>

        </div>
    </div>
</x-admin-layout>
