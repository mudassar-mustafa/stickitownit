@extends('frontend.layouts.app')
@section('title','Packages')
@push('css')
@endpush
@section('content')
    <main>

     <!-- Pricing Table Start Here  -->
     <section class="pricing__area cp-bg-19 pt-150 pb-110">
        <div class="container">
            <div class="row alin align-items-center">
                @if (!empty($packages))
                    @foreach ($packages as $package)
                        <div class="col-xl-4 col-md-6">
                            <div class="cp-plan2-item white-bg mb-40">
                            <div class="cp-plan-item-img" data-background="assets/img/plan/plan.png">
                            </div>
                            <div class="cp-plan2-header">
                                <div class="cp-plan2-icon">
                                    <i class="far fa-heart"></i>
                                </div>
                                <div class="cp-plan2-duration">
                                    <h3 class="cp-plan2-title">{{ $package->name }}</h3>
                                </div>
                            </div>
                            <div class="cp-plan2-body">
                                <div class="cp-plan2-list">
                                    <ul>
                                        <li>Tokens: {{ $package->token }}</li>
                                        <li>Package Type: {{ $package->package_type }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="cp-plan2-footer">
                                <div class="cp-plan2-price"> <sup class="cp-plan2-currency">$</sup>{{ $package->price }}</div>
                            </div>
                            <div class="cp-plan-btn">
                                <a href="javascript:void(0)" onclick="addToCart('{{ auth()->check() == true ? '1' : '0' }}', '{{ auth()->check() == true && auth()->user()->hasRole('SuperAdmin|Admin|Seller') == true ? 'admin' : 'customer' }}', '{{ $package->id }}', '{{ $package->price }}', '{{ $package->name }}', '{{ $package->token }}', '{{ $package->package_type }}')" class="cp-border-btn">Get Started Now
                                    <span class="cp-border-btn__inner">
                                        <span class="cp-border-btn__blobs">
                                        <span class="cp-border-btn__blob"></span>
                                        <span class="cp-border-btn__blob"></span>
                                        <span class="cp-border-btn__blob"></span>
                                        <span class="cp-border-btn__blob"></span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            </div>
                        </div>  
                    @endforeach
                @endif
             </div>
        </div>
     </section>
     <!-- Pricing Table End Here  -->
        @include('frontend.includes.social')
    </main>

@endsection
@push('js')
<script>
    async function addToCart(user, userType, packageId, packagePrice, packageName, packageToken, packageType) {
        if(user == "1"){
            if(userType == "admin"){
                toastr.info("Admin can't purchase package");
                return false;
            }
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            const url = '{{route("addToCartPackage")}}';
            var data = {
                'packageId': packageId,
                'packagePrice': packagePrice,
                'packageName': packageName,
                'packageToken': packageToken,
                'packageType': packageType,
                _token: csrf_token
            };
            try {
                const result = await doAjax(url, data);
                if (result['status'] == "success") {
                    window.location.href = "{{ route('checkout.index') }}";        
                } 
                else {
                }
            } catch (error) {
                console.log('Error! InsertAssignments:', error);
            }
        }else{
            window.location.href = "{{ url('/login') }}";
        }
    }
</script>
@endpush
