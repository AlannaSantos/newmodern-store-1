@foreach ($brands as $brand)
    <div class="col-md-12">

        <div class="row">

            <div class="col-md-4">
                <img data-echo="{{ $brand->brand_image }}">
            </div>

        </div>

    </div>
@endforeach
