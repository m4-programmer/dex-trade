<?php 
  
  function singleMenu($value='')
  {
    return htmlspecialchars($value);
  }
  function arrayMenu($value='')
  {
    return $value[0];
  }
  function activeMenu($value='')
  {
    return true;
  }
 ?>
<div class="d-sidebar">
    <ul class="d-sidebar-menu">
      <li class="{{singleMenu('user.dashboard')}}"> 
        <a href="{{ route('home') }}"><i class="fas fa-layer-group"></i> {{ __('Dashboard') }}</a>
      </li>

      <li class="has_submenu {{arrayMenu(['user.investmentplan','user.invest.log'])}}"> 
        <a href="#0"><i class="fas fa-funnel-dollar"></i> {{ __('Investment') }}</a>
        <ul class="submenu">
          <li class="{{singleMenu('user.investmentplan')}}">
            <a href="{{ route('investment.index') }}"><i class="fas fa-minus"></i> {{ __('Investment Plans') }}</a>
          </li>
          <li class="{{singleMenu('user.invest.log')}}">
            <a href="{{route('myinvestment')}}"><i class="fas fa-minus"></i> {{ __('Invest Log') }}</a>
          </li>
        </ul>
      </li>

      <li class="has_submenu {{arrayMenu(['user.deposit','user.deposit.log'])}}">
        <a href="#0"><i class="fas fa-coins"></i> {{ __('Deposit') }}</a>
        <ul class="submenu">
          <li class="{{singleMenu('user.deposit')}}">
            <a href="{{route('deposit.index')}}"><i class="fas fa-minus"></i> {{ __('Deposit') }}</a>
          </li>
          <li class="{{singleMenu('user.deposit.log')}}">
            <a href="{{route('deposit_log')}}"><i class="fas fa-minus"></i> {{ __('Deposit Log') }}</a>
          </li>
        </ul>
      </li>

      <li class="has_submenu {{arrayMenu(['user.withdraw','user.withdraw.*'])}}">
        <a href="#0"><i class="fas fa-hand-holding-usd"></i> {{ __('Withdraw') }}</a>
        <ul class="submenu">
          <li class="{{singleMenu('user.withdraw')}}">
            <a href="{{route('withdraw')}}"><i class="fas fa-minus"></i> {{ __('Withdraw') }}</a>
          </li>
          <li class="{{singleMenu('user.withdraw.*')}}">
            <a href="{{route('withdraw_log')}}"><i class="fas fa-minus"></i> {{ __('Withdraw Log') }}</a>
          </li>
        </ul>
      </li>

     <!--  <li class="{{singleMenu('user.transfer_money')}}">
        <a href="('user.transfer_money') }}"><i class="fas fa-exchange-alt"></i> {{ __('Transfer Money') }}</a>
      </li> -->

       <!-- <li class="{{activeMenu(url('user.money.log'))}}">
            <a href="('user.money.log') }}">
                <i class="las la-exchange-alt me-3"></i> 
                {{ __('Money Transfer Log') }}
            </a>
        </li> -->

        
     <!--  <li class="{{singleMenu('user.interest.log')}}">
        <a href="('user.interest.log') }}"><i class="far fa-file-alt"></i> {{ __('Interest Log') }}</a>
      </li> -->
    <!--   <li class="{{singleMenu('user.transaction.log')}}">
        <a href="{{route('transaction_log')}}"><i class="fas fa-file-invoice-dollar"></i> {{ __('Transaction Log') }}</a>
      </li> -->

      <li class="{{singleMenu('user.commision')}}">
        <a href="{{route('referral_log')}}"><i class="fas fa-file-invoice-dollar"></i> {{ __('Refferal Log') }}</a>
      </li>


      <!-- <li class="{{singleMenu('user.2fa')}}">
        <a href="('user.2fa') }}"><i class="fas fa-user-shield"></i> {{ __('2FA') }}</a>
      </li> -->
      <li class="{{singleMenu('user.ticket.index')}}">
        <a href="{{route('ticket.index')}}"><i class="fas fa-headset"></i> {{ __('Support') }}</a>
      </li>
      <li>
         <form method="post" action="{{route('logout')}}" style="margin-left: 15px;">
            @csrf
              <button class="text-muted" style="background: transparent;color: ;border:none; " ><i class="fas fa-sign-out-alt"></i> &nbsp;&nbsp; {{ __('Logout') }}</button>
          </form>
        
        <!-- <a href="#"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</a> -->
      </li>
    </ul>
    <div class="d-plan-notice mt-4 mx-3">
        <p class="mb-0">{{ __('Current Plan') }}
            </p>
        <a href="{{ route('myinvestment') }}">{{ isset(auth()->user()->current_plan) ? auth()->user()->current_plan : 'N/A' }} <i
                class="fas fa-arrow-up"></i></a>
    </div>
</div>
