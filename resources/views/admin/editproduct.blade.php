<section class="section" id="offers">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="tabs">
                    <div class="col-lg-12">
                        <section class='tabs-content'>
                    @foreach ($categories as $cat)
                            <article id='{{ $tabId }}'>
                                <div class="row">
                                    
                          @foreach ($cat->products as  $item)
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="left-list">
                                                <div class="col-lg-12">
                                                    <div class="tab-item">
                                                        <img src="{{asset("storage/". $item->image)}}" alt="" class="w-100"
                                                        style="height:80px;object-fit:cover">
                                                        <h4>{{ $item['name'] }}</h4>
                                                        <p>{{ $item['description'] }}</p>
                                                        <div class="price">
                                                            <h6>{{ $offer['price'] }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div> 
                            </article>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
