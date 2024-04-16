@if(Cookie::get('isActive') != "no")
{{--/*------- Promotion popup ----------*/--}}
@if(Get_Popup_Data_On_ID(1)->PromotionStatus == "active")
    @if(Get_Popup_Data_On_ID(1)->PromotionDisplay == "all")
        @if(Get_Popup_Data_On_ID(1)->PromotionType == "text" || Get_Popup_Data_On_ID(1)->PromotionType == "iframe")
            <div class="popupoverlay">
                <div class="allpopup">
                    <div class="close-div" onclick="javascript:$('.popupoverlay').hide();">X</div>
                    <div class="content">
                        {!! Get_Popup_Data_On_ID(1)->PromotionContent !!}
                    </div>
                </div>
            </div>
        @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "video")
            <!-- Video Modal -->
            <div class="popupforall" id="AlertModeldiv">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">


                        <div class="modal-body">

                            <button type="button" class="close" data-dismiss="modal" onclick="javascript:closepopup();window.location.href='/';" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{!! Get_Popup_Data_On_ID(1)->PromotionContent !!}?autoplay=1&modestbranding=1&showinfo=0" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Video Modal -->
        @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "image")
            <div class="popupoverlay">
                <div class="allpopup">
                    <div class="close-div" onclick="javascript:$('.popupoverlay').hide();">X</div>
                    <a href="{!! Get_Popup_Data_On_ID(1)->imglink !!}">
                        <img src="{!! UPLOADS . 'lms/PopupIMG/' . Get_Popup_Data_On_ID(1)->PromotionContent !!}" class="set" />
                    </a>
                </div>
            </div>
        @endif
    @endif
@endif
{{--/*------- Promotion popup ----------*/--}}

{{--/*------- Promotion popup ----------*/--}}
@if(Get_Popup_Data_On_ID(1)->PromotionStatus == "active")
    @if(Get_Popup_Data_On_ID(1)->PromotionDisplay == "home")
        @if(Request::is('/'))
            @if(Get_Popup_Data_On_ID(1)->PromotionType == "text" || Get_Popup_Data_On_ID(1)->PromotionType == "iframe")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <div class="content">
                            {!! Get_Popup_Data_On_ID(1)->PromotionContent !!}
                        </div>
                    </div>
                </div>
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "video")
                <!-- Video Modal -->
                <div class="popupforall" id="AlertModeldiv">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            <div class="modal-body">

                                <button type="button" class="close" data-dismiss="modal" onclick="javascript:closepopup();window.location.href='/';" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{!! Get_Popup_Data_On_ID(1)->PromotionContent !!}?autoplay=1&modestbranding=1&showinfo=0" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Video Modal -->
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "image")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <a href="{!! Get_Popup_Data_On_ID(1)->imglink !!}">
                            <img src="{!! UPLOADS . 'lms/PopupIMG/' . Get_Popup_Data_On_ID(1)->PromotionContent !!}" class="set" />
                        </a>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endif
{{--/*------- Promotion popup ----------*/--}}


{{--/*------- Promotion popup ----------*/--}}
@if(Get_Popup_Data_On_ID(1)->PromotionStatus == "active")
    @if(Get_Popup_Data_On_ID(1)->PromotionDisplay == "course")
        @if(in_array((collect(request()->segments())->first() == "course") ? Get_ID_On_Slug(collect(request()->segments())->last())->id : 0, explode(",", json_decode(Get_Popup_Data_On_ID(1)->PromotionCourses, true))))
            @if(Get_Popup_Data_On_ID(1)->PromotionType == "text" || Get_Popup_Data_On_ID(1)->PromotionType == "iframe")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <div class="content">
                            {!! Get_Popup_Data_On_ID(1)->PromotionContent !!}
                        </div>
                    </div>
                </div>
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "video")
                <!-- Video Modal -->
                <div class="popupforall" id="AlertModeldiv">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            <div class="modal-body">

                                <button type="button" class="close" data-dismiss="modal" onclick="javascript:closepopup();window.location.href='/';" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{!! Get_Popup_Data_On_ID(1)->PromotionContent !!}?autoplay=1&modestbranding=1&showinfo=0" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Video Modal -->
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "image")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <a href="{!! Get_Popup_Data_On_ID(1)->imglink !!}">
                            <img src="{!! UPLOADS . 'lms/PopupIMG/' . Get_Popup_Data_On_ID(1)->PromotionContent !!}" class="set" />
                        </a>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endif
{{--/*------- Promotion popup ----------*/--}}


{{--/*------- Promotion popup ----------*/--}}
@if(Get_Popup_Data_On_ID(1)->PromotionStatus == "active")
    @if(Get_Popup_Data_On_ID(1)->PromotionDisplay == "homeandcourse")
        @if(Request::is('/') || in_array((collect(request()->segments())->first() == "course") ? Get_ID_On_Slug(collect(request()->segments())->last())->id : 0, explode(",", json_decode(Get_Popup_Data_On_ID(1)->PromotionCourses, true))))
            @if(Get_Popup_Data_On_ID(1)->PromotionType == "text" || Get_Popup_Data_On_ID(1)->PromotionType == "iframe")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <div class="content">
                            {!! Get_Popup_Data_On_ID(1)->PromotionContent !!}
                        </div>
                    </div>
                </div>
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "video")
                <!-- Video Modal -->
                <div class="popupforall" id="AlertModeldiv">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            <div class="modal-body">

                                <button type="button" class="close" data-dismiss="modal" onclick="javascript:closepopup();window.location.href='/';" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{!! Get_Popup_Data_On_ID(1)->PromotionContent !!}?autoplay=1&modestbranding=1&showinfo=0" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Video Modal -->
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "image")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <a href="{!! Get_Popup_Data_On_ID(1)->imglink !!}">
                            <img src="{!! UPLOADS . 'lms/PopupIMG/' . Get_Popup_Data_On_ID(1)->PromotionContent !!}" class="set" />
                        </a>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endif
{{--/*------- Promotion popup ----------*/--}}

{{--/*------- Promotion popup ----------*/--}}
@if(Get_Popup_Data_On_ID(1)->PromotionStatus == "active")
    @if(Get_Popup_Data_On_ID(1)->PromotionDisplay == "custom")
        @if(Request::path() == Get_Popup_Data_On_ID(1)->PromotionCustom )
            @if(Get_Popup_Data_On_ID(1)->PromotionType == "text" || Get_Popup_Data_On_ID(1)->PromotionType == "iframe")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <div class="content">
                            {!! Get_Popup_Data_On_ID(1)->PromotionContent !!}
                        </div>
                    </div>
                </div>
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "video")
                <!-- Video Modal -->
                <div class="popupforall" id="AlertModeldiv">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            <div class="modal-body">

                                <button type="button" class="close" data-dismiss="modal" onclick="javascript:closepopup();window.location.href='/';" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <!-- 16:9 aspect ratio -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{!! Get_Popup_Data_On_ID(1)->PromotionContent !!}?autoplay=1&modestbranding=1&showinfo=0" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Video Modal -->
            @elseif(Get_Popup_Data_On_ID(1)->PromotionType == "image")
                <div class="popupoverlay">
                    <div class="allpopup">
                        <div class="close-div" onclick="javascript:closepopup();">X</div>
                        <a href="{!! Get_Popup_Data_On_ID(1)->imglink !!}">
                            <img src="{!! UPLOADS . 'lms/PopupIMG/' . Get_Popup_Data_On_ID(1)->PromotionContent !!}" class="set" />
                        </a>
                    </div>
                </div>
            @endif
        @endif
    @endif
@endif
{{--/*------- Promotion popup ----------*/--}}
@endif
