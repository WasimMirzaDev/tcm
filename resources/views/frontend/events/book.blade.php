@extends('frontend.eventlayout.app')

@section('content')
<main id="MainContent" class="content-for-layout">
            <div class="contact-page">
                <!-- about banner start -->
                <div class="contact-form-section mt-100">
                    <!--<div class="container text-center" >-->
                    <!--    <div class="contact-form-area">-->
                    <!--        <div class="section-header mb-4">-->
                    <!--            <h2 class="section-heading">Book Your Event</h2>-->
                    <!--            <p class="section-subheading">We would like to hear from you.</p>-->
                    <!--        </div>-->
                    <!--        <div class="checkout-progress overflow-hidden text-center">-->
                    <!--                <ol class="checkout-bar px-0 d-flex justify-content-center">-->
                    <!--                    <li class="progress-step step-done"><a href="cart.html">Your Details</a></li>-->
                    <!--                    <li class="progress-step step-todo"><a href="checkout.html">Payment</a></li>-->
                    <!--                </ol>-->
                    <!--            </div>-->
                    <!--        <div class="contact-form--wrapper mt-3" style="margin: 0 auto;">-->
                    <!--            <h2 class="shipping-address-heading pb-1">Enter Your Details</h2>-->
                    <!--            <form action="{{ url("process-transaction")}}" method="post" class="contact-form mt-3" >-->
                    <!--                @csrf()-->
                    <!--                <div class="row">-->
                    <!--                    <div class="col-lg-6 col-md-12 col-12">-->
                    <!--                        <fieldset>-->
                    <!--                            <label class="label fs-14 w-100 text-left">Full name</label>-->
                    <!--                            <input type="text" class="mt-2 mb-2" placeholder="Full name" name="username">-->
                    <!--                        </fieldset>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-lg-6 col-md-12 col-12">-->
                    <!--                        <fieldset>-->
                    <!--                            <label class="label fs-14 w-100 text-left">Email Address*</label>-->
                    <!--                            <input type="email" class="mt-2 mb-2" placeholder="Email Address*" name="email">-->
                    <!--                        </fieldset>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-lg-6 col-md-12 col-12">-->
                    <!--                        <fieldset>-->
                    <!--                            <label class="label fs-14 w-100 text-left">Discord ID</label>-->
                    <!--                            <input type="text" class="mt-2 mb-2" placeholder="Discord ID" name="discardid">-->
                    <!--                        </fieldset>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-lg-6 col-md-12 col-12">-->
                    <!--                        <fieldset>-->
                    <!--                            <label class="label fs-14 w-100 text-left">Game ID</label>-->
                    <!--                            <input type="text" class="mt-2 mb-2" placeholder="Game ID" name="gameid">-->
                    <!--                        </fieldset>-->
                    <!--                    </div>-->
                    <!--                    <div class="col-lg-12 col-md-12 col-12">-->
                    <!--                        <fieldset>-->
                    <!--                            <label class="label fs-14 w-100 text-left">Message</label>-->
                    <!--                            <textarea class="mt-2 mb-2"  cols="20" rows="6" placeholder="Write your message here*"></textarea>-->
                    <!--                        </fieldset>-->
                    <!--                        <button type="submit" class="position-relative review-submit-btn contact-submit-btn">Book Now</button>-->
                    <!--                    </div>-->
                    <!--                </div>                                    -->
                    <!--            </form>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    
                    
                    <!--Code To Ext-->
                    
                    
                    @auth
                     <div class="container text-center">
                              <div class="panel contact-form-area">
                                  @if (\Session::has('message'))
                                        <div class="alert alert-success">
                                            <ul>
                                                <li>{!! \Session::get('message') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    
                                  @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{!! \Session::get('error') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                   <div class="section-header mb-4">
                                        <h2 class="section-heading">Book Your Event</h2>
                                        <p class="section-subheading">We would like to hear from you.</p>
                                    </div>
                                <div class="panel-body wizard-content">
                                <form id="example-form"  action="{{ url("process-transaction")}}" method="post" class="tab-wizard wizard-circle wizard clearfix contact-form mt-3">
                                    @csrf()
                                    
                                    <input type="hidden" class="mt-2 mb-2" placeholder="Full name" name="event_id" value="{{$id}}">
                                    <input type="hidden" class="mt-2 mb-2" placeholder="Full name" name="event_name" value="{{$events[0]->title}}">
                                    <input type="hidden" class="mt-2 mb-2" placeholder="Full name" name="price" value="{{$events[0]->price}}">
                                    <h6>User Details</h6>
                                    <section>
                                      <br/>
                                      <div class="row">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label class="label fs-14 w-100 text-left">Full name</label>
                                                <input type="text" class="mt-2 mb-2" placeholder="Full name" name="username">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label class="label fs-14 w-100 text-left">Email Address*</label>
                                                <input type="email" class="mt-2 mb-2" placeholder="Email Address*" name="email">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label class="label fs-14 w-100 text-left">Discord ID</label>
                                                <input type="text" class="mt-2 mb-2" placeholder="Discord ID" name="discard_id">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label class="label fs-14 w-100 text-left">Game ID</label>
                                                <input type="text" class="mt-2 mb-2" placeholder="Game ID" name="game_id">
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <fieldset>
                                                <label class="label fs-14 w-100 text-left">Message</label>
                                                <textarea class="mt-2 mb-2"  cols="20" name="msg" rows="6" placeholder="Write your message here*"></textarea>
                                            </fieldset>
                                            <!--<button type="submit" class="position-relative review-submit-btn contact-submit-btn">Book Now</button>-->
                                        </div>
                                    </div>   
                                        
                                        
                                     
                                    </section>
                                 
                                    <h6>Payment Details</h6>
                                    <section>
                                 <div class="row justify-content-center">
                                <div style="width:200px; height:200px; display: flex;align-items: center;">
                                <input type="radio" class="mt-2 mb-2" placeholder="Email Address*" name="email" checked>     
                                <img class="ml-3" src="https://cdn.pixabay.com/photo/2015/05/26/09/37/paypal-784404_960_720.png"  style="margin-left:30px" width="100%">        
                                </div>    
                                </div>
                                </section>
                                    
                                </form>
                                  </div>
                              </div>
                            </div>
                    @endauth
                    @guest
                    <div class="text-center">Please Login for event booking <a href="{{ url("login?event=".$id)}}">Login</a></div>	
					@endguest
                    
                    
                    
                    <!--Code To Ext-->
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                <!-- about banner end -->
            </div>            
        </main>
@endsection
