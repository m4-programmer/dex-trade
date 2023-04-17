
@extends(template().'layout.master2')




@section('content2')
    <div class="dashboard-body-part">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('change.password') }}" class="cmn-btn mb-2">{{ translate('Change Password') }}</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ url('user/settings/'.auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row gy-4 justify-content-center">
                        <div class="col-md-4 pe-lg-5 pe-md-4 justify-content-center">
                            <div class="img-choose-div">
                                <p>{{ translate('Profile Picture') }}</p>

                                    <img class=" rounded file-id-preview w-100" id="file-id-preview"
                                        src="{{ asset(auth()->user()->image) }}" alt="pp">

                                <input type="file" name="profile_pics" id="imageUpload" class="upload"
                                    accept=".png, .jpg, .jpeg" hidden>

                                <label for="imageUpload"
                                    class="editImg cmn-btn w-100">{{ translate('Choose file') }}</label>


                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="update">
                                <div class="mb-3">
                                    <label>{{ translate('Full Name') }}</label>
                                    <input type="text" class="form-control" name="fname"
                                        value="{{ @Auth::user()->name }}"
                                        placeholder="{{ translate('Update Full Name') }}">
                                </div>

                                <div class="mb-3">
                                    <label>{{ translate('Username') }}</label>
                                    <input type="text" class="form-control text-white" name="username"
                                        value="{{ @Auth::user()->username }}"
                                        placeholder="{{ translate('Enter User Name') }}">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>{{ translate('Email address') }}</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ @Auth::user()->email }}" placeholder="{{ translate('Enter Email') }}">
                            </div>

                            <div class="mb-3">
                                <label>{{ translate('Phone') }}</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ @Auth::user()->phone }}" placeholder="{{ translate('Enter Phone') }}">
                            </div>


                            <div class="row">

                                <div class="form-group col-md-6 mb-3 ">
                                    <label>{{ translate('Country') }}</label>
                                    <input type="text" name="country" class="form-control"
                                        value="{{ @Auth::user()->country }}">
                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>{{ translate('city') }}</label>
                                    <input type="text" name="city" class="form-control form_control"
                                        value="{{ @Auth::user()->city }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>{{ translate('zip') }}</label>
                                    <input type="text" name="zip" class="form-control form_control"
                                        value="{{ @Auth::user()->zip }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>{{ translate('state') }}</label>
                                    <input type="text" name="state" class="form-control form_control"
                                        value="{{ @Auth::user()->state }}">

                                </div>

                            </div>

                            <button class="cmn-btn mt-3 w-100">{{ translate('Update') }}</button>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        'use strict'
        document.getElementById("imageUpload").onchange = function() {
            show();
        };

        function show() {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-id-preview");
                preview.src = src;
                preview.style.display = "block";
                document.getElementById("file-id-preview").style.visibility = "visible";
            }
        }
    </script>
@endpush
