<div class="panel-group related-quiz" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse"   data-parent="#accordion" href="#collapse0" aria-expanded="true">My
                    Information</a>
            </h4>
        </div>
        <div id="collapse0" class="panel-collapse collapse in">
            <div class="panel-body">
                <div class="inner">
                    <a id='my_information' href="{{route('user.profile')}}" >Personal Information</a>
                    <a id='edit_setting' href="{{route('profile.edit')}}">Edit Information</a>
                    <a id='changePassword' href="{{route('profile.pwdedit')}}">Change Password</a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a id="addReferral" href="{{route('user.referal')}}" href="#collapse2">My Referral</a>
            </h4>
        </div>
        <!--<div id="collapse2" class="panel-collapse collapse in">-->
        <!--    <div class="panel-body">-->
        <!--        <div class="inner">-->
        <!--            <a id="addReferral" href="{{route('user.referal')}}">Referral info</a>-->
        <!--            <a id="referFriend" href="{{route('user.referal.friend')}}">Refer friend</a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
    </div>



    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Quiz</a>
            </h4>
        </div>
        <div id="collapse6" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="inner">
                    {{-- <a id="allOrder" href="{{url('/quiz-edit')}}">Edit Quiz</a> --}}
                    <a id="allOrder" href="{{url('/user/quiz-edit')}}">Edit Quiz</a>
                    <a id="result" href="{{url('/user/quiz-result')}}">Result</a>
                    <a id="qwinner" href="{{url('/user/quiz-winner')}}">Quiz Winner</a>
                    {{-- <a id="allOrder" href="{{url('/quiz-result')}}">Quiz Result</a> --}}
                </div>
            </div>
        </div>

    </div>
    <!--<div class="panel panel-default">-->
    <!--    <div class="panel-heading">-->
    <!--        <h4 class="panel-title">-->
    <!--            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">Withdraw</a>-->
    <!--        </h4>-->
    <!--    </div>-->
    <!--    <div id="collapse6" class="panel-collapse collapse">-->
    <!--        <div class="panel-body">-->
    <!--            <div class="inner">-->
    <!--                <a id="allOrder" href="{{url('/request')}}"> Withdraw Request</a>-->
    <!--                <a id="allOrder" href="{{url('/edit-request')}}">Edit Request</a>-->
    <!--                <a id="allOrder" href="{{url('/withdrawl-history')}}">Withdraw History</a>-->
    <!--            </div>-->
    <!--        </div>-->

    <!--    </div>-->
       
    <!--</div>-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
               
            
                <a class="text-white" href="{{ url('admin/logout')}}" style="text-decoration:none"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                    
               </h4>
            </div>

    </div>
</div>

