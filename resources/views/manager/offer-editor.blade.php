@extends('layouts.account')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
               
            <form action="@if( ! empty($id)) {{route('update-offer')}} @else {{route('store-offer')}} @endif"  class="text-large" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}


                @if( ! empty($id))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 1: </span>
                                                </div>
                                                <input id="review_name_1" type="text" name="review_name_1" class="form-control"@if( ! empty($review_name_1)) value="{{$review_name_1}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 1: </span>
                                                </div>
                                                <input id="review_content_1" type="text" name="review_content_1" class="form-control"@if( ! empty($review_content_1)) value="{{$review_content_1}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 2: </span>
                                                </div>
                                                <input id="review_name_2" type="text" name="review_name_2" class="form-control"@if( ! empty($review_name_2)) value="{{$review_name_2}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 2: </span>
                                                </div>
                                                <input id="review_content_2" type="text" name="review_content_2" class="form-control"@if( ! empty($review_content_2)) value="{{$review_content_2}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 3: </span>
                                                </div>
                                                <input id="review_name_3" type="text" name="review_name_3" class="form-control"@if( ! empty($review_name_3)) value="{{$review_name_3}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 3: </span>
                                                </div>
                                                <input id="review_content_3" type="text" name="review_content_3" class="form-control"@if( ! empty($review_content_3)) value="{{$review_content_3}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 4: </span>
                                                </div>
                                                <input id="review_name_4" type="text" name="review_name_4" class="form-control"@if( ! empty($review_name_4)) value="{{$review_name_4}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 4: </span>
                                                </div>
                                                <input id="review_content_4" type="text" name="review_content_4" class="form-control"@if( ! empty($review_content_4)) value="{{$review_content_4}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 5: </span>
                                                </div>
                                                <input id="review_name_5" type="text" name="review_name_5" class="form-control"@if( ! empty($review_name_5)) value="{{$review_name_5}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 5: </span>
                                                </div>
                                                <input id="review_content_5" type="text" name="review_content_5" class="form-control"@if( ! empty($review_content_5)) value="{{$review_content_5}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Reviewer Name 6: </span>
                                                </div>
                                                <input id="review_name_6" type="text" name="review_name_6" class="form-control"@if( ! empty($review_name_6)) value="{{$review_name_6}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Review Content 6: </span>
                                                </div>
                                                <input id="review_content_6" type="text" name="review_content_6" class="form-control"@if( ! empty($review_content_6)) value="{{$review_content_6}}" @endif >
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 1:</span>
                                                </div>
                                                <input id="image_1" type="text" name="image_1" class="form-control"@if( ! empty($image_1)) value="{{$image_1}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 2:</span>
                                                </div>
                                                <input id="image_2" type="text" name="image_2" class="form-control"@if( ! empty($image_2)) value="{{$image_2}}" @endif >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 3:</span>
                                                </div>
                                                <input id="image_3" type="text" name="image_3" class="form-control"@if( ! empty($image_3)) value="{{$image_3}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 4:</span>
                                                </div>
                                                <input id="image_4" type="text" name="image_4" class="form-control"@if( ! empty($image_4)) value="{{$image_4}}" @endif >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 5:</span>
                                                </div>
                                                <input id="image_5" type="text" name="image_5" class="form-control"@if( ! empty($image_5)) value="{{$image_5}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 6:</span>
                                                </div>
                                                <input id="image_6" type="text" name="image_6" class="form-control"@if( ! empty($image_6)) value="{{$image_6}}" @endif >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 7:</span>
                                                </div>
                                                <input id="image_7" type="text" name="image_7" class="form-control"@if( ! empty($image_7)) value="{{$image_7}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 8:</span>
                                                </div>
                                                <input id="image_8" type="text" name="image_8" class="form-control"@if( ! empty($image_8)) value="{{$image_8}}" @endif >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Image 9:</span>
                                                </div>
                                                <input id="image_9" type="text" name="image_9" class="form-control"@if( ! empty($image_9)) value="{{$image_9}}" @endif >
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Author Picture:</span>
                                                </div>
                                                <input id="author_image" type="text" name="author_image" class="form-control"@if( ! empty($author_image)) value="{{$author_image}}" @endif >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Author Name:</span>
                                        </div>
                                        <input id="author_name" type="text" name="author_name" class="form-control"@if( ! empty($author_name)) value="{{$author_name}}" @endif >
                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Author About: </span>
                                        </div>
                                        <textarea rows="5" name="author_about" id="author_about" class="form-control" style="max-height: 100%" >@if( ! empty($author_about)) {{$author_about}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Description: </span>
                                        </div>
                                        <textarea rows="5" name="description" id="description" class="form-control" style="max-height: 100%" >@if( ! empty($description)) {{$description}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Book About 1: </span>
                                        </div>
                                        <textarea rows="5" name="book_about_1" id="book_about_1" class="form-control" style="max-height: 100%" >@if( ! empty($book_about_1)) {{$book_about_1}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Book About 2:</span>
                                        </div>
                                        <textarea rows="5" name="book_about_2" id="book_about_2" class="form-control" style="max-height: 100%" >@if( ! empty($book_about_2)) {{$book_about_2}} @endif</textarea>

                                    </div>

                                    <div class="input-group form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Book About 3: </span>
                                        </div>
                                        <textarea rows="5" name="book_about_3" id="book_about_3" class="form-control" style="max-height: 100%" >@if( ! empty($book_about_3)) {{$book_about_3}} @endif</textarea>

                                    </div>




                                </div>


                            </div>
                        </div>
                    </div>

                @endif


                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                @if( ! empty($id)) <input id="id" type="text" name="id" hidden value="{{$id}}"> @endif
                                <div class="container">

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Title: </span>
                                                </div>
                                                <input id="title" type="text" name="title" class="form-control"@if( ! empty($title)) value="{{$title}}" @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Price($): </span>
                                                </div>


                                                <input id="payout" type="text" name="payout" class="form-control" @if( ! empty($payout)) value="{{$payout}}" @endif required>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">(CPC Offer?) CPC($): </span>
                                                    </div>
                                                    <input id="cpc" type="text" name="cpc" onchange="document.getElementById('cpa').value = 0;" class="form-control" @if( ! empty($cpc)) value="{{$cpc}}" @endif required>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">(CPA Offer?) CPA($): </span>
                                                    </div>

                                                    <input id="cpa" type="text" name="cpa"  onchange="document.getElementById('cpc').value = 0;" class="form-control" @if( ! empty($cpa)) value="{{$cpa}}" @endif required>

                                                </div>
                                            </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Subtitle: </span>
                                                </div>
                                                <input id="subtitle" type="text" name="subtitle" class="form-control"@if( ! empty($subtitle)) value="{{$subtitle}}" @endif required>
                                            </div>
                                        </div>
                                    </div>

                                    @if( ! empty($id))
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" data-preview="#preview" name="thumbnail" id="thumbnail">
                                                        <label class="custom-file-label" for="thumbnail">Choose Thumbnail</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="product" id="product">
                                                        <label class="custom-file-label" for="product">Choose Product</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    @endif
                                    <br/>

                                    <div class="form-group">
                                        <h4>Verticals:</h4>
                                        @if( empty($selected_verticals)) {{$selected_verticals = null}} @endif
                                        {!! Form::select('verticals[]', $verticals, $selected_verticals, ['id' => 'verticals', 'multiple' => 'multiple', 'class' => 'custom-select long', 'size' => '12', 'required' => 'required']) !!}

                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <h4>Countries:</h4>


                                        <a href='#' id='select-english'>Select English Countries</a><br/>
                                        @if( empty($selected_countries)) {{$selected_countries = null}} @endif
                                        {!! Form::select('countries[]', $countries, $selected_countries, ['id' => 'countries', 'multiple' => 'multiple', 'class' => 'custom-select long', 'size' => '12']) !!}


                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="custom-control custom-checkbox">

                                                @if( ! empty($is_private))
                                                    {{ Form::checkbox('is_private', null, true, array('id'=>'is_private', 'class'=>'custom-control-input')) }}
                                                @else

                                                    {{ Form::checkbox('is_private', null, false, array('id'=>'is_private', 'class'=>'custom-control-input')) }}
                                                @endif

                                                <label class="custom-control-label" for="is_private">Make this offer Private (Add the offer manually to publishers)</label>
                                            </div>
                                        </div>

                                    </div>
                                    <br>


                                    <div class="form-group col-md-12 text-center">
                                        @if( ! empty($id))
                                            <a href="{{$id}}/landing/a" target="BLANK" class="btn btn-outline-default btn-sm">Edit A</a>
                                            <a href="{{$id}}/landing/b" target="BLANK" class="btn btn-outline-default btn-sm">Edit B</a>
                                            <a href="{{$id}}/promo" target="BLANK"  class="btn btn-outline-default btn-sm">Edit Promotional Tools</a>
                                            <a class="btn btn-outline-default btn-sm" target="BLANK"  href="/preview/{{$id}}">Preview Landing</a>
                                            <a class="btn btn-outline-default btn-sm" target="BLANK"  href="/preview/email/id/{{$id}}">Preview Html Email</a>
                                            <a class="btn btn-outline-default btn-sm" target="BLANK"  href="/manager/download/{{$id}}">DOWNLOAD EBOOK</a>

                                            <br/>

                                        @endif
                                        <button type="submit" class="btn btn-danger btn-round btn-lg">Save</button>

                                    </div>

                                </div>
                            </div>


                    </div>

                </div>

                <div class="col-lg-3">

                        <div class="card">
                            <div class="card-body">
                            <img @if( ! empty($thumbnail)) src="{{$thumbnail}}" @else src="/images/ebook.jpg" @endif class="card-img-top rounded mx-auto d-block"  id="preview" />
                            </div>
                        </div>
                    <div class="input-group">


                        <input class="form-control" name="color"  id="color" value="{{$color}}" placeholder="Primary Coloe ex {{$color}}" style="background-color: {{$color}};color:white;">

                        <div class="input-group-append">
                            <span class="input-group-text p-0 ">
                                <a id="getcolor" class="btn btn-link" title="Automatically generate primary color from image">
                                    Generate
                                </a>
                            </span>
                        </div>

                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">3D cover:</span>
                        </div>
                        <input id="cover" type="text" name="cover" class="form-control"@if( ! empty($cover)) value="{{$cover}}" @endif >
                    </div>


                </div>
                </div>





            </form>
        </div>



        </div>
    </div>



@endsection

@section('title')
    @if(empty($id)) New Offer @else Edit Offer @endif
@endsection

@section('header')
   <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
   <link href="{{ URL::asset('css/multi-select.css') }}" rel="stylesheet">
   <style>


       .btn:hover, .btn:focus, .btn:active, .btn.active, .btn:active:focus, .btn:active:hover, .btn.active:focus, .btn.active:hover, .show > .btn.dropdown-toggle, .show > .btn.dropdown-toggle:focus, .show > .btn.dropdown-toggle:hover, .navbar .navbar-nav > a.btn:hover, .navbar .navbar-nav > a.btn:focus, .navbar .navbar-nav > a.btn:active, .navbar .navbar-nav > a.btn.active, .navbar .navbar-nav > a.btn:active:focus, .navbar .navbar-nav > a.btn:active:hover, .navbar .navbar-nav > a.btn.active:focus, .navbar .navbar-nav > a.btn.active:hover, .show > .navbar .navbar-nav > a.btn.dropdown-toggle, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:focus, .show > .navbar .navbar-nav > a.btn.dropdown-toggle:hover {
           background-color: transparent !important;
           color: black !important;
           box-shadow: none !important;

       }
   </style>
@endsection

@section('footer')



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ URL::asset('js/core/popper.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>


    <!--  Notifications Plugin    -->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/bootstrap-notify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script>

        /*
         * MultiSelect v0.9.12
         * Copyright (c) 2012 Louis Cuny
         *
         * This program is free software. It comes without any warranty, to
         * the extent permitted by applicable law. You can redistribute it
         * and/or modify it under the terms of the Do What The Fuck You Want
         * To Public License, Version 2, as published by Sam Hocevar. See
         * http://sam.zoy.org/wtfpl/COPYING for more details.
         */

        !function ($) {

            "use strict";


            /* MULTISELECT CLASS DEFINITION
             * ====================== */

            var MultiSelect = function (element, options) {
                this.options = options;
                this.$element = $(element);
                this.$container = $('<div/>', { 'class': "ms-container" });
                this.$selectableContainer = $('<div/>', { 'class': 'ms-selectable' });
                this.$selectionContainer = $('<div/>', { 'class': 'ms-selection' });
                this.$selectableUl = $('<ul/>', { 'class': "ms-list", 'tabindex' : '-1' });
                this.$selectionUl = $('<ul/>', { 'class': "ms-list", 'tabindex' : '-1' });
                this.scrollTo = 0;
                this.elemsSelector = 'li:visible:not(.ms-optgroup-label,.ms-optgroup-container,.'+options.disabledClass+')';
            };

            MultiSelect.prototype = {
                constructor: MultiSelect,

                init: function(){
                    var that = this,
                        ms = this.$element;

                    if (ms.next('.ms-container').length === 0){
                        ms.css({ position: 'absolute', left: '-9999px' });
                        ms.attr('id', ms.attr('id') ? ms.attr('id') : Math.ceil(Math.random()*1000)+'multiselect');
                        this.$container.attr('id', 'ms-'+ms.attr('id'));
                        this.$container.addClass(that.options.cssClass);
                        ms.find('option').each(function(){
                            that.generateLisFromOption(this);
                        });

                        this.$selectionUl.find('.ms-optgroup-label').hide();

                        if (that.options.selectableHeader){
                            that.$selectableContainer.append(that.options.selectableHeader);
                        }
                        that.$selectableContainer.append(that.$selectableUl);
                        if (that.options.selectableFooter){
                            that.$selectableContainer.append(that.options.selectableFooter);
                        }

                        if (that.options.selectionHeader){
                            that.$selectionContainer.append(that.options.selectionHeader);
                        }
                        that.$selectionContainer.append(that.$selectionUl);
                        if (that.options.selectionFooter){
                            that.$selectionContainer.append(that.options.selectionFooter);
                        }

                        that.$container.append(that.$selectableContainer);
                        that.$container.append(that.$selectionContainer);
                        ms.after(that.$container);

                        that.activeMouse(that.$selectableUl);
                        that.activeKeyboard(that.$selectableUl);

                        var action = that.options.dblClick ? 'dblclick' : 'click';

                        that.$selectableUl.on(action, '.ms-elem-selectable', function(){
                            that.select($(this).data('ms-value'));
                        });
                        that.$selectionUl.on(action, '.ms-elem-selection', function(){
                            that.deselect($(this).data('ms-value'));
                        });

                        that.activeMouse(that.$selectionUl);
                        that.activeKeyboard(that.$selectionUl);

                        ms.on('focus', function(){
                            that.$selectableUl.focus();
                        });
                    }

                    var selectedValues = ms.find('option:selected').map(function(){ return $(this).val(); }).get();
                    that.select(selectedValues, 'init');

                    if (typeof that.options.afterInit === 'function') {
                        that.options.afterInit.call(this, this.$container);
                    }
                },

                'generateLisFromOption' : function(option, index, $container){
                    var that = this,
                        ms = that.$element,
                        attributes = "",
                        $option = $(option);

                    for (var cpt = 0; cpt < option.attributes.length; cpt++){
                        var attr = option.attributes[cpt];

                        if(attr.name !== 'value' && attr.name !== 'disabled'){
                            attributes += attr.name+'="'+attr.value+'" ';
                        }
                    }
                    var selectableLi = $('<li '+attributes+'><span>'+that.escapeHTML($option.text())+'</span></li>'),
                        selectedLi = selectableLi.clone(),
                        value = $option.val(),
                        elementId = that.sanitize(value);

                    selectableLi
                        .data('ms-value', value)
                        .addClass('ms-elem-selectable')
                        .attr('id', elementId+'-selectable');

                    selectedLi
                        .data('ms-value', value)
                        .addClass('ms-elem-selection')
                        .attr('id', elementId+'-selection')
                        .hide();

                    if ($option.attr('disabled') || ms.attr('disabled')){
                        selectedLi.addClass(that.options.disabledClass);
                        selectableLi.addClass(that.options.disabledClass);
                    }

                    var $optgroup = $option.parent('optgroup');

                    if ($optgroup.length > 0){
                        var optgroupLabel = $optgroup.attr('label'),
                            optgroupId = that.sanitize(optgroupLabel),
                            $selectableOptgroup = that.$selectableUl.find('#optgroup-selectable-'+optgroupId),
                            $selectionOptgroup = that.$selectionUl.find('#optgroup-selection-'+optgroupId);

                        if ($selectableOptgroup.length === 0){
                            var optgroupContainerTpl = '<li class="ms-optgroup-container"></li>',
                                optgroupTpl = '<ul class="ms-optgroup"><li class="ms-optgroup-label"><span>'+optgroupLabel+'</span></li></ul>';

                            $selectableOptgroup = $(optgroupContainerTpl);
                            $selectionOptgroup = $(optgroupContainerTpl);
                            $selectableOptgroup.attr('id', 'optgroup-selectable-'+optgroupId);
                            $selectionOptgroup.attr('id', 'optgroup-selection-'+optgroupId);
                            $selectableOptgroup.append($(optgroupTpl));
                            $selectionOptgroup.append($(optgroupTpl));
                            if (that.options.selectableOptgroup){
                                $selectableOptgroup.find('.ms-optgroup-label').on('click', function(){
                                    var values = $optgroup.children(':not(:selected, :disabled)').map(function(){ return $(this).val();}).get();
                                    that.select(values);
                                });
                                $selectionOptgroup.find('.ms-optgroup-label').on('click', function(){
                                    var values = $optgroup.children(':selected:not(:disabled)').map(function(){ return $(this).val();}).get();
                                    that.deselect(values);
                                });
                            }
                            that.$selectableUl.append($selectableOptgroup);
                            that.$selectionUl.append($selectionOptgroup);
                        }
                        index = index === undefined ? $selectableOptgroup.find('ul').children().length : index + 1;
                        selectableLi.insertAt(index, $selectableOptgroup.children());
                        selectedLi.insertAt(index, $selectionOptgroup.children());
                    } else {
                        index = index === undefined ? that.$selectableUl.children().length : index;

                        selectableLi.insertAt(index, that.$selectableUl);
                        selectedLi.insertAt(index, that.$selectionUl);
                    }
                },

                'addOption' : function(options){
                    var that = this;

                    if (options.value !== undefined && options.value !== null){
                        options = [options];
                    }
                    $.each(options, function(index, option){
                        if (option.value !== undefined && option.value !== null &&
                            that.$element.find("option[value='"+option.value+"']").length === 0){
                            var $option = $('<option value="'+option.value+'">'+option.text+'</option>'),
                                $container = option.nested === undefined ? that.$element : $("optgroup[label='"+option.nested+"']"),
                                index = parseInt((typeof option.index === 'undefined' ? $container.children().length : option.index));

                            if (option.optionClass) {
                                $option.addClass(option.optionClass);
                            }

                            if (option.disabled) {
                                $option.prop('disabled', true);
                            }

                            $option.insertAt(index, $container);
                            that.generateLisFromOption($option.get(0), index, option.nested);
                        }
                    });
                },

                'escapeHTML' : function(text){
                    return $("<div>").text(text).html();
                },

                'activeKeyboard' : function($list){
                    var that = this;

                    $list.on('focus', function(){
                        $(this).addClass('ms-focus');
                    })
                        .on('blur', function(){
                            $(this).removeClass('ms-focus');
                        })
                        .on('keydown', function(e){
                            switch (e.which) {
                                case 40:
                                case 38:
                                    e.preventDefault();
                                    e.stopPropagation();
                                    that.moveHighlight($(this), (e.which === 38) ? -1 : 1);
                                    return;
                                case 37:
                                case 39:
                                    e.preventDefault();
                                    e.stopPropagation();
                                    that.switchList($list);
                                    return;
                                case 9:
                                    if(that.$element.is('[tabindex]')){
                                        e.preventDefault();
                                        var tabindex = parseInt(that.$element.attr('tabindex'), 10);
                                        tabindex = (e.shiftKey) ? tabindex-1 : tabindex+1;
                                        $('[tabindex="'+(tabindex)+'"]').focus();
                                        return;
                                    }else{
                                        if(e.shiftKey){
                                            that.$element.trigger('focus');
                                        }
                                    }
                            }
                            if($.inArray(e.which, that.options.keySelect) > -1){
                                e.preventDefault();
                                e.stopPropagation();
                                that.selectHighlighted($list);
                                return;
                            }
                        });
                },

                'moveHighlight': function($list, direction){
                    var $elems = $list.find(this.elemsSelector),
                        $currElem = $elems.filter('.ms-hover'),
                        $nextElem = null,
                        elemHeight = $elems.first().outerHeight(),
                        containerHeight = $list.height(),
                        containerSelector = '#'+this.$container.prop('id');

                    $elems.removeClass('ms-hover');
                    if (direction === 1){ // DOWN

                        $nextElem = $currElem.nextAll(this.elemsSelector).first();
                        if ($nextElem.length === 0){
                            var $optgroupUl = $currElem.parent();

                            if ($optgroupUl.hasClass('ms-optgroup')){
                                var $optgroupLi = $optgroupUl.parent(),
                                    $nextOptgroupLi = $optgroupLi.next(':visible');

                                if ($nextOptgroupLi.length > 0){
                                    $nextElem = $nextOptgroupLi.find(this.elemsSelector).first();
                                } else {
                                    $nextElem = $elems.first();
                                }
                            } else {
                                $nextElem = $elems.first();
                            }
                        }
                    } else if (direction === -1){ // UP

                        $nextElem = $currElem.prevAll(this.elemsSelector).first();
                        if ($nextElem.length === 0){
                            var $optgroupUl = $currElem.parent();

                            if ($optgroupUl.hasClass('ms-optgroup')){
                                var $optgroupLi = $optgroupUl.parent(),
                                    $prevOptgroupLi = $optgroupLi.prev(':visible');

                                if ($prevOptgroupLi.length > 0){
                                    $nextElem = $prevOptgroupLi.find(this.elemsSelector).last();
                                } else {
                                    $nextElem = $elems.last();
                                }
                            } else {
                                $nextElem = $elems.last();
                            }
                        }
                    }
                    if ($nextElem.length > 0){
                        $nextElem.addClass('ms-hover');
                        var scrollTo = $list.scrollTop() + $nextElem.position().top -
                            containerHeight / 2 + elemHeight / 2;

                        $list.scrollTop(scrollTo);
                    }
                },

                'selectHighlighted' : function($list){
                    var $elems = $list.find(this.elemsSelector),
                        $highlightedElem = $elems.filter('.ms-hover').first();

                    if ($highlightedElem.length > 0){
                        if ($list.parent().hasClass('ms-selectable')){
                            this.select($highlightedElem.data('ms-value'));
                        } else {
                            this.deselect($highlightedElem.data('ms-value'));
                        }
                        $elems.removeClass('ms-hover');
                    }
                },

                'switchList' : function($list){
                    $list.blur();
                    this.$container.find(this.elemsSelector).removeClass('ms-hover');
                    if ($list.parent().hasClass('ms-selectable')){
                        this.$selectionUl.focus();
                    } else {
                        this.$selectableUl.focus();
                    }
                },

                'activeMouse' : function($list){
                    var that = this;

                    this.$container.on('mouseenter', that.elemsSelector, function(){
                        $(this).parents('.ms-container').find(that.elemsSelector).removeClass('ms-hover');
                        $(this).addClass('ms-hover');
                    });

                    this.$container.on('mouseleave', that.elemsSelector, function () {
                        $(this).parents('.ms-container').find(that.elemsSelector).removeClass('ms-hover');
                    });
                },

                'refresh' : function() {
                    this.destroy();
                    this.$element.multiSelect(this.options);
                },

                'destroy' : function(){
                    $("#ms-"+this.$element.attr("id")).remove();
                    this.$element.off('focus');
                    this.$element.css('position', '').css('left', '');
                    this.$element.removeData('multiselect');
                },

                'select' : function(value, method){
                    if (typeof value === 'string'){ value = [value]; }

                    var that = this,
                        ms = this.$element,
                        msIds = $.map(value, function(val){ return(that.sanitize(val)); }),
                        selectables = this.$selectableUl.find('#' + msIds.join('-selectable, #')+'-selectable').filter(':not(.'+that.options.disabledClass+')'),
                        selections = this.$selectionUl.find('#' + msIds.join('-selection, #') + '-selection').filter(':not(.'+that.options.disabledClass+')'),
                        options = ms.find('option:not(:disabled)').filter(function(){ return($.inArray(this.value, value) > -1); });

                    if (method === 'init'){
                        selectables = this.$selectableUl.find('#' + msIds.join('-selectable, #')+'-selectable'),
                            selections = this.$selectionUl.find('#' + msIds.join('-selection, #') + '-selection');
                    }

                    if (selectables.length > 0){
                        selectables.addClass('ms-selected').hide();
                        selections.addClass('ms-selected').show();

                        options.attr('selected', 'selected');

                        that.$container.find(that.elemsSelector).removeClass('ms-hover');

                        var selectableOptgroups = that.$selectableUl.children('.ms-optgroup-container');
                        if (selectableOptgroups.length > 0){
                            selectableOptgroups.each(function(){
                                var selectablesLi = $(this).find('.ms-elem-selectable');
                                if (selectablesLi.length === selectablesLi.filter('.ms-selected').length){
                                    $(this).find('.ms-optgroup-label').hide();
                                }
                            });

                            var selectionOptgroups = that.$selectionUl.children('.ms-optgroup-container');
                            selectionOptgroups.each(function(){
                                var selectionsLi = $(this).find('.ms-elem-selection');
                                if (selectionsLi.filter('.ms-selected').length > 0){
                                    $(this).find('.ms-optgroup-label').show();
                                }
                            });
                        } else {
                            if (that.options.keepOrder && method !== 'init'){
                                var selectionLiLast = that.$selectionUl.find('.ms-selected');
                                if((selectionLiLast.length > 1) && (selectionLiLast.last().get(0) != selections.get(0))) {
                                    selections.insertAfter(selectionLiLast.last());
                                }
                            }
                        }
                        if (method !== 'init'){
                            ms.trigger('change');
                            if (typeof that.options.afterSelect === 'function') {
                                that.options.afterSelect.call(this, value);
                            }
                        }
                    }
                },

                'deselect' : function(value){
                    if (typeof value === 'string'){ value = [value]; }

                    var that = this,
                        ms = this.$element,
                        msIds = $.map(value, function(val){ return(that.sanitize(val)); }),
                        selectables = this.$selectableUl.find('#' + msIds.join('-selectable, #')+'-selectable'),
                        selections = this.$selectionUl.find('#' + msIds.join('-selection, #')+'-selection').filter('.ms-selected').filter(':not(.'+that.options.disabledClass+')'),
                        options = ms.find('option').filter(function(){ return($.inArray(this.value, value) > -1); });

                    if (selections.length > 0){
                        selectables.removeClass('ms-selected').show();
                        selections.removeClass('ms-selected').hide();
                        options.removeAttr('selected');

                        that.$container.find(that.elemsSelector).removeClass('ms-hover');

                        var selectableOptgroups = that.$selectableUl.children('.ms-optgroup-container');
                        if (selectableOptgroups.length > 0){
                            selectableOptgroups.each(function(){
                                var selectablesLi = $(this).find('.ms-elem-selectable');
                                if (selectablesLi.filter(':not(.ms-selected)').length > 0){
                                    $(this).find('.ms-optgroup-label').show();
                                }
                            });

                            var selectionOptgroups = that.$selectionUl.children('.ms-optgroup-container');
                            selectionOptgroups.each(function(){
                                var selectionsLi = $(this).find('.ms-elem-selection');
                                if (selectionsLi.filter('.ms-selected').length === 0){
                                    $(this).find('.ms-optgroup-label').hide();
                                }
                            });
                        }
                        ms.trigger('change');
                        if (typeof that.options.afterDeselect === 'function') {
                            that.options.afterDeselect.call(this, value);
                        }
                    }
                },

                'select_all' : function(){
                    var ms = this.$element,
                        values = ms.val();

                    ms.find('option:not(":disabled")').attr('selected', 'selected');
                    this.$selectableUl.find('.ms-elem-selectable').filter(':not(.'+this.options.disabledClass+')').addClass('ms-selected').hide();
                    this.$selectionUl.find('.ms-optgroup-label').show();
                    this.$selectableUl.find('.ms-optgroup-label').hide();
                    this.$selectionUl.find('.ms-elem-selection').filter(':not(.'+this.options.disabledClass+')').addClass('ms-selected').show();
                    this.$selectionUl.focus();
                    ms.trigger('change');
                    if (typeof this.options.afterSelect === 'function') {
                        var selectedValues = $.grep(ms.val(), function(item){
                            return $.inArray(item, values) < 0;
                        });
                        this.options.afterSelect.call(this, selectedValues);
                    }
                },

                'deselect_all' : function(){
                    var ms = this.$element,
                        values = ms.val();

                    ms.find('option').removeAttr('selected');
                    this.$selectableUl.find('.ms-elem-selectable').removeClass('ms-selected').show();
                    this.$selectionUl.find('.ms-optgroup-label').hide();
                    this.$selectableUl.find('.ms-optgroup-label').show();
                    this.$selectionUl.find('.ms-elem-selection').removeClass('ms-selected').hide();
                    this.$selectableUl.focus();
                    ms.trigger('change');
                    if (typeof this.options.afterDeselect === 'function') {
                        this.options.afterDeselect.call(this, values);
                    }
                },

                sanitize: function(value){
                    var hash = 0, i, character;
                    if (value.length == 0) return hash;
                    var ls = 0;
                    for (i = 0, ls = value.length; i < ls; i++) {
                        character  = value.charCodeAt(i);
                        hash  = ((hash<<5)-hash)+character;
                        hash |= 0; // Convert to 32bit integer
                    }
                    return hash;
                }
            };

            /* MULTISELECT PLUGIN DEFINITION
             * ======================= */

            $.fn.multiSelect = function () {
                var option = arguments[0],
                    args = arguments;

                return this.each(function () {
                    var $this = $(this),
                        data = $this.data('multiselect'),
                        options = $.extend({}, $.fn.multiSelect.defaults, $this.data(), typeof option === 'object' && option);

                    if (!data){ $this.data('multiselect', (data = new MultiSelect(this, options))); }

                    if (typeof option === 'string'){
                        data[option](args[1]);
                    } else {
                        data.init();
                    }
                });
            };

            $.fn.multiSelect.defaults = {
                keySelect: [32],
                selectableOptgroup: false,
                disabledClass : 'disabled',
                dblClick : false,
                keepOrder: false,
                cssClass: ''
            };

            $.fn.multiSelect.Constructor = MultiSelect;

            $.fn.insertAt = function(index, $parent) {
                return this.each(function() {
                    if (index === 0) {
                        $parent.prepend(this);
                    } else {
                        $parent.children().eq(index - 1).after(this);
                    }
                });
            };

        }(window.jQuery);

        $('#verticals').multiSelect();
        $('#countries').multiSelect();
        $('#countries').multiSelect('select', ['5','9','10']);
        $('#select-english').click(function(){

            $('#countries').multiSelect('select', ['1','2','3']);
            return false;
        });
        $(document).ready( function() {

            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#thumbnail").change(function(){
                readURL(this);
            });
        });

        $(document).ready(function() {
            $('#offer').summernote({
                height: 700,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['table', 'picture' ,'video', 'link', 'hr']],
                    ['controle', ['fullscreen', 'codeview', 'undo', 'redo']],

                ]
            });
        });

        $(document).ready(function() {
            $('#promo').summernote({
                height: 700,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['table', 'picture' ,'video', 'link', 'hr']],
                    ['controle', ['fullscreen', 'codeview', 'undo', 'redo']],

                ]
            });
        });
    </script>



    <script src="{{ asset('landing/js/color-thief.js') }}"></script>
    <script type="text/javascript">


        function lightOrDark(color) {

            // Check the format of the color, HEX or RGB?
            if (color.match(/^rgb/)) {

                // If HEX --> store the red, green, blue values in separate variables
                color = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);

                r = color[1];
                g = color[2];
                b = color[3];
            }
            else {

                // If RGB --> Convert it to HEX: http://gist.github.com/983661
                color = +("0x" + color.slice(1).replace(
                        color.length < 5 && /./g, '$&$&'
                    )
                );

                r = color >> 16;
                g = color >> 8 & 255;
                b = color & 255;
            }

            // HSP (Highly Sensitive Poo) equation from http://alienryderflex.com/hsp.html
            hsp = Math.sqrt(
                0.299 * (r * r) +
                0.587 * (g * g) +
                0.114 * (b * b)
            );

            // Using the HSP value, determine whether the color is light or dark
            if (hsp>127.5) {

                return 'light';
            }
            else {

                return 'dark';
            }
        }

        $('#getcolor').click(function(){ getColor(); return false; });

        $("#color").change(function(){
            color = document.getElementById("color").value;
            document.getElementById("color").style.backgroundColor = color;
        });



        function getColor() {

            var colorThief = new ColorThief();
            colorThief.getpaletteAsync("{{ $thumbnail }}",function(color, element){

                if(lightOrDark('rgb('+color[0][0]+','+color[0][1]+','+color[0][2]+')') == 'dark')
                {
                    a = color[0][0];
                    b = color[0][1];
                    c = color[0][2];

                }
                else if(lightOrDark('rgb('+color[1][0]+','+color[1][1]+','+color[1][2]+')') == 'dark')
                {
                    a = color[1][0];
                    b = color[1][1];
                    c = color[1][2];
                }
                else if(lightOrDark('rgb('+color[2][0]+','+color[2][1]+','+color[2][2]+')') == 'dark')
                {
                    a = color[2][0];
                    b = color[2][1];
                    c = color[2][2];
                }else{
                    a = color[0][0];
                    b = color[0][1];
                    c = color[0][2];
                }

                dominant = "#" + ((1 << 24) + (a << 16) + (b << 8) + c).toString(16).slice(1);

                document.getElementById("color").value = dominant;
                document.getElementById("color").style.backgroundColor = dominant;



            });
        }

    </script>

@endsection
