<div class="mfp-with-anim mfp-hide mfp-dialog mfp-search-dialog" id="register_new_user">
    <form method="post" action="{{ url('/register') }}">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12" align="center">
            <h3 >New To Kalife Travels and Tours?</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group form-group-icon-left"><i class="fa fa-user-secret input-icon input-icon-show"></i>
                <label>Title *</label>
                <select name="title" required class="form-control">
                    <option value="MR.">Mr.</option>
                    <option value="MRS.">Mrs.</option>
                    <option value="MISS">MISS</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                <label>First Name *</label>
                <input class="form-control" name="first_name" required placeholder="e.g. John" type="text" />
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                <label>Last Name *</label>
                <input class="form-control" name="last_name" required placeholder="e.g. Doe" type="text" />
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                <label>Other Name</label>
                <input class="form-control" name="other_name" placeholder="e.g. Smith" type="text" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-envelope input-icon input-icon-show"></i>
                <label>Email *</label>
                <input class="form-control" name="email" required placeholder="e.g. johndoe@gmail.com" type="email" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-phone input-icon input-icon-show"></i>
                <label>Phone Number *</label>
                <input class="form-control" name="phone_number" required placeholder="e.g. 08012345678" type="number" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left">
                <i class="fa fa-calendar input-icon input-icon-show"></i>
                <label>Date of Birth *</label>
                <input class="date-pick-adult form-control" name="date_of_birth" required type="text" />
            </div>
        </div>
        <div class="col-md-6">
            <label>Gender *</label>
            <div class="radio-inline radio-small">
                <label>
                    <input class="i-radio" type="radio" value="Male" name="gender" required />Male</label>
            </div>
            <div class="radio-inline radio-small">
                <label>
                    <input class="i-radio" type="radio" value="Female" name="gender" required />Female</label>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <i class="fa fa-home input-icon input-icon-show"></i>
                    <label> Address</label>
                    <textarea required name="address" class="form-control">

                    </textarea>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                <label>Password *</label>
                <input class="form-control" type="password" name="password" required placeholder="my secret password" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                <label>Confirm Password *</label>
                <input class="form-control" type="password" name="password_confirmation" required placeholder="my secret password confirmation" />
            </div>
        </div>
    </div>
        <button class="btn btn-primary" type="submit"> Join Us <i class="fa fa-user-plus"></i></button>
    </form>
</div>