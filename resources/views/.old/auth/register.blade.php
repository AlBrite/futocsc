<x-body title="{{ $title ?? 'Registeration Form' }}">
    <style>
        .regBg {
            width: 300px;
            margin: auto;
        }
    </style>
    <div class="regBg center">
        <form method="post" action="/doregister" class="my-auto ignore">
            @csrf
            @if (request()->has('redirect_to'))
                <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">
            @endif


            <div class="sb-card-body text-center">
                <span class="font-weight-bold text-muted">Create your account. It's free and only takes
                    a minute.</span>
            </div>


            @if ($jointoken)
                <div class="input-group my-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="small">Class</i>
                        </div>
                    </div>

                    <select class="form-control" name="jtoken" readonly>
                        <option value="{{ $jointoken }}">{{ $invitation->name }}</option>
                    </select>
                </div>
            @endif

            <div class="input-group">
                <input pattern="^\s*([a-zA-Z]+)\s+([a-zA-Z]+)\s*([a-zA-Z]+)?\s*" type="text" class="form-control"
                    value="{{ old('name') }}" name="name" id="name" placeholder="Full Name"
                    required="required">
                @error('name')
                    <div class="text-danger small">
                        <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                    </div>
                @enderror
            </div>




            <div class="form-group mt-3 text-muted">
                Gender<br>
                <select name="gender" class="form-control">
                    <option value="female" faIcon="fas fa-female">Female</option>
                    <option value="male" faIcon="fas fa-male">Male</option>
                </select>


                @error('gender')
                    <div class="text-danger small">
                        <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group mt-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="small">Email</i>
                    </div>
                </div>

                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email"
                    placeholder="Enter Email" required="required">
            </div>

            @error('email')
                <div class="text-danger small">
                    <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                </div>
            @enderror




            <div class="input-group mt-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="small">Reg No</i>
                    </div>
                </div>

                <input type="number" class="form-control" name="regno" value="{{ old('regno') }}" id="regno"
                    placeholder="Student only">
            </div>

            @error('regno')
                <div class="text-danger small">
                    <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                </div>
            @enderror





            <div class="input-group mt-3">


                <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" id="number"
                    placeholder="Enter Number" required="required">
            </div>

            @error('phone')
                <div class="text-danger small">
                    <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                </div>
            @enderror


            <div class="input-group password-group mt-3">
                <div class="row">
                    <div class="col">
                        <div class="input-group input-has-right-appendage"><input type="password"
                                class="form-control password border reg_password ignore password-input"
                                autocomplete="off" name="password" value="{{ old('password') }}" data-id="password"
                                placeholder="Password" required="required" data-password="input">
                            <div data-ui="toggle-password" class="input-group-append">
                                <div class="input-group-text top title-tip"><i
                                        class="fa fa-eye-slash password-visibility" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        @error('password')
                            <div class="text-danger small">
                                <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="input-group input-has-right-appendage"><input type="password"
                                class="form-control password reg_password ignore password-input"
                                value="{{ old('password_confirmation') }}" data-id="password_confirmation"
                                name="password_confirmation" placeholder="Confirm Password" required="required"
                                data-password="input">
                            <div data-ui="toggle-password" class="input-group-append">
                                <div class="input-group-text top title-tip"><i
                                        class="fa fa-eye-slash password-visibility" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <div class="text-danger small">
                                <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="form-group mt-3">
                <label class="form-check-label">
                    <input type="checkbox" name="checkpolicy" value="checked" required="required">
                    I accept the <a href="#">Terms of Use</a> &amp; <a href="#">Privacy
                        Policy</a>
                    @error('checkpolicy')
                        <div class="text-danger small">
                            <i class="fas fa-exclamation-triangle text-danger"></i> {{ $message }}
                        </div>
                    @enderror
                </label>
            </div>

            <input type="hidden" name="submit" value="Register">

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" data-value="Registering">Register</button>
            </div>
            <div class="text-center signupin-area">
                Already have an account? <a href="/login">Sign in</a>
            </div>
        </form>
    </div>
</x-body>
