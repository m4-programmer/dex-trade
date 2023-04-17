
<div class="d-sidebar">
    <ul class="d-sidebar-menu">
      <li class="{{singleMenu('home')}}">
        <a href="{{ route('home') }}"><i class="fas fa-layer-group"></i> {{ translate('Dashboard') }}</a>
      </li>

      <li class="has_submenu {{arrayMenu(['investment.index','myinvestment'])}}">
        <a href="#0"><i class="fas fa-funnel-dollar"></i> {{ translate('Investment') }}</a>
        <ul class="submenu">
          <li class="{{singleMenu('investment.index')}}">
            <a href="{{ route('investment.index') }}"><i class="fas fa-minus"></i> {{ translate('Investment Plans') }}</a>
          </li>
          <li class="{{singleMenu('myinvestment')}}">
            <a href="{{route('myinvestment')}}"><i class="fas fa-minus"></i> {{ translate('Invest Log') }}</a>
          </li>
        </ul>
      </li>

      <li class="has_submenu {{arrayMenu(['deposit.index','deposit_log'])}}">
        <a href="#0"><i class="fas fa-coins"></i> {{ translate('Deposit') }}</a>
        <ul class="submenu">
          <li class="{{singleMenu('deposit.index')}}">
            <a href="{{route('deposit.index')}}"><i class="fas fa-minus"></i> {{ translate('Deposit') }}</a>
          </li>
          <li class="{{singleMenu('deposit_log')}}">
            <a href="{{route('deposit_log')}}"><i class="fas fa-minus"></i> {{ translate('Deposit Log') }}</a>
          </li>
        </ul>
      </li>

      <li class="has_submenu {{arrayMenu(['withdraw','withdraw_log'])}}">
        <a href="#0"><i class="fas fa-hand-holding-usd"></i> {{ translate('Withdraw') }}</a>
        <ul class="submenu">
          <li class="{{singleMenu('withdraw')}}">
            <a href="{{route('withdraw')}}"><i class="fas fa-minus"></i> {{ translate('Withdraw') }}</a>
          </li>
          <li class="{{singleMenu('withdraw_log')}}">
            <a href="{{route('withdraw_log')}}"><i class="fas fa-minus"></i> {{ translate('Withdraw Log') }}</a>
          </li>
        </ul>
      </li>

     <!--  <li class="{{singleMenu('transfer_money')}}">
        <a href="('transfer_money') }}"><i class="fas fa-exchange-alt"></i> {{ translate('Transfer Money') }}</a>
      </li> -->

       <!-- <li class="{{activeMenu(url('money.log'))}}">
            <a href="('money.log') }}">
                <i class="las la-exchange-alt me-3"></i>
                {{ translate('Money Transfer Log') }}
            </a>
        </li> -->


     <!--  <li class="{{singleMenu('interest.log')}}">
        <a href="('interest.log') }}"><i class="far fa-file-alt"></i> {{ translate('Interest Log') }}</a>
      </li> -->
    {{--   <li class="{{singleMenu('transaction.log')}}">
        <a href="{{route('transaction_log')}}"><i class="fas fa-file-invoice-dollar"></i> {{ translate('Transaction Log') }}</a>
      </li> --}}

      <li class="{{singleMenu('referral_log')}}">
        <a href="{{route('referral_log')}}"><i class="fas fa-file-invoice-dollar"></i> {{ translate('Refferal Log') }}</a>
      </li>


      <!-- <li class="{{singleMenu('2fa')}}">
        <a href="('2fa') }}"><i class="fas fa-user-shield"></i> {{ translate('2FA') }}</a>
      </li> -->
      <li class="{{singleMenu('ticket.index')}}">
        <a href="{{route('ticket.index')}}"><i class="fas fa-headset"></i> {{ translate('Support') }}</a>
      </li>
      <li>
         <form method="post" action="{{route('logout')}}" style="margin-left: 15px;">
            @csrf
              <button class="text-muted" style="background: transparent;color: ;border:none; " ><i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp; {{ translate('Logout') }}</button>
          </form>

        <!-- <a href="#"><i class="fas fa-sign-out-alt"></i> {{ translate('Logout') }}</a> -->
      </li>
    </ul>
    <div class="d-plan-notice mt-4 mx-3">
        <p class="mb-0">{{ translate('Current Plan') }}
            </p>
        <a href="{{ route('myinvestment') }}">{{ isset(auth()->user()->current_plan) ? auth()->user()->current_plan : 'N/A' }} <i
                class="fas fa-arrow-up"></i></a>
    </div>
</div>
