<div class="payment">
                        <input type="hidden" id="payment_meth" value="{{old('method')}}" name="method">
                        @error('method')
                            <span class="text-danger">Vous devez choisir une méthode valide</span>
                        @enderror
                        <h3 class="title">Méthodes </h3>
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-6">
                                                        <div data-value="bank" class="single-payment @if(old('method') == 'bank') selected @endif">
                                                            <img src="{{asset('assets/images/bank_card_checkout_online shopping_payment.png')}}" alt="Banque">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div data-value="interact" class="single-payment @if(old('method') == 'interact') selected @endif">
                                                            <img class="img-fluid" src="{{asset('assets/images/interact.png')}}" alt="Interact">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div data-value="mobile" class="single-payment @if(old('method') == 'mobile') selected @endif">
                                                            <img src="{{asset('assets/images/booking.png')}}" alt="Mobile" title="Mobile money pay">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-6">
                                                        <div data-value="cash" class="single-payment @if(old('method') == 'cash') selected @endif">
                                                            <img src="{{asset('assets/images/299107_money_icon.png')}}" alt="Cash " title="Cash money">
                                                        </div>
                                                    </div>
                                                </div>
                    </div>
                    <div class="meths">
                        <div class="col-lg-8">
                            
                            @include('usersView.depot._depot_method')
                        </div>
                    </div>