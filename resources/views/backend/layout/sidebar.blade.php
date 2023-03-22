<?php 
function menuActive($value='')
{
    return $value;
}

 ?>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <h2><a href="{{ url('admin.home') }}">{{ @$general->sitename }}</a></h2>
        </div>

        <ul class="sidebar-menu">

            <li class="nav-item dropdown {{ menuActive('admin.home') }}">
                <a href="{{ route('admin.home') }}" class="nav-link ">
                    <i data-feather="home"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </li>

            <!--< li class="sidebar-menu-caption">{{ __('Administration') }}</li>

           

                <li class="nav-item dropdown {{ menuActive('admin.roles.index') }}">
                    <a href="{{ url('admin.roles.index') }}" class="nav-link ">
                        <i data-feather="users"></i>
                        <span>{{ __('Manage Role') }}</span>
                    </a>
                </li>

           

           
                <li class="nav-item dropdown {{ menuActive('admin.admins.index') }}">
                    <a href="{{ url('admin.admins.index') }}" class="nav-link ">
                        <i data-feather="user-check"></i>
                        <span>{{ __('Manage Admins') }}</span>
                    </a>
                </li> -->
           


            <li class="sidebar-menu-caption">{{ __('Manage Plan') }}</li>

           
                <li class="nav-item dropdown {{ menuActive('admin.plan*') }}">
                    <a href="{{ route('admin.plan.index') }}" class="nav-link ">
                        <i data-feather="box"></i>
                        <span>{{ __('Manage Plan') }}</span>
                    </a>
                </li>
            

           
               {{--  <li class="nav-item dropdown {{ menuActive('admin.time*') }}">
                    <a href="{{ url('admin.time.index') }}" class="nav-link ">
                        <i data-feather="calendar"></i>
                        <span>{{ __('Schedule') }}</span>
                    </a>
                </li> --}}
           


            <li class="sidebar-menu-caption">{{ __('User Management') }}</li>

            
                <li class="nav-item dropdown {{ @$navManageUserActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="user"></i>
                        <span>{{ __('Manage Users') }} @if (@$deactiveUser > 0)
                                <i
                                    class="far fa-bell text-danger animate__animated animate__infinite animate__heartBeat animate__slow"></i>
                            @endif
                        </span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ @$subNavManageUserActiveClass }}">
                            <a class="nav-link" href="{{ route('admin.user') }}">{{ __('Manage Users') }}</a>
                        </li>

                        

