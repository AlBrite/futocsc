@props(['advisors', 'countCourses'])

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5 col-lg-7">
            <div class="row my-3">
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="{{ route('add.advisorForm') }}" class="text-dark xd-block">

                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-user-graduate fa-3x"></i>
                                <h3>Advisors</h3>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="{{ route('view.courses') }}" class="text-dark xd-block">

                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-3x"></i>
                                <h3>Courses</h3>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="{{ route('result.form') }}" class="text-dark xd-block">

                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-line fa-3x"></i>
                                <h3>Results</h3>
                            </div>
                        </div>
                    </a>
                </div>







                <div class="col-md-6 col-lg-3 mb-3">

                    <a href="/departments" class="text-dark xd-block">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-pie fa-3x"></i>
                                <h3>Depart</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-bell fa-3x"></i>
                            <h3>Reports</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-chart-bar fa-3x"></i>
                            <h3>Statistics</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-5">
            <div class="row">
                @foreach ($advisors as $advisor)
                    <div class="col-12 mb-2">

                        <div class="card">
                            <div class="card-body">

                                <img class="float-left rounded-circle mr-2"
                                    src="{{ asset('storage/' . $advisor->image) }}" style="width:40px;height:40px;" />
                                <div class="float-left">
                                    <h4><a
                                            href="{{ route('profile', ['username' => $advisor->user->name]) }}">{{ $advisor->user->name }}</a>
                                    </h4>

                                    <div>{{ $advisor->user->email }}</div>
                                    <div>{{ $advisor->user->created_at }}</div>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($advisor->academicSet()->exists())
                                    Assigned: {{ $advisor->academicSet()->first()->name }}
                                @else
                                    <a class="btn btn-inherit-fade" style="background:rgba(0,0,0,0.2);">Assign Set</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
