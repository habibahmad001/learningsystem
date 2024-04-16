<div class="modal fade" id="myModalinstructor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">{{ getPhrase('Become An Instructor') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="demo-form2" method="post" action="{{ route('apply.instructor')}}" data-parsley-validate class="new__formStyle row" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="user_id"  value="{{Auth::user()->id}}" />

                  <div class="form-group col-sm-6">
                    <div class="field">
                      <input type="text" class="" name="fname" id="fname" placeholder="Please Enter First Name" value="" required>
                      <label for="fname">First Name:<span>*</span></label>
                    </div>
                  </div>


              <div class="form-group col-sm-6">
                  <div class="field">
                      <input type="text" class="" name="lname" id="lname" placeholder="Please Enter Last Name" value="" required>
                      <label for="lname">Last Name:<span>*</span></label>
                  </div>
              </div>

              <div class="form-group col-sm-6">
                  <div class="field">
                      <input type="date" class="" name="dob" id="date" value="" required>
                      <label for="date">Date of Birth:<span>*</span></label>
                  </div>
              </div>

              <div class="form-group col-sm-6">
                  <div class="field select_div">
                      <select class="" name="gender" id="gender" required>
                          <option value="none" selected>Select an Option</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>
                      </select>
                      <label for="gender">Gender:<span>*</span></label>
                  </div>
              </div>

              <div class="form-group col-sm-6">
                  <div class="field">
                      <input type="email" value="" class="" name="email" id="email" placeholder="Please Enter Email" value="">
                      <label for="email">Email:<span>*</span></label>
                  </div>
              </div>

              <div class="form-group col-sm-6">
                  <div class="field">
                      <input type="text" class="" name="mobile" id="mobile" placeholder="Please Enter Contact No." value="" required>
                      <label for="mobile">Contact No:<span>*</span></label>
                  </div>
              </div>

              <div class="form-group col-sm-12">
                  <div class="field">
                      <textarea name="detail" rows="5"  class="" id="detail" placeholder="" required></textarea>
                      <label for="detail">Detail:<span>*</span></label>
                  </div>
              </div>

              <div class="form-group col-sm-6">
                  <div class="field">
                      <input type="file" class="form-control" name="file" id="file" value="" required>
                      <label for="file">Upload Resume:<sup class="redstar">*</sup></label>
                  </div>
              </div>

              <div class="form-group col-sm-6">
                  <div class="field">
                      <input type="file" class="form-control" name="image"  id="image" required>
                      <label for="image">Upload Image:<sup class="redstar">*</sup></label>
                  </div>
              </div>

              <div class="form-group mb-0 text-center col-sm-12">
                  <button type="submit" class="btn btn-primary theme-btn btn-block">{{ getPhrase('Submit') }}</button>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>