<!-- 
                        <li class="{{ @$subNavkycUserActiveClass }}">
                            <a class="nav-link" href="{{ url('admin.user.kyc') }}">{{ __('KYC Setting') }}</a>
                        </li>


                        <li class="{{ @$subNavkycReqUserActiveClass }}">
                            <a class="nav-link" href="{{ url('admin.user.kyc.req') }}">{{ __('KYC Request') }}</a>
                        </li> -->


                    </ul>
                </li>
            




        
                <li class="nav-item dropdown {{ @$navTicketActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="inbox"></i>
                        <span>{{ __('Ticket') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ @$ticketList }}">
                            <a class="nav-link" href="{{ route('admin.ticket.index') }}">{{ __('All Tickets') }}</a>
                        </li>
                       {{--  <li class="{{ @$pendingTicket }}">
                            <a class="nav-link"
                                href="{{ route('admin.ticket.pendingList') }}">{{ __('Pending Ticket') }}</a>
                        </li> --}}
                    </ul>
                </li>
           

           
                <li class="nav-item dropdown {{ menuActive('admin.referral*') }}">
                    <a href="{{ route('admin.referral.index') }}" class="nav-link ">
                        <i data-feather="link"></i>
                        <span>{{ __('Manage Referral') }}</span>
                    </a>
                </li>
            




            <li class="sidebar-menu-caption">{{ __('Payment and Payout') }}</li>


                  <li class="nav-item dropdown {{ menuActive('admin.investment') }}">
                    <a href="{{ route('admin.investment') }}" class="nav-link ">
                        <i data-feather="table"></i>
                        <span>{{ __('Manage Investment') }}</span>
                    </a>
                </li>
            
                {{-- <li class="nav-item dropdown {{ @$navManualPaymentActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="database"></i>
                        <span>{{ __('Manage Investment') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ @$subNavManualPaymentActiveClass }}">
                            <a class="nav-link" href="{{ route('admin.manual') }}">{{ __('Manual Payments') }}</a>
                        </li>

                        <li class="{{ @$subNavPendingPaymentActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.manual.status', 'pending') }}">{{ __('Pending Payments') }}</a>
                        </li>

                        <li class="{{ @$subNavAcceptedPaymentActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.manual.status', 'accepted') }}">{{ __('Accepted Payments') }}</a>
                        </li>

                        <li class="{{ @$subNavRejectedPaymentActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.manual.status', 'rejected') }}">{{ __('Rejected Payments') }}</a>
                        </li>

                    </ul>
                </li>
                --}}
           

            
                <li class="nav-item dropdown {{ @$navManageWithdrawActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="package"></i>
                        <span>{{ __('Manage Withdraw') }}</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class="{{ @$subNavWithdrawMethodActiveClass }}">
                            <a class="nav-link" href="{{ route('admin.withdraw') }}">{{ __('Withdraw Method') }}</a>
                        </li> --}}
                        <li class="{{ @$subNavWithdrawPendingActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.withdraw.pending') }}">{{ __('Pending Withdraws') }}</a>
                        </li>
                        <li class="{{ @$subNavWithdrawAcceptedActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.withdraw.accepted') }}">{{ __('Accepted Withdraws') }}</a>
                        </li>
                        <li class="{{ @$subNavWithdrawRejectedActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.withdraw.rejected') }}">{{ __('Rejected Withdraws') }}</a>
                        </li>
                    </ul>
                </li>
            


            
                <li class="nav-item dropdown {{ menuActive('admin.deposit.log') }}">
                    <a href="{{ route('admin.deposit.log') }}" class="nav-link ">
                        <i data-feather="table"></i>
                        <span>{{ __('Manage Deposit') }}</span>
                    </a>
                </li>
           

            
                <li class="sidebar-menu-caption">{{ __('System Settings') }}</li>
            

            
                {{-- <li class="nav-item dropdown {{ @$navPaymentGatewayActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="credit-card"></i>
                        <span>{{ __('Gateway Settings') }}</span></a>
                    <ul class="dropdown-menu">
                         <li class="{{ @$subNavPaypalPaymentActiveClass }}">
                            <a class="nav-link" href="{{ route('admin.withdraw') }}">{{ __('View Gateways') }}</a>
                        </li>
                        <li class="{{ @$subNavPaypalPaymentActiveClass }}">
                            <a class="nav-link"
                                href="{{ route('admin.gateway.index') }}">{{ __('Create Gateway') }}</a>
                        </li>
                        

                        
                       
                    </ul>
                </li> --}}
                 <li class="nav-item dropdown {{ menuActive('admin.withdraw') }}">
                    <a href="{{ route('admin.withdraw') }}" class="nav-link ">
                        <i data-feather="credit-card" title="Add Payment Coin Here"></i>
                        <span>{{ __('Manage Gateway') }}</span>
                    </a>
                </li>
            

           
              
          


            

                <li class="menu-header">{{ __('System Settings') }}</li>

                <li class="nav-item dropdown {{ menuActive('admin.general.setting') }}">
                    <a href="{{ route('admin.general.setting') }}" class="nav-link ">
                        <i data-feather="settings" title="Change Settings for Website Here"></i>
                        <span>{{ __('General Settings') }}</span>
                    </a>
                </li>

               
            


         




            {{--


               <!--  <li class="nav-item dropdown {{ @$navManageLanguageActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="globe"></i>
                        <span>{{ __('Manage Language') }}</span></a>
                    <ul class="dropdown-menu">

                        <li class="{{ @$subNavManageLanguageActiveClass }}"><a class="nav-link"
                                href="{{ url('admin.language.index') }}">{{ __('Manage Language') }}</a>
                        </li>
                    </ul>
                </li>
            

            
                


            
            
            <li class="menu-header">{{ __('Email Settings') }}</li>

                <li class="nav-item dropdown {{ @$navEmailManagerActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="mail"></i>
                        <span>{{ __('Email Manager') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ @$subNavEmailConfigActiveClass }}">
                            <a class="nav-link"
                                href="{{ url('admin.email.config') }}">{{ __('Email Configure') }}</a>
                        </li>
                        <li class="{{ @$subNavEmailTemplatesActiveClass }}">
                            <a class="nav-link"
                                href="{{ url('admin.email.templates') }}">{{ __('Email Templates') }}</a>
                        </li>
                    </ul>
                </li>
            
 -->

                <li class="sidebar-menu-caption">{{ __('Others') }}</li>

            


            
                 <li class="menu-header">{{ __('Reports') }}</li>

                <li class="nav-item mb-3 dropdown {{ @$navReportActiveClass }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                        <i data-feather="alert-octagon"></i>
                        <span>{{ __('Report') }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ @$subNavPaymentReportActiveClass }}"><a class="nav-link"
                                href="{{ url('admin.payment.report') }}">{{ __('Payment Reports') }}</a>
                        </li>
                        <li class="{{ @$subNavWithdrawReportActiveClass }}"><a class="nav-link"
                                href="{{ url('admin.withdraw.report') }}">{{ __('Withdraw Reports') }}</a>
                        </li>

                        <li class="{{ @$subNavTransactionActiveClass }}">
                            <a href="{{ url('admin.transaction') }}"
                                class="nav-link ">{{ __('Manage Transaction') }}</a>
                        </li>
                    </ul>
                </li> 
            


            
            --}}

        </ul>
    </aside>
</div>
