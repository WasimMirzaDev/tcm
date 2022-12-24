@extends('frontend.eventlayout.app')

@section('content')
     <main id="MainContent" class="content-for-layout">
            <div class="cart-page mt-100">
                <div class="container">
                    <div class="cart-page-wrapper">
                        @if ($carts && count($carts) > 0)
                        <div class="row">
                            <div class="col-lg-7 col-md-12 col-12">
                                <table class="cart-table w-100">
                                    <thead>
                                      <tr>
                                        <th class="cart-caption heading_18">Product</th>
                                        <th class="cart-caption heading_18"></th>
                                        <th class="cart-caption text-center heading_18 d-none d-md-table-cell">Quantity</th>
                                        <th class="cart-caption text-end heading_18">Price</th>
                                      </tr>
                                    </thead>
                        
                                    <tbody>
                                          @php
                                        $total = 0;
                                        @endphp
                                        @foreach ($carts as $key => $cartItem)
                                        @php
                                            $product = \App\Models\Product::find($cartItem['product_id']);
                                            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                            // $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                            $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];
                                            $product_name_with_choice = $product->getTranslation('name');
                                            if ($cartItem['variation'] != null) {
                                                $product_name_with_choice = $product->getTranslation('name') . ' - ' . $cartItem['variation'];
                                            }
                                        @endphp
                                        <tr class="cart-item">
                                          <td class="cart-item-media">
                                            <div class="mini-img-wrapper">
                                                <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                            class="img-fit size-60px mini-img"
                                                            alt="{{ $product->getTranslation('name') }}">
                                            </div>                                    
                                          </td>
                                          <td class="cart-item-details">
                                             <span class="fs-14 opacity-60">{{ $product_name_with_choice }}</span>                            
                                          </td>
                                          <td class="cart-item-quantity">
                                            <div class="quantity d-flex align-items-center justify-content-between aiz-plus-minuz">
                                                
                                                <button  class="qty-btn dec-qty" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">-</button>
                                                                
                                                <input class="qty-input input-number" type="number" name="quantity[{{ $cartItem['id'] }}]" value="{{ $cartItem['quantity'] }}"
                                                                min="{{ $product->min_qty }}"
                                                                max="{{ $product_stock->qty }}"
                                                                onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                <button class="qty-btn inc-qty"  type="button" data-type="plus"
                                                                data-field="quantity[{{ $cartItem['id'] }}]">+</button>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            <a href="javascript:void(0)"
                                                        onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="product-remove mt-2">Remove</a>                           
                                          </td>
                                          <td class="cart-item-price text-end">
                                          <span class="fw-600 fs-16">{{ cart_product_price($cartItem, $product, true, false) }}</span>                        
                                          </td>                        
                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                  </table>
                            </div>
                            <div class="col-lg-5 col-md-12 col-12">
                                <div class="cart-total-area">
                                    <h3 class="cart-total-title d-none d-lg-block mb-0">Cart Totals</h4>
                                    <div class="cart-total-box mt-4">
                                        <div class="subtotal-item subtotal-box">
                                            <h4 class="subtotal-title">Subtotals:</h4>
                                            <p class="subtotal-value">{{ single_price($total) }}</p>
                                        </div>
                                        <div class="subtotal-item shipping-box">
                                            <h4 class="subtotal-title">Shipping:</h4>
                                            <p class="subtotal-value">$0</p>
                                        </div>
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Discount:</h4>
                                            <p class="subtotal-value">$0</p>
                                        </div>
                                        <hr />
                                        <div class="subtotal-item discount-box">
                                            <h4 class="subtotal-title">Total:</h4>
                                            <p class="subtotal-value">{{ single_price($total) }}</p>
                                        </div>
                                        <p class="shipping_text">Shipping & taxes calculated at checkout</p>
                                        <div class="text-center mt-4">
                                            @if (Auth::check())
                                            <a href="{{ route('checkout.shipping_info') }}" class="position-relative btn-primary text-uppercase">
                                                Procced to checkout
                                            </a>
                                            @else 
                                            <a class="position-relative btn-primary text-uppercase" href="{{route('login')}}">Login</a><br>
                                        <p class="shipping_text">Login to Proceed Further</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          @else
                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <div class="shadow-sm bg-white p-4 rounded">
                            <div class="text-center p-3">
                                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                                <h3 class="h4 fw-700">{{ translate('Your Cart is empty') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
                    </div>
                </div>
            </div>            
        </main>
@endsection

    <script type="text/javascript">
 
    
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

 
        function showCheckoutModal() {
            alert("hello");
            $('#login-modal').modal();
        }

        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if (country.iso2 == 'bd') {
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)); @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if (selectedCountryData.iso2 == 'bd') {
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            } else {
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>

