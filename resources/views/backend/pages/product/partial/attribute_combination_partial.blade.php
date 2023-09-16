<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 remove_combinations">
    @if (!empty($combinations))
        @foreach ($combinations as $key => $combination)
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="visibility" name="visibility[]">
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="row">
                    @php
                    $combinationData = "";
                    if(is_array($combination)){
                        $combinationData = implode("-", $combination);
                    }else{
                        $combinationData = $combination;
                    }
                        
                    @endphp
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input type="text" class="form-control" id="combination" name="combination[]"
                        value="{{ $combinationData }}" readonly>
                    </div>
                </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <input type="number" class="form-control" id="combination_quantity" name="combination_quantity[]" value="">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <input type="number" step="any" class="form-control" id="combination_price" name="combination_price[]" value="">
                </div>
                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                    <input type="number" step="any" class="form-control" id="combination_sku" name="combination_sku[]" value="">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <input value="" type="file"
                        class="form-control"
                        onchange="readURL(this)" id="combination_image"
                        name="combination_image[]" style="padding: 9px; cursor: pointer">
                    <img class="img-thumbnail" style="display:none; height: 100px !important;"
                            id="img" src="#"
                            alt="your combination_image"/>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                    <a href="#">
                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="24px" height="30px">    
                            <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/>
                        </svg>
                    </a>
                </div>
            </div>        
        @endforeach
    @endif
    
</div>