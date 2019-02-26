

    <h1 class="heading uppercase" style="margin-top: -70px; font-size: 500%">{{ config('app.name') }}<span id="logo_span" style="font-size:200%;color:#7cc576;">.</span></h1>
    <h3 class="heading">“Latest Bestseller eBooks.”</h3>
    <br/><br/><br/><br/>



    <section>
        <div class=" ">
            <div class="row">
                {{ Form::open(array('action' => 'subscribeController@subscribePost'))}}
                    <div><h2 class="title">Do you want to unsubscribe?</h2></div>
                    <div><label class="title">Email to unsubscribe:</label><input autocomplete="on" type="text" name="email" value=""></div>

                    <div><input type="submit" name="unsubscribe" value="Unsubscribe"></div>

            {{ Form::open(array('action' => 'subscribeController@subscribePost'))}}
            </div>
        </div>
    </section>



