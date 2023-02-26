<x-admin-layout title="Settings">
    <div class="card card-docs mb-2">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0"> Settings </h3>
            </div>
            <!--end::Card title-->

        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.settings') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-12 mb-5">
                        <x-errors />
                    </div>

                    <div class="col-12 mb-5">
                        <label class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-control" placeholder="Site Name" value="{{setting('site_name')}}"/>
                    </div>

                    <div class="col-12 mb-5">
                        <label class="form-label">Logo</label>
                        <input type="file" name="logo" class="form-control"/>
                        <img src="{{ asset(setting('logo')) }}" alt="" class="img-fluid mt-4" width="150" height="150">
                    </div>

                    <div class="col-12 mb-5">
                        <label class="form-label">Social Media</label>
                        <div class="mb-2">
                            <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{setting('facebook')}}"/>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="twitter" class="form-control" placeholder="Twitter" value="{{setting('twitter')}}"/>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="linkedin" class="form-control" placeholder="LinkedIn" value="{{setting('linkedin')}}"/>
                        </div>

                    </div>



                </div>

                <div class="d-flex justify-content-end mt-5">
                    <button class="btn btn-primary px-10">حفظ</button>
                </div>

            </form>

        </div>
    </div>
</x-admin-layout>
