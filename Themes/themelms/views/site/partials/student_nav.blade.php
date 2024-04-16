<div class="col-lg-3 col-md-4">
    <aside class="left__Nav">
        <ul>
            <li {{ isActive($active_class, 'dashboard') }}>
                <a href="{{URL_MY_DASHBOARD}}"><i class="fa fa-fw fa-window-maximize"></i>{{ getPhrase('dashboard') }}</a>
            </li>
            <li {{ isActive($active_class, 'my-courses') }} >
                <a href="{{URL_MY_STUDENT_LMS_SERIES}}"><i class="fa fa-book-reader"></i>{{ getPhrase('My Courses') }} </a>
            </li>
            <li {{ isActive($active_class, 'notifications') }} >
                <a href="{{URL_NOTIFICATIONS_USER}}"><i class="fa fa-fw fa-bell-o" aria-hidden="true"></i>{{ getPhrase('my notifications') }} </a>
            </li>
            @if(getSetting('messaging', 'module'))
                <li {{ isActive($active_class, 'messages') }} >
                    <a href="{{URL_MY_MESSAGES}}"><i class="fa fa-fw fa-comments" aria-hidden="true"></i>{{ getPhrase('my messages')}}
                        <small class="msg">{{$count = Auth::user()->newThreadsCount()}} </small>
                    </a>
                </li>
            @endif
            <li {{ isActive($active_class, 'exams') }} >
                <a href="{{URL_MY_STUDENT_ANALYSIS_BY_EXAM . Auth::user()->slug}}"><i class="fa fa-question-circle"></i>{{ getPhrase('my exams') }} </a>
            </li>
            <li {{ isActive($active_class, 'certificates') }} >
                <a href="{{URL_MY_STUDENT_CERTIFICATES}}"><i class="fa fa-stamp" aria-hidden="true"></i>{{ getPhrase('my certificates') }} </a>
            </li>
            <li {{ isActive($active_class, 'orders') }} >
                <a href="{{URL_MY_PAYMENTS_LIST.Auth::user()->slug}}"><i class="fa fa-dollar"></i>{{ getPhrase('my orders') }} </a>
            </li>
            <li {{ isActive($active_class, 'wishlists') }} >
                <a href="{{URL_MY_STUDENT_LMS_WISHLIST}}"><i class="fa fa-heart"></i>{{ getPhrase('My Wishlist') }} </a>
            </li>
            <li>
                <a href="{{URL_MY_USERS_EDIT}}"><i class="fa fa-user"></i> My Profile</a>
            </li>
            <li>
                <a href="{{URL_USERS_LOGOUT}}"><i class="fa fa-sign-out"></i>Log out</a>
            </li>
        </ul>
    </aside>
</div>