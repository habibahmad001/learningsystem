<div class="widget">
    <h5 class="widget-title">Search box</h5>
    <div class="search-form">
        <form  action="<?=  url('/blogs/search')  ?>" method="post" >
            <div class="input-group">
                @csrf
                <input type="text" name="keyword" placeholder="Click to Search" class="form-control search-input">
                <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search" style="color: #000;"></i></button>
                      </span>
            </div>
        </form>
    </div>
</div>