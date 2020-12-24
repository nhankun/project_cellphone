<div class="card-header p-0 pt-1 border-bottom-0">
    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-three-home-tab" data-url="{{ route("products.index") }}" onclick="loadForm(this)" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Thông tin cơ bản</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-tabs-three-messages-tab" data-url="{{ route("images.index") }}" onclick="loadForm(this)" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Hình ảnh</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Khuyến mãi</a>
        </li>
    </ul>
</div>
