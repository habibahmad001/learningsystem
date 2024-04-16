<form class="inline-form top-menu-form" action="<?=  url('/courses/search')  ?>" method="get">
    <div class="input-group search-box mobile-search">
        <input id="headr-s" type="text"  name="search_term"  autocomplete="off"
               ng-keyup='fetchUsers("2")'
               ng-click='searchboxClicked($event)'
               ng-model='searchText_2'
               class="form-control" placeholder="Search For Courses">
        <div class="input-group-append">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
    <div id="search-container-1">
        <ul id='searchResult_2' class="searchResult">
            <div class="scrollable">
                <li ng-click='setValue($index,$event)'
                    ng-repeat="result in searchResult_2" ng-bind-html="boldText(result.title,result.slug)">
                </li>
            </div>
        </ul>
    </div>
</form>
