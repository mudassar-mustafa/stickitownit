<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-lg-12 col-xl-12">
        <div class="card" style="border-radius: 10px;">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0" style="color: #73c100;">Product Details</p>
                    <p class="small text-muted mb-0">Order# {{ $order->id }}</p>
                </div>
                @php
                $shippingFee = 0;
                @endphp
                @if ($order->order_type == 'Sale')
                @foreach ($order->order_sale_details as $order_detail)
                @php
                $shippingFee += $order_detail->shipping;
                @endphp
                <div class="card shadow-0 border mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mt-2">
                                <img src="{{ $order_detail->product_image }}" class="img-fluid"
                                    alt="{{ $order_detail->product_title }}">
                            </div>
                            <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0">
                                    {{ $order_detail->product_title }}
                                    @if ($order_detail->product_type == "variation")
                                    <small>{{ $order_detail->product_short_description }}</small>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">Qty: {{ $order_detail->qty }}</p>
                            </div>
                            <div class="col-md-3 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">Price: ${{ $order_detail->price }}</p>
                            </div>
                        </div>
                        <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                        @if ($order->order_status != "cancelled")
                        <div class="row d-flex align-items-center">
                            <div class="col-md-2">
                                <p class="text-muted mb-0 small">Track Order</p>
                            </div>
                            <div class="col-md-10">
                                @php
                                $progressBar = 100;
                                if($order->order_status == "pending"){
                                $progressBar = 0;
                                }else if($order->order_status == "printed"){
                                $progressBar = 50;
                                }
                                @endphp
                                <div class="progress" style="height: 6px; border-radius: 16px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $progressBar }}%; border-radius: 16px; background-color: #a8729a;"
                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <p class="text-muted mt-1 mb-0 small">Pending</p>
                                    <p class="text-muted mt-1 mb-0 small">Printed</p>
                                    <p class="text-muted mt-1 mb-0 small">Delivered</p>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                @endforeach
                @endif

                <div class="container-fluid">
                  <p class="fw-bold mb-0" style="color: #73c100;">Order Details</p>
                  <div class="row">
                    <div class="col-lg-3">
                      <p class="text-muted ">Order Date:</p>
                    </div>
                    <div class="col-lg-3">
                      <p class="fw-bold"> {{ date("d M Y", strtotime($order->order_date))  }}</p>
                    </div>

                    <div class="col-lg-4">
                      <span class="text-muted d-flex justify-content-end">Total:</span>
                    </div>
                    <div class="col-lg-2">
                      <p class="fw-bold d-flex justify-content-end">${{ $order->order_total_amount }}</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3">
                      <p class="text-muted">Payment Type:</p>
                    </div>
                    <div class="col-lg-3">
                      <p class="fw-bold"> {{ $order->payment_method }}</p>
                    </div>

                    <div class="col-lg-4">
                      <p class="text-muted d-flex justify-content-end">Tax:</p>
                    </div>
                    <div class="col-lg-2">
                      <p class="fw-bold d-flex justify-content-end">$0</p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3">
                      <p class="text-muted">Shipping Charges:</p>
                    </div>
                    <div class="col-lg-3">
                      <p class="fw-bold"> ${{ $shippingFee }}</p>
                    </div>

                    <div class="col-lg-4">
                      <p class="text-muted d-flex justify-content-end">Order Status:</p>
                    </div>
                    <div class="col-lg-2">
                      <p class="fw-bold d-flex justify-content-end">{{ $order->order_status }}</p>
                    </div>
                  </div>
                </div>
                <hr></hr>
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-6">
                      <p class="fw-bold mb-0" style="color: #73c100;">Shipping Detail</p>
                      <p class="text-muted mb-0">{{ $order->order_sale_details[0]->shipping_address }},
                        {{ isset($order->order_sale_details[0]->shipping_city_detail) ? $order->order_sale_details[0]->shipping_city_detail->name : "" }},
                        {{ isset($order->order_sale_details[0]->shipping_state_detail) ? $order->order_sale_details[0]->shipping_state_detail->name : "" }},
                        {{ isset($order->order_sale_details[0]->shipping_country_detail) ? $order->order_sale_details[0]->shipping_country_detail->name : "" }}
                      </p>
                    </div>

                    <div class="col-lg-6">
                      <p class="fw-bold mb-0" style="color: #73c100;">Billing Detail</p>
                      <p class="text-muted mb-0">{{ $order->billing_address }},
                        {{ isset($order->billing_city_detail) ? $order->billing_city_detail->name : "" }},
                        {{ isset($order->billing_state_detail) ? $order->billing_state_detail->name : "" }},
                        {{ isset($order->billing_country_detail) ? $order->billing_country_detail->name :"" }}
                      </p>
                    </div>
                  </div>
                </div>
                
                <!-- <div class="d-flex justify-content-between pt-5">
                    <p class="fw-bold mb-0">Shipping Detail</p>
                    <p class="fw-bold mb-0">Billing Detail</p>
                </div>

                <div class="d-flex justify-content-between mb-5">
                    <p class="text-muted mb-0">{{ $order->order_sale_details[0]->shipping_address }},
                        {{ isset($order->order_sale_details[0]->shipping_city_detail) ? $order->order_sale_details[0]->shipping_city_detail->name : "" }},
                        {{ isset($order->order_sale_details[0]->shipping_state_detail) ? $order->order_sale_details[0]->shipping_state_detail->name : "" }},
                        {{ isset($order->order_sale_details[0]->shipping_country_detail) ? $order->order_sale_details[0]->shipping_country_detail->name : "" }}
                    </p>

                    <p class="text-muted mb-0">{{ $order->billing_address }},
                        {{ isset($order->billing_city_detail) ? $order->billing_city_detail->name : "" }},
                        {{ isset($order->billing_state_detail) ? $order->billing_state_detail->name : "" }},
                        {{ isset($order->billing_country_detail) ? $order->billing_country_detail->name :"" }}
                    </p>
                </div> -->

            </div>




            <div class="card-footer border-0 px-4"
                style="background-color: #73c100; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                    paid: <span class="h2 mb-0 ms-2 fw-bold">${{ $order->order_total_amount }}</span></h5>
            </div>
        </div>
    </div>
</div>