@extends('layouts.admin')

@section('page-title', 'Cập nhật danh mục')

@section('content')
    <form action="">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" placeholder="Nhập tên danh mục">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả danh mục</label>
                            <textarea name="category_description" class="form-control" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Từ khóa danh mục</label>
                            <textarea name="category_keywords" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-select" name="category">
                                <option disabled selected>Chọn danh mục cha</option>
                                <option value="">Con người Việt Nam</option>
                                <option value="">Ngày lễ và những trải nghiệm</option>
                                <option value="">Tin tức thị trường</option>
                                <option value="">63 Tỉnh thành</option>
                                <option value="">Ẩm thực - Du lịch</option>
                                <option value="">Blog</option>
                                <option value="">Âm thanh - Hình ảnh</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="text-center">
        <button class="btn btn-primary shadow">Cập nhật</button>
    </div>
@endsection
