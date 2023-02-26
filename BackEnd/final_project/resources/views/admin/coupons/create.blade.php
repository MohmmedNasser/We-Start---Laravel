<x-admin-layout title="Create coupon">
    <div class="card card-docs mb-2">
        <div class="card-header">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0"> Create Coupons </h3>
            </div>
            <!--end::Card title-->

        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.coupons.store') }}" enctype="multipart/form-data">
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

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Code"/>
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-control">
                            <option value="value">Value</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Value</label>
                        <input type="text" name="value" class="form-control" placeholder="Value"/>
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Expire</label>
                        <input type="date" name="expire" class="form-control" placeholder="Expire"/>
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Usage</label>
                        <input type="number" name="usage" class="form-control" placeholder="Usage"/>
                    </div>

                    <div class="col-lg-6 mb-5">
                        <label class="form-label">Product</label>
                        <select name="product_id" class="form-control">
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